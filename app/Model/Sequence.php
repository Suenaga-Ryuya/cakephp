<?php
App::uses('AppModel', 'Model');
/**
 * Sequence Model
 *
 */
class Sequence extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sequence';

    // 社員Id生成用のメソッド
    public function generateId() {
        // 現在の西暦を取得
        $year = date('Y');

        // 連番に使用する数値を取得
        $serial = $this->field(
            'num',
            array('purpose' => 'serial')
        );

        // 1加算し、データを更新
        $id = ++$serial;
        $this->updateAll(
            array('Sequence.num' => $id),
            array('Sequence.purpose' => 'serial')
        );

        // 社員Idを生成
        $syain_id = $year . '-' . str_pad(strval($id), 3, 0, STR_PAD_LEFT);

        // 社員Idを返す
        return $syain_id;
    }
}
