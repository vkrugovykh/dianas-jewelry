<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 29.01.2019
 * Time: 23:15
 */

namespace app\controllers;


use app\models\Subscribe;
use Yii;
use yii\web\Controller;

class SubscribeController extends Controller
{
    public function actionSubscribe()
    {
        $request = Yii::$app->request;
        $email = $request->post('email');

        if ($request->isPost) {
            $subscribe = new Subscribe();
            $subscribe->email = $email;
            $subscribe->activation_key = \Yii::$app->security->generateRandomString(24);
            if (!$subscribe->checkEmail($email) && $subscribe->save()) {

                //Отправка письма о подписке
                Yii::$app->mailer->compose('activation-subscribe-mail', ['subscribe'=>$subscribe])
                    ->setFrom(['phpshop2019@gmail.com' => 'Dianas jewelry'])
                    ->setTo($subscribe->email)
                    ->setSubject('Активация email подписки')
                    ->send();
                $message = 'На ваш e-mail отправлена ссылка активации';
                return $this->render('index', compact('message'));
            }
        }
        $message = 'Подписка невозможна, попробуйте другой e-mail';
        return $this->render('index', compact('message'));

    }

    public function actionActivation()
    {
        $request = Yii::$app->request;

        if ($request->isGet) {
            $activation = new Subscribe();
            if ($activation->subscribeValid($request->get('key'))) {
                $message = 'Подписка активирована';
                return $this->render('index', compact('message'));
            } else {
                $message = 'Код неверный, попробуйте подписаться еще раз';
                return $this->render('index', compact('message'));
            }

        }
    }

}