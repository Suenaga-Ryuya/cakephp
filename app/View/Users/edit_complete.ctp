<?php
    echo $this->Html->css('form_complete');
?>

<div class="actionContainer form_complete">
    <div class="confirm">
        <?php echo $this->Form->create('syain', array(
            'url' => array(
                'controller' => 'Users',
                'action' => 'list'
            ),
            'type' => 'get',
        )); ?>
        <div class="confirm-window">
            <ul>
                <li class="success">更新が完了しました。</li>
                <li>
                    <p class="key">社員ID：</p>
                    <p class="value"><?php echo $datas['syain_id']; ?></p>
                </li>
                <li>
                    <p class="key">氏名：</p>
                    <p class="value"><?php echo $datas['name']; ?></p>
                </li>
                <li>
                    <p class="key">性別：</p>
                    <p class="value"><?php echo $datas['seibetu'] == 1 ? '男' : '女'; ?></p>
                </li>
                <li>
                    <p class="key">生年月日：</p>
                    <p class="value"><?php echo $datas['birthday']; ?></p>
                </li>
            </ul>
    
            <div class="btn">
                <?php echo $this->Form->button('戻る', array('type' => 'get')); ?>
            </div>
        </div>
    </div>
</div>