<?php

use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Incomes';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-1">
            <?php
            //Вызываем кнопку с модальным окном
            Modal::begin([
                'header' => '<h2>Hello world</h2>',
                'toggleButton' => ['label' => 'Добавить', 'class' => 'btn btn-success'],
            ]);

            //добавляем форму для добавления прибыли
            $form = ActiveForm::begin([
                        'action' => ['money/add-income'],
                        'id' => 'login-form',
                        'options' => ['class' => 'MyForm'],
            ]);

            echo "<h2>Добавить прибыль:</h2>";

            //массив всех счатов пользователя
            $arrAccount;
            foreach ($accounts as $item) {
                $arrAccount[$item['id']] = $item['name'];
            }
            echo $form->field($model, 'name')->label('Наименование');
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
            echo $form->field($model, 'comment')->label('Коментарий');
            echo $form->field($model, 'accountID')->label('Счет')->dropdownList($arrAccount, [
                'prompt' => 'Выберите категорию',
                    ]
            );
            echo $form->field($model, 'userID')->label(false)->hiddenInput(['value' => Yii::$app->user->id]);
            echo "<div class='form-group'>";
            echo Html::submitButton('Добавить', ['class' => 'btn btn-primary']);
            echo "</div>";

            ActiveForm::end();

            Modal::end();
            ?>

        </div>
    </div>

    <?php
    $data = []; //массив для подсказок в поиске
    foreach ($income as $item) {
        array_push($data, $item['name']);
    }
    ?>

    <div class="row filtrs">
        <?php  
            echo $this->render('_search', [
                'model' => $searchModel,
                'data' => $data,
            ]);
        ?>
    </div>
    <div class="row">
        <?php Pjax::begin(['id' => 'income']); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'comment',
                'sum',
                'date',
                [
                    'class' => \yii\grid\ActionColumn::class,
                    'template' => '{update} {delete}',
                ],
            ],
        ]);
        ?>

        <?php Pjax::end(); ?>
    </div>
</div>