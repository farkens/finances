<div class="container">
    <div class="row">
        <div class="col-1">
            <a href="<?= yii\helpers\Url::to(['money/add-income']) ?>">Add</a>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <?php if ($accountGroup) { ?>
                <ul>
                    <?php foreach ($accountGroup as $group) { ?>                   
                        <?php
                        $account = $group->account;
                        
                        //если есть доход то выводим группу
                        if ($account) {
                            ?>
                            <li>   
                                <?= $group['name'] ?> 
                                <ul>
                                    <?php foreach ($account as $val) { ?>
                                        <li>
                                            <?= $val['name'] ?> - <?= number_format( $val['price'], 2) ?>
                                            <div class="date">
                                               <?= date_format( date_create($val['date']), 'd-M-Y') ?>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            
                            
                        <?php } ?>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>