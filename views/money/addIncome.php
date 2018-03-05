<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
        ])
?>
<h2>Добавить прибыль:</h2>

<?php 
$arrAccount;
foreach ($accounts as $item){
    $arrAccount[$item['id']] = $item['name'];
}
?>

<?= $form->field($model, 'name')->label('Наименование') ?>
<?= $form->field($model, 'sum')->label('Сумма') ?>
<?= $form->field($model, 'date')->label('Дата') ?>
<?= $form->field($model, 'comment')->label('Коментарий') ?>
<?= $form->field($model, 'accountID')->label('Счет')->dropdownList($arrAccount,
    [   
        'prompt'=>'Выберите категорию',
    ]
); ?>
<?= $form->field($model, 'userID')->label(false)->hiddenInput(['value' => Yii::$app->user->id]); ?>
<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
<?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>