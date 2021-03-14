<?php
    echo $this->Html->css('login');
?>

<div class="actionContainer login">
    <?php echo $this->Form->create('user'); ?>
    <div class="login-form">

        <?php if ($this->Session->check('error')): ?>
            <label class="warning"><?php echo $this->Session->read('error'); ?></label>
        <?php endif; ?>
        <?php echo $this->Form->input('login_id', array('label' => 'ユーザーID：', 'type' => 'text')); ?>
        <?php echo $this->Form->input('password', array('label' => 'パスワード：', 'required' => false)); ?>
        <?php echo $this->Form->button('ログイン'); ?>
    </div>
</div>