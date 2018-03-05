<?php 
    use yii\bootstrap\Modal;
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
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
            foreach ($accounts as $item){
                $arrAccount[$item['id']] = $item['name'];
            }
            echo $form->field($model, 'name')->label('Наименование');
            echo $form->field($model, 'sum')->label('Сумма');
            echo $form->field($model, 'date')->label('Дата');
            echo $form->field($model, 'comment')->label('Коментарий');
            echo $form->field($model, 'accountID')->label('Счет')->dropdownList($arrAccount,
                [   
                    'prompt'=>'Выберите категорию',
                ]
            );
            echo $form->field($model, 'userID')->label(false)->hiddenInput(['value' => Yii::$app->user->id]);
            echo "<div class='form-group'>";
            echo Html::submitButton('Добавить', ['class' => 'btn btn-primary']);
            echo    "</div>";
            
            ActiveForm::end();

            Modal::end();
            ?>
            
        </div>
    </div>
    <div class="row">
        <?php if($income){ $count = 1;?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Дата</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($income as $item){ ?>
                <tr>
                    <th scope="row"><?= $count ?></th>
                    <td><?=$item['name']?></td>
                    <td><?=$item['sum']?></td>
                    <td><?=$item['date']?></td>
                </tr>
                <?php $count++; } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
</div>