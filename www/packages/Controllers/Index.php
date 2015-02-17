<?php

	namespace Controllers;

	use Models\Services;
    use Models\Templates;

    class Index {
		public function run () {
            $template = new Templates();
<<<<<<< HEAD
            $listTemplates = $template->getAllTemplatesCategoriesPreviews();
			$data = [
				'c' => $listTemplates
			];
			echo \App\View::getIndexView ($data);
=======
            $templateText = $template->getTemplateText(1);
            \Anex::showArray($templateText);

            $services = new Services();
            $servicesList = $services->getAllServicesList();
            \Anex::showArray($servicesList);

			echo \App\View::getIndexView ($template);
>>>>>>> origin/master
		}
	}