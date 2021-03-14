<?php
    echo $this->Html->css('list');
?>

<div class="actionContainer list">
    <div class="controllers">
        <p>検索条件</p>
        <div class="search">

            <?php echo $this->Form->create('syain') ?>
            <div class="search-form">
                <?php echo $this->Form->input('name', array(
                    'label' => '氏名：'
                )); ?>
                <?php echo $this->Form->button('検索'); ?>
            </div>
            <?php echo $this->Form->end(); ?>

            <?php echo $this->Html->link('戻る', array(
                'controller' => 'Users',
                'action' => 'menu'
            ),
            array(
                'class' => 'button'
            )); ?>
        </div>
    </div>

    <div class="member-list">
        <table>
            <thead>
                <tr>
                    <th class="memberId">社員ID</th>
                    <th class="name">氏名</th>
                    <th class="gender">性別</th>
                    <th class="birthday">生年月日</th>
                    <th class="options"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <th><?php echo $user['Syain']['syain_id']; ?></th>
                            <th><?php echo $user['Syain']['name']; ?></th>
                            <th><?php echo $user['Syain']['seibetu'] == '1' ? '男' : '女'; ?></th>
                            <th><?php echo $user['Syain']['birthday']; ?></th>
                            <th>
                                <div class="btn">
                                    <!-- 更新ボタン -->
                                    <?php echo $this->Form->postButton('選択', array(
                                        'controller' => 'Users',
                                        'action' => 'edit',
                                    ),
                                    array(
                                        'name' => 'syain_id',
                                        'value' => $user['Syain']['syain_id']
                                    )); ?>

                                    <!-- 削除ボタン -->
                                    <?php echo $this->Form->postButton('削除', array(
                                        'controller' => 'Users',
                                        'action' => 'delete',
                                    ),
                                    array(
                                        'name' => 'syain_id',
                                        'value' => $user['Syain']['syain_id']
                                    )); ?>
                                    
                                </di>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>