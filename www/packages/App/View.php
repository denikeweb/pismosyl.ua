<?php

	namespace App;

	class View {
		/**
		 * return default view template
		 *
		 * @return string
		 */
		public static function getIndexView () {
			$page = 'index';
			$template = 'template';
			
			$files = array(
				'constructor'  => 'constructor',
				'content'  => $page,
				'template'  => $template
			);
			return self::getView ($files);
		}

		/**
		 *
		 * @param $files --required key 'template' must be lost
		 *
		 *      $files = [
		 *       'key1'      => 'file1',
		 *       'key2'      => 'file2',
		 *       'template'  => 'template'
		 *      ]
		 *  or
		 *      $files = 'filename';
		 *
		 * @return string
		 */
		public static function getView ($files, $data = NULL) {
			if (!is_null($data)) extract($data);
			if (is_string ($files)) {
				$filename = $files;
				$files = array ();
				$files ['template'] = $filename;
			}
			foreach ($files as $var_name => $filename) {
				ob_start();
				$full_filename = Config::VIEW_PATH.DIRSEP.$filename.EXT;
				if (is_file($full_filename)) {
					include $full_filename;
					$$var_name = ob_get_clean ();
				} else {
					ob_end_clean();
				}
			}
			if (isset ($template)) {
				return $template;
			} else
				return 'Error: view not found';
		}
	}