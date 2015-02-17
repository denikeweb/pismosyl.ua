<?php

	namespace Controllers;

	use Models\Templates;

    class Index {
		public function run () {
            $template = new Templates();
            $listTemplates = $template->getAllTemplatesCategoriesPreviews();
			$data = [
				'c' => $listTemplates
			];
			echo \App\View::getIndexView ($data);
		}
	}