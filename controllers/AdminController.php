<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\OrderProduct;
use app\models\SignupForm;
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


    public function actionMycabinet()
    {
//        $userId = Yii::$app->user->identity->id;
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = new User();
        $userId = $user->getId();
        $order = new Order();
        $usersOrder = $order->getUserOrder($userId);
        $orderProduct = new OrderProduct();
        $orderList = $orderProduct->getOrdersList();
        return $this->render('mycabinet', compact('usersOrder', 'orderList'));
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

            $session = Yii::$app->session;
            $session->open();
            $session->remove('cart');
            $session->remove('cart.totalQuantity');
            $session->remove('cart.totalSum');

            if ($user->isAdmin()) {
                return Yii::$app->response->redirect('/admin');
//            return $this->render('index', compact('dataProvider'));
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


    public function actionSignup() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $signUp = new SignupForm();

        if($signUp->load(\Yii::$app->request->post()) && $signUp->validate()){
            $user = new User();
            $user->username = $signUp->username;
            $user->email = $signUp->email;
            $user->auth_key = $user->generateAuthKey();
            $user->password = \Yii::$app->security->generatePasswordHash($signUp->password);
            if($user->save()){
                //Отправка письма для активации
                Yii::$app->mailer->compose('signup-mail', ['user'=>$user, 'pass'=>$signUp->password])
                    ->setFrom(['phpshop2019@gmail.com' => 'Dianas jewelry'])
                    ->setTo($user->email)
                    ->setSubject('Успешная регистрация')
                    ->send();
                $access = 'ok';
                return $this->render('signupok', compact('access'));
            }
        }

        $this->layout = 'admin-layout';
        return $this->render('signup', compact('signUp'));
    }

//    public function actionActivation() {
//
//    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
}
