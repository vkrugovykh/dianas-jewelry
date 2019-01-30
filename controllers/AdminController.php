<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use Yii;
use app\models\Order;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for Order model.
 */
class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $user = new User();
        if ($user->isAdmin()) {
            $dataProvider = new ActiveDataProvider([
                'query' => Order::find(),
            ]);

            $this->layout = 'admin-layout';
            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->goHome();
        }
    }


    public function actionView($id)
    {
        $user = new User();
        if ($user->isAdmin()) {

            $this->layout = 'admin-layout';
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->goHome();
        }
    }



    public function actionUpdate($id)
    {
        $user = new User();
        if ($user->isAdmin()) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $this->layout = 'admin-layout';
            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->goHome();
        }

    }


    public function actionDelete($id)
    {
        $user = new User();
        if ($user->isAdmin()) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            return $this->goHome();
        }
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }



    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'admin-layout';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $dataProvider = new ActiveDataProvider([
                'query' => Order::find(),
            ]);
            $user = new User();
            if ($user->isAdmin()) {
            return $this->render('index', compact('dataProvider'));
            } else {
                return $this->goHome();
            }
//            return $this->goBack();
        }

        $model->password = '';
//        $title = 'Войти';
//        return $this->render('login', compact('model', 'title'));
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
}
