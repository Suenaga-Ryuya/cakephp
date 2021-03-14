<?php
    echo $this->Html->css('form_complete');
?>

<div class="actionContainer form_complete">
    <div class="confirm">
        <?php echo $this->Form->create('syain', array(
            'url' => array(
                'controller' => 'Users',
                'action' => 'menu'
            ),
            'type' => 'get',
        )); ?>
        <div class="confirm-window">
            <ul>
                <li class="success">登録が完了しました。</li>
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
                <?php echo $this->Form->button('戻る'); ?>
            </div>
        </div>
    </div>
</div>