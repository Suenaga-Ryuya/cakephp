<?php
    echo $this->Html->css('login');
?>

<div class="actionContainer login">
    <?php echo $this->Form->create('syain'); ?>
    <div class="login-form">
        <?php echo $this->Form->input('username', array('label' => 'ユーザーID：')); ?>
        <?php echo $this->Form->input('password', array('label' => 'パスワード：')); ?>
        <?php echo $this->Form->button('ログイン'); ?>
    </div>
</div>