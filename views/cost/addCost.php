<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
        ])
?>
<h2>Добавить расход:</h2>


<?= $form->field($model, 'name')->label('Наименование') ?>
<?= $form->field($model, 'comment')->label('Коментарий') ?>
<?= $form->field($model, 'sum')->label('Сумма') ?>
<?php

    if(Yii::$app->request->get('date')){
        echo $form->field($model, 'date')->label('Дата')->input('text', ['value' => Yii::$app->request->get('date')]);
    }else{
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
    }
?>

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