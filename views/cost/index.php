<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расходы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    Modal::begin([
        'header' => '<h2>Добавить новый расход</h2>',
        'toggleButton' => ['label' => 'Добавить', 'class' => 'btn btn-success'],
    ]);

    $form = ActiveForm::begin([
        'action' => ['cost/add-cost'],
        'id' => 'add-cost-form',
        'options' => ['class' => 'add-cost'],
    ]);

    echo $form->field($model, 'name')->label('Наименование');

    echo $form->field($model, 'comment')->label('Коментарии');

    echo $form->field($model, 'sum')->label('Сумма');

    echo $form->field($model, 'date')->label('Дата')->widget(kartik\widgets\DatePicker::className(), [
        'language' => 'ru',
        'pluginOptions' => [
            'todayHighlight' => true,
            'calendarWeeks' => true,
            'todayBtn' => true,
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
        ]
    ]);

    //echo $form->field($model, 'userID')->label(false)->hiddenInput(['value' => Yii::$app->user->id]);
    echo $form->field($model, 'accountID')->label('Счет')->dropdownList($accounts, [
        'prompt' => 'Выберите категорию',
            ]
    );

    echo '<div class="form-group">';
    echo Html::submitButton('Сохраниь', ['class' => 'btn btn-success']);
    echo '</div>';

    ActiveForm::end();

    Modal::end();
    ?>


<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'name',
        'comment',
        'sum',
        'date',
        //'userID',
        //'accountID',
        [
            'class' => \yii\grid\ActionColumn::class,
            'template' => '{update} {delete}',
        ],
    ],
]);
?>
</div>
