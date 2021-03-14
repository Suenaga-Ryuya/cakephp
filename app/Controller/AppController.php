<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    // ログイン済みかどうかを確認するメソッド
    public function checkLoginStatus() {
        if ($this->Session->check('status') != 'logined') {
            $this->redirect(array('controller' => 'Users', 'action' => 'login'));
        }

        return;
    }

    // ログインしているユーザーの情報を渡すメソッド
    public function getLoginedUser() {
        $this->Session->check('username');
        $username = $this->Session->read('username');

        $this->set(compact('username'));

    }

    // バリデーションで引っかかった場合のデータを保持するメソッド
    public function checkErrorAndValues() {

        if ($this->Session->check('errors')) {
            $errors = $this->Session->read('errors');
            $this->Session->delete('errors');
        }
        
        if ($this->Session->check('datas')) {
            $datas = $this->Session->read('datas');
            $this->Session->delete('datas');
        }

        $this->set(compact('errors', 'datas'));
    }


    // 入力された情報のバリデーションをするメソッド
    public function checkInputData($datas, $status) {
        // バリデーションを行うためにモデルにデータをセット
        $this->Syain->set($datas);

        if ($this->Syain->validates()) { // バリデーションが成功した場合(データが正しい場合)
            $this->Syain->save();
            $this->set('datas', $datas);
        } else { // バリデーションが失敗した場合(データが不正の場合)
            $errors = $this->Syain->validationErrors;
            $this->Session->write('errors', $errors);
            $this->Session->write('datas', $datas);

            if ($status == 'store') {
                $this->redirect(array('controller' => 'Users', 'action' => 'store'));
            } elseif ($status == 'edit') {
                $this->redirect(array('controller' => 'Users', 'action' => 'edit'));
            }
        }
    }
}
