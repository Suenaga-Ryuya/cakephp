<?php
    echo $this->Html->css('menu');
?>

<div class="actionContainer menu">
    <ul>
        <li class="create">
            <?php
                echo $this->Html->link('登録画面',
                    array(
                        'controller' => 'Users',
                        'action' => 'store'
                    )
                );
            ?>
        </li>
        <li class="list">
            <?php
                echo $this->Html->link('一覧画面',
                    array(
                        'controller' => 'Users',
                        'action' => 'list'
                    )
                );
            ?>
        </li>
    </ul>
</div>