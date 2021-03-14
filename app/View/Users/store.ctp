<?php
    echo $this->Html->css('form');
?>


<div class="actionContainer store">
    <?php echo $this->Form->create('syain', array(
        'url' => array(
            'controller' => 'Users',
            'action' => 'storeComplete'
        )
    )); ?>
    <div class="store-form">
        <ul>
            <li>
                <div>
                    <?php if (!empty($errors['name'][0])): ?>
                    <label class="warning"><?php print_r($errors); ?></label>
                    <?php endif; ?>
                    <?php echo $this->Form->input('name', array('label' => '氏名：', 'value' => $datas['name'] ?? '')); ?>
                </div>
            </li>
            <li>
                <div>
                    <?php if (!empty($errors['seibetu'][0])): ?>
                    <label class="warning"><?php echo $errors['seibetu'][0]; ?></label>
                    <?php endif; ?>
                    <div class="gender">
                        <label for="syainSeibetu">性別：</label>
                        <?php echo $this->Form->input('seibetu', array(
                        'options' => array('1' => '男', '2' => '女'),
                        'value' => $datas['seibetu'] ?? '',
                        'type' => 'radio',
                        'legend' => false
                        )); ?>
                    </div>
                </div>
            </li>
            <li>
                <div>
                    <?php if (!empty($errors['birthday'][0])): ?>
                    <label class="warning"><?php echo $errors['birthday'][0]; ?></label>
                    <?php endif; ?>
                    <?php echo $this->Form->input('birthday', array('label' => '生年月日：', 'value' => $datas['birthday'] ?? '')); ?>
                </div>
            </li>
        </ul>

        <div class="btn">
            <?php echo $this->Form->button('登録', array('name' => 'status', 'value' => 'store')); ?>
            <?php echo $this->Form->button('戻る', array('name' => 'status', 'value' => 'back')); ?>
        </div>
    </div>
</div>