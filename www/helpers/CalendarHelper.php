<?php


namespace app\helpers;


class CalendarHelper
{
    public static function getWeekDaysList($format = 'EEEE'): array
    {
        $days = array_flip(range(1, 7));

        foreach ($days as $offset => &$day) {
            $time = strtotime("Sunday +{$offset} days");
            $day = \Yii::$app->formatter->asDate($time, $format);
            $day = StringHelper::mbUcFirst($day);
        }

        return $days;
    }

    public static function getMonthDatesList(): array
    {
        $dates = [];
        for ($i = 1; $i <= 31; $i++) {
            $dates[$i] = $i;
        }
        return $dates;
    }
}