<?
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Регистрация';

?>

<div class="site-login">
    <h1>Регистрация</h1>

    <!--    --><?//= Yii::$app->getSecurity()->generatePasswordHash('admin') ?>

    <p>Заполните следующие поля, что бы зарегистрироваться:</p>

<!--    --><?// $form = ActiveForm::begin() ?>
    <? $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= $form->field($signUp, 'username') ?>
    <?= $form->field($signUp, 'email') ?>
    <?= $form->field($signUp, 'password')->passwordInput() ?>
    <div class="form-group">
        <div>
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <? ActiveForm::end() ?>

</div>
