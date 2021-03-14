<?php
App::uses('Sequence', 'Model');

/**
 * Sequence Test Case
 */
class SequenceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sequence'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sequence = ClassRegistry::init('Sequence');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sequence);

		parent::tearDown();
	}

}
