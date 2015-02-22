<?php

	namespace App;

	class Config {
		const VIEW_PATH = 'Views';

		const DB_SERVER     = '127.0.0.1';
		const DB_USERNAME   = 'root';
		const DB_USERPASS   = '';
		const DB_NAME       = 'awm_14_ps2';

		public static function get_db_server () 	{return self::DB_SERVER;}
		public static function get_db_username () 	{return self::DB_USERNAME;}
		public static function get_db_userpass () 	{return self::DB_USERPASS;}
		public static function get_db_name () 		{return self::DB_NAME;}
	}