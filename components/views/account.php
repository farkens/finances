<div class="row text-right">
        <div class="col-md-6">
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
        <div class="col-md-6">
            <ul>
                <li>Общий баланс: </li>
                <li>Прибыль: <?= $income ?> ₽</li>
                <li>Расход: <?= $cost ?> ₽</li>
            </ul>
        </div>
    </div>