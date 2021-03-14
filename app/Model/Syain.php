<?php

class Syain extends AppModel {
    // t_syainテーブルを使用
    public $useTable = 't_syain';

    // 社員Idを主キーに設定
    public $primaryKey = 'syain_id';

    // バリデーションの設定
    public $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => 'notBlank',
                'allowEmpty' => false,
                'message' => '氏名を正しく入力してください。'
            ),
            'rule2' => array(
                'rule' => array(
                    'maxLength', 20
                ),
                'allowEmpty' => false,
                'message' => '20文字以内で入力してください。'
            ),
        ),
        'seibetu' => array(
            'rule' => 'notBlank',
            'allowEmpty' => false,
            'message' => '性別を選択してください。'
        ),
        'birthday' => array(
            'rule1' => array(
                'rule' => 'notBlank',
                'allowEmpty' => false,
                'message' => '生年月日を正しく入力してください。'
            ),
            'rule2' => array(
                'rule' => array(
                    'date', 'ymd'
                ),
                'allowEmpty' => false,
                'message' => '/区切りで入力して下さい。'
            ),
        )
    );

}

?>