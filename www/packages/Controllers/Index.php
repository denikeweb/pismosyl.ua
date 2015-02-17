<?php

	namespace Controllers;

	use Models\Services;
    use Models\Templates;

    class Index {
		public function run () {
            $template = new Templates();
            $listTemplates = $template->getAllTemplatesCategoriesPreviews();

            $templateText = $template->getTemplateText(1);

            $services = new Services();
            $servicesList = $services->getAllServicesList();

			$data = [
				'c' => $listTemplates,
				'templateText' => $templateText,
				'servicesList' => $servicesList
			];

			\Anex::showArray($templateText);
			\Anex::showArray($servicesList);
			echo \App\View::getIndexView ($data);
		}
	}