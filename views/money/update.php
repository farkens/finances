<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Finance */

$this->title = 'Update Income: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="income-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="income-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'date')->textInput() ?>

        <?= $form->field($model, 'userID')->textInput() ?>

        <?= $form->field($model, 'accountID')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>

</div>
