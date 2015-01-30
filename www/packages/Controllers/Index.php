<?php

	namespace Controllers;

	class Index {
		public function run () {
			echo \App\View::getIndexView ();
		}
	}