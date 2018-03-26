<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\widgets\Typeahead;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\IncomeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs(
        '$("document").ready(function(){ 
        $("#filter_income").on("pjax:end", function() {
            $.pjax.reload({container:"#income"});  //Reload GridView
        });
    });'
);
?>

<div class="income-search">
    <?php Pjax::begin(['id' => 'filter_income']); ?>
    <?php
    $form = ActiveForm::begin([
                'action' => ['finance'],
                'method' => 'get',
                'options' => ['data-pjax' => true, 'name' => 'income-form',]
                
    ]);
    ?>
    <div class="form-row">
        <div class="col-sm-12">
            Сортировка по:
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-3 col-sm-12">
            <?php //$form->field($model, 'name') ?>
            <?php
                echo $form->field($model, 'name')->widget(Typeahead::classname(), [
                    'options' => ['placeholder' => 'Начните вводить название ...'],
                    'dataset' => [
                        [
                            'local' => $data,
                            'limit' => 10
                        ]
                    ]
                ])->label('Наименование');

            ?>

        </div>
        <div class="col-md-3 col-sm-12">
            <?= $form->field($model, 'comment')->label('Коментарии') ?>
        </div>
        <div class="col-md-3 col-sm-12">
            <?= $form->field($model, 'sum')->label('Сумма') ?>
        </div>
        <div class="col-md-3 col-sm-12">
            <?= $form->field($model, 'date')->label('Дата')->widget(kartik\widgets\DatePicker::classname(), [
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Конкретная дата ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
            ?>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-3 right">
            <div class="form-group">
                <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>

</div>
