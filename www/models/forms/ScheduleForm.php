<?php


namespace app\models\forms;


use app\models\Cabinet;
use app\models\ContactType;
use app\models\DailySchedule;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\validators\CompareValidator;
use yii\validators\DateValidator;
use yii\validators\EachValidator;
use yii\validators\RequiredValidator;

class ScheduleForm extends Model
{
    public const DAILY_SCHEDULE = 'daily';
    public const WEEKLY_SCHEDULE = 'weekly';
    public const MONTHLY_SCHEDULE = 'monthly';

    public const DATE_FORMAT = 'd.m.Y';
    public const TIME_FORMAT = 'HH:mm';

    public ?int $userId = null;
    public ?int $cabinetId = null;
    public array $dates = [];
    public ?string $status = null;

    private array $eventsArray = [];


    public function rules()
    {
        return [
            [['userId'], 'filter', 'filter' => function () {
                if (Yii::$app->user->can('doctor')) {
                    return Yii::$app->user->id;
                }
                return $this->userId;
            }],
            [['cabinetId', 'userId', 'date'], 'required'],
            [['cabinetId', 'userId'], 'integer'],
            [['status'], 'string'],
            [['dates'], 'validateDates', 'on' => self::DAILY_SCHEDULE],
            [['cabinetId'], 'exist', 'skipOnError' => true, 'targetClass' => Cabinet::class, 'targetAttribute' => ['cabinetId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
        ];
    }


    public function validateDates($attribute)
    {
        $this->setEventsByDates();

        foreach ($this->{$attribute} as $index => $row) {
            $this->validateDate("{$attribute}[{$index}][date]", $row['date'], self::DATE_FORMAT);

            $timeFromAttribute = "{$attribute}[{$index}][time_from]";
            $timeToAttribute = "{$attribute}[{$index}][time_to]";

            $isValidTimeFrom = $this->validateDate($timeFromAttribute, $row['time_from'], self::TIME_FORMAT);
            $isValidTimeTo = $this->validateDate($timeToAttribute, $row['time_to'], self::TIME_FORMAT);

            if (!$isValidTimeFrom || !$isValidTimeTo) {
                continue;
            }

            $isValidTime = $this->validateTime($timeToAttribute, $row['time_from'], $row['time_to']);

            if (!$isValidTime) {
                continue;
            }

            $this->validateUniqueDates(
                $timeFromAttribute,
                $timeToAttribute,
                $row['time_from'],
                $row['time_to'],
                $row['date']
            );
        }
    }

    public function validateUniqueDates(
        string $startAttribute,
        string $endAttribute,
        string $start,
        string $end,
        string $date
    ): bool
    {
        $date = date("Y-m-d", strtotime($date));
        $events = $this->eventsArray[$date] ?? [];

        $startTime = strtotime("{$date} {$start}");
        $endTime = strtotime("{$date} {$end}");

        foreach ($events as $event) {
            $eventStart = strtotime("{$event->date} {$event->time_from}");
            $eventEnd = strtotime("{$event->date} {$event->time_to}");

            if ($startTime >= $eventStart && $startTime <= $eventEnd) {
                $this->addError($startAttribute, 'This time is reserved');
                return false;
            }

            if ($endTime >= $eventStart && $endTime <= $eventEnd) {
                $this->addError($endAttribute, 'This time is reserved');
                return false;
            }
        }

        return true;
    }

    public function save()
    {
        if ($this->hasErrors()) {
            return false;
        }

        foreach ($this->dates as $row) {
            $model = new DailySchedule;

            $model->cabinet_id = $this->cabinetId;
            $model->user_id = $this->userId;
            $model->date = (new \DateTime($row['date']))->format('Y-m-d');
            $model->time_from = $row['time_from'];
            $model->time_to = $row['time_to'];
            $model->status = $this->status;

            $model->save(false);
        }

        return true;
    }

    private function validateDate(string $attribute, string $value, string $format): bool
    {
        $error = null;
        $requireValidator = new RequiredValidator();

        $requireValidator->validate($value, $error);

        if ($error) {
            $this->addError($attribute, $error);
            return false;
        }

        $dateValidator = new  DateValidator();
        $dateValidator->format = $format;
        $dateValidator->validate($value, $error);

        if ($error) {
            $this->addError($attribute, $error);
            return false;
        }

        return true;
    }

    private function validateTime(string $attribute, string $timeFrom, string $timeTo): bool
    {
        $error = null;
        $compareValidator = new CompareValidator(['operator' => '>']);

        $compareValidator->compareValue = $timeFrom;
        $compareValidator->validate($timeTo, $error);

        if ($error) {
            $this->addError($attribute, $error);
            return false;
        }

        return true;
    }

    private function getUniqueDates(): array
    {
        $dates = [];
        foreach ($this->dates as $row) {
            $date = (new \DateTime($row['date']))->format('Y-m-d');
            $dates[$date] = null;
        }
        return array_keys($dates);
    }

    private function setEventsByDates()
    {
        $uniqueDates = $this->getUniqueDates();
        $existEvents = DailySchedule::findAll(['date' => $uniqueDates]);

        foreach ($existEvents as $event) {
            $this->eventsArray[$event->date][] = $event;
        }
    }

    public function scenarios()
    {
        return [
            self::DAILY_SCHEDULE => ['userId', 'cabinetId', 'status', 'dates'],
            self::WEEKLY_SCHEDULE => ['userId', 'cabinetId', 'status', 'dates'],
            self::MONTHLY_SCHEDULE => ['userId', 'cabinetId', 'status', 'dates'],
        ];
    }
}