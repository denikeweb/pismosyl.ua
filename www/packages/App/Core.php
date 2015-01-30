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
				config::get_db_server (),
				config::get_db_username (),
				config::get_db_userpass (),
				config::get_db_name()
			);

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
			self::$router = new router ();
			self::$router->runApp ();
		}

		public static function db() {
			return self::$db;
		}
		
		public static function router() {
			return self::$router;
		}
	}