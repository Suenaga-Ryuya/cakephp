<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

	// ログイン
	Router::connect('/login', array('controller' => 'Users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'Users', 'action' => 'logout'));

	// メニュー
	Router::connect('/', array('controller' => 'Users', 'action' => 'menu'));

	// 一覧
	Router::connect('/list', array('controller' => 'Users', 'action' => 'list'));

	// 登録
	Router::connect('/store', array('controller' => 'Users', 'action' => 'store'));
	Router::connect('/storeComplete', array('controller' => 'Users', 'action' => 'storeComplete'));

	// 更新
	Router::connect('/edit', array('controller' => 'Users', 'action' => 'edit'));
	Router::connect('/updateComplete', array('controller' => 'Users', 'action' => 'updateComplete'));

	// 削除
	Router::connect('/delete', array('controller' => 'Users', 'action' => 'delete'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
