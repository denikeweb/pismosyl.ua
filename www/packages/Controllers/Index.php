<?php

	namespace Controllers;

	use Models\Templates;

    class Index {
		public function run () {
            $temp = new Templates();
            $temp->getAllTemplatesCategoriesPreviews();
			echo \App\View::getIndexView ();
		}
	}