<?php
/**
 * Sequence Fixture
 */
class SequenceFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'sequence';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'purpose' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'num' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'purpose' => 'Lorem ip',
			'num' => 1
		),
	);

}
