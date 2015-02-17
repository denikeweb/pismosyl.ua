<?php

	namespace Controllers;

	use Models\Templates;

    class Index {
		public function run () {
            $template = new Templates();
            $listTemplates = $template->getAllTemplatesCategoriesPreviews();
			echo \App\View::getIndexView (['c' => $listTemplates]);
		}
	}