<?php
    echo $this->Html->css('form');
?>


<div class="actionContainer update">
    <?php echo $this->Form->create('syain', array(
        'url' => array(
            'controller' => 'Users',
            'action' => 'editComplete'
        )
    )); ?>
    <div class="update-form">

        <ul>
            <li class="memberId">
                <p class="key">社員ID：</p>
                <p class="value"><?php echo $user['Syain']['syain_id'] ?? $datas['syain_id']; ?></p>
                <?php echo $this->Form->hidden('syain_id', array(
                    'value' => $user['Syain']['syain_id'] ?? $datas['syain_id']
                )); ?>
            </li>
            <li>
                <div>
                    <?php if (!empty($errors['name'][0])): ?>
                    <label class="warning"><?php echo $errors['name'][0]; ?></label>
                    <?php endif; ?>
                    <?php echo $this->Form->input('name', array('label' => '氏名：', 'value' => $user['Syain']['name'] ?? $datas['name'], 'required' => false)); ?>
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
                        'type' => 'radio',
                        'value' => $user['Syain']['seibetu'] ?? $datas['seibetu'],
                        'legend' => false,
                        'required' => false
                        )); ?>
                    </div>
                </div>
            </li>
            <li>
                <div>
                    <?php if (!empty($errors['birthday'][0])): ?>
                    <label class="warning"><?php echo $errors['birthday'][0]; ?></label>
                    <?php endif; ?>
                    <?php echo $this->Form->input('birthday', array('label' => '生年月日：', 'value' => $user['Syain']['birthday'] ?? $datas['birthday'], 'required' => false)); ?>
                </div>
            </li>
        </ul>

        <div class="btn">
            <?php echo $this->Form->button('更新', array('name' => 'status', 'value' => 'edit')); ?>
            <?php echo $this->Form->button('戻る', array('name' => 'status', 'value' => 'back')); ?>
        </div>

    </div>
</div>