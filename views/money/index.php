<div class="container">
    <div class="row">
        <div class="col-1">
            <a href="<?= yii\helpers\Url::to(['money/add-account']) ?>">Add</a>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <?php if ($accountGroup) { ?>
                <ul>
                    <?php $coutCollapse = 0; ?>
                    <?php foreach ($accountGroup as $group) { ?>                   
                        <?php
                        $account = $group->account;
                        
                        //если есть доход то выводим группу
                        if ($account) {
                            ?>

                            <li>
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?=$coutCollapse?>" aria-expanded="true" aria-controls="collapseOne">
                                <?= $group['name'] ?> 
                            </button>
                                
                            <div id="collapse<?=$coutCollapse?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
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
                            </div>
                            </li>
                            
                            
                        <?php $coutCollapse++;
                        } ?>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>