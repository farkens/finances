<div class="container">
    <div class="row">
        <div class="col-1">
            <a href="<?= yii\helpers\Url::to(['money/add-account']) ?>">Add</a>
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
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
</div>