<?php

	namespace App;

	abstract class Core {
		private static $db;
		private static $router;

		/**
		 * db connect by mysqli
		 */
		public static function connect()
		{
			//connect to db
			self::$db = new \mysqli(
				Config::get_db_server (),
				Config::get_db_username (),
				Config::get_db_userpass (),
				Config::get_db_name()
			);

            self::$db->query ("SET NAMES 'utf8'");

			// check connect
			if (self::$db->connect_errno)
				die ('MySQLi cann\'t connect with DataBase');
		}

		/**
		 * db disconnect
		 */
		public static function disconnect() {
			self::$db->close();
		}

		public static function app () {
			self::$router = new Router ();
			self::$router->runApp ();
		}

		public static function db() {
			return self::$db;
		}
		
		public static function router() {
			return self::$router;
		}

		public static function fetch_all ($result, $method = 'fetch_assoc') {
			$array = array ();
			while ($content = $result->$method ()) {
				$array [] = $content;
			}
			return $array;
		}
	}