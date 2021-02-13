<?php

class ManagementsController extends AppController {
  public $helpers = array('Html', 'Form');

  // notice デフォルトはindexメソッドが必要
  // notice ルートを設定したら必ず必要ではない
  public function index() {
    $this->set('msg', 'hello');
  }

  public function menu() {
    $this->set('msg', 'hello');
  }

  public function list() {
    $this->set('msg', 'morning');
  }

  public function store() {
    // 
  }

  public function update() {
    // 
  }
}

?>