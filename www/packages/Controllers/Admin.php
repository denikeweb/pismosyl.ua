<?php

	namespace Controllers;

	class Admin {
		public function run () {
			session_start();
			$data = [];
			if (isset(\App\Router::$post ['admin_sign_in'])) {
				$login = \App\Router::$post ['login'];
				$pass = \App\Router::$post ['pass'];
				if ($login == 'admin' and $pass == 'qwertyparkW3d') {
					$_SESSION ['admin'] = true;
				}
			}
			if (isset(\App\Router::$post ['admin_sign_out'])) {
				unset ($_SESSION ['admin']);
			}
			if ($_SESSION ['admin'] === true) {
				$this->getAdminPageData($data);
				$files = [
					'content'  => 'admin_home',
					'template'  => 'template'
				];
			} else {
				$files = [
					'content'  => 'admin',
					'template'  => 'template'
				];
			}
			echo \App\View::getView ($files, $data);
		}

		public function getAdminPageData (&$data) {
			$data ['orders'] = \Models\Orders::getAllOrders (\App\Router::$get ['page']);

		}
	}