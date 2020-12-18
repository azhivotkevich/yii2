<?php

namespace app\controllers;

use app\models\City;
use app\models\forms\CountryCheckForm;
use app\models\forms\RegionCheckForm;
use Yii;
use app\models\Salon;
use app\models\search\Salon as SalonSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalonsController implements the CRUD actions for Salon model.
 */
class SalonsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Salon models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Salon model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Salon model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Salon();

        $countryModel = new CountryCheckForm();
        $regionModel = new RegionCheckForm();
        $regions = [];
        $cities = [];

        if ($countryModel->load(Yii::$app->request->post()) && $countryModel->validate()) {
            $regions = ArrayHelper::map(\app\models\Region::findAll(
                ['country_id' => $countryModel->countryId]
            ), 'id', 'name');
        }


        if ($regionModel->load(Yii::$app->request->post()) && $regionModel->validate()) {
            $cities = ArrayHelper::map(City::findAll(
                ['region_id' => $regionModel->regionId]
            ), 'id', 'name');
        }
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'regions' => $regions,
            'countryModel' => $countryModel,
            'cities' => $cities,
            'regionModel' => $regionModel
        ]);
    }

    /**
     * Updates an existing Salon model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Salon model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Salon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Salon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Salon::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
