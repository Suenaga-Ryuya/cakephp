<?php

App::uses('AppController', 'Controller');


class UsersController extends AppController {
    // HtmlヘルパーとFormヘルパーを使用
    public $helpers = array('Html', 'Form');


    // ログイン
    public function login() {
        // ログインに必要なデータを参照するためにUserモデルをロード
        $this->loadModel('User');

        // ログインしているユーザー名を表示するためにSyainモデルをロード
        $this->loadModel('Syain');

        if (!empty($this->request->is('post'))) {
            // ログインに使用されたユーザーIDをもとに該当のデータをDBから取得
            $loginUser = $this->User->find('first', array(
                'conditions' => array(
                    'login_id' => $this->request->data['user']['login_id']
                    )
                )
            );

            // 該当ユーザーが存在した場合
            if (!empty($loginUser)) {

                // ログインに使用されたパスワードを変数に代入
                $loginPassword = $this->request->data['user']['password'];
                
                // ログインしようとしているユーザーのパスワードが保存されているものと合致するか検証
                $checkUser = $loginUser['User']['password'] == $loginPassword ? true : false;
                
                if ($checkUser) { // パスワードが合致した場合
                    // エラーメッセージがある場合は削除
                    $this->Session->delete('error');

                    // ログインしているユーザーの名前を取得
                    $userName = $this->Syain->field('name', array('Syain.syain_id' => $loginUser['User']['syain_id']));
                    // ログインしているユーザーのログインIdを取得
                    $loginId = $this->User->field('login_id', array('User.syain_id' => $loginUser['User']['syain_id']));
                    

                    $this->Session->write('status', 'logined');
                    $this->Session->write('username', $userName);
                    $this->Session->write('loginid', $loginId);

                    // メニュー画面へリダイレクト
                    $this->redirect(array('controller' => 'Users', 'action' => 'menu'));
                } else { // パスワードが合致しなかった場合
                    
                    $this->Session->write('error', 'パスワードが間違っています。');

                    // ログイン画面へリダイレクト
                    $this->redirect(array('controller' => 'Users', 'action' => 'login'));
                }
            } else { // 該当ユーザーが存在しなかった場合
                $this->Session->write('error', '認証に失敗しました。');

                // ログイン画面へリダイレクト
                $this->redirect(array('controller' => 'Users', 'action' => 'login'));
            }
        }
    }


    // ログアウト
    public function logout() {
        $this->Session->delete('status');
        $this->redirect(array('controller' => 'Users', 'action' => 'login'));
    }


    // メニュー画面
    public function menu() {
        // 未ログインの状態の場合、ログイン画面にリダイレクト
        $this->checkLoginStatus();
        // ログインしているユーザー名を取得
        $this->getLoginedUser();
    }
    


    // 一覧画面
    public function list() {
        // 未ログインの状態の場合、ログイン画面にリダイレクト
        $this->checkLoginStatus();

        // ログインしているユーザー名を取得
        $this->getLoginedUser();

        // 名簿一覧に表示する情報を参照するためにSyainモデルをロード
        $this->loadModel('Syain');

        if ($this->request->is('post')) { // 検索機能を使用した場合の処理
                // 該当する「名(ファーストネーム)」のデータを取得
                $users = $this->Syain->find('all', array(
                    'conditions' => array(
                        'Syain.name LIKE' => "%" . $this->request->data['syain']['name']
                    )
                )
            );
        } else { // 初期表示
            $users = $this->Syain->find('all');
        }

        // ビューに一覧情報を渡す
        $this->set(compact('users'));
    }


    // 登録画面
    public function store() {
        // 未ログインの状態の場合、ログイン画面にリダイレクト
        $this->checkLoginStatus();

        // ログインしているユーザー名を取得
        $this->getLoginedUser();

        // バリデーションに引っかかった場合の送信データとエラーメッセージを保持
        $this->checkErrorAndValues();
    }


    // 登録完了画面
    public function storeComplete() {
        // 未ログインの状態の場合、ログイン画面にリダイレクト
        $this->checkLoginStatus();

        // ログインしているユーザー名を取得
        $this->getLoginedUser();

        // 名簿に新規登録する情報を保存するためにSyainモデルをロード
        $this->loadModel('Syain');
        // 社員Idを作成するための連番を取得するためSequenceモデルをロード
        $this->loadModel('Sequence');

        // 戻るボタンが押された場合、メニュー画面に戻る
        if ($this->request->data['status'] == 'back') {
            return $this->redirect(
                array(
                    'controller' => 'Users',
                    'action' => 'menu'
                )
            );
        }

        // 新規登録する社員IDを生成
        $syain_id = $this->Sequence->generateId();

        // 保存内容を配列の変数に代入
        $datas = array(
            'syain_id' => $syain_id,
            'name' => $this->request->data['syain']['name'],
            'seibetu' => $this->request->data['syain']['seibetu'],
            'birthday' => $this->request->data['syain']['birthday'],
            'entry_date' => strval(date('Y-m-d H.i.s')),
            'entry_user' => $this->Session->read('loginid')
        );

        // 登録する情報をバリデーションして保存もしくは入力画面にリダイレクト
        $this->checkInputData($datas, $this->request->data['status']);

    }


    // 更新画面
    public function edit() {
        // 未ログインの状態の場合、ログイン画面にリダイレクト
        $this->checkLoginStatus();
        
        // ログインしているユーザー名を取得
        $this->getLoginedUser();

        // 名簿一覧に表示する情報を参照するためにSyainモデルをロード
        $this->loadModel('Syain');
        // 更新する社員の社員番号を取得
        $user = $this->Syain->findBySyainId($this->request->data['syain_id']);

        // バリデーションに引っかかった場合の送信データとエラーメッセージを保持
        $this->checkErrorAndValues();

        // ビューに一覧情報を渡す
        $this->set(compact('user'));
    }


    // 更新完了画面
    public function editComplete() {
        // 未ログインの状態の場合、ログイン画面にリダイレクト
        $this->checkLoginStatus();
        // 名簿に存在する情報を更新するためにSyainモデルをロード
        $this->loadModel('Syain');
        // ログインしているユーザー名を取得
        $this->getLoginedUser();


        // 戻るボタンが押された場合、一覧画面に戻る
        if ($this->request->data['status'] == 'back') {
            return $this->redirect(
                array(
                    'controller' => 'Users',
                    'action' => 'list'
                )
            );
        }

        // 更新内容を配列の変数に代入
        $datas = array(
            'syain_id' => $this->request->data['syain']['syain_id'],
            'name' => $this->request->data['syain']['name'],
            'seibetu' => $this->request->data['syain']['seibetu'],
            'birthday' => $this->request->data['syain']['birthday'],
            'update_date' => strval(date('Y-m-d H.i.s')),
            'update_user' => $this->Session->read('loginid')
        );

        // 更新する情報をバリデーションして更新もしくは入力画面にリダイレクト
        $this->checkInputData($datas, $this->request->data['status']);
    }


    // 削除機能
    public function delete() {
        // 未ログインの状態の場合、ログイン画面にリダイレクト
        $this->checkLoginStatus();

        // 名簿一覧に表示する情報を参照するためにSyainモデルをロード
        $this->loadModel('Syain');

        // 削除対象のデータを削除
        $this->Syain->deleteAll(array('Syain.syain_id' => $this->request->data['syain_id']), false);

        // 一覧画面にリダイレクト
        return $this->redirect(array('Controller' => 'Users', 'action' => 'list'));
    }


}

?>