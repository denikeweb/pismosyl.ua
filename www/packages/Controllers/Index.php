<?php

	namespace Controllers;

	use Models\Orders;
    use Models\Services;
    use Models\Templates;

    class Index {
		public function run () {
            $template = new Templates();
            $listTemplates = $template->getAllTemplatesCategoriesPreviews();

            $templateText = $template->getTemplateText(2);

            $services = new Services();
            $servicesList = $services->getAllServicesList();

            //TODO:
            $templatesText = $templateText;

			$data = [
				'c' => $listTemplates,
				//'templateText' => $templateText,
				'servicesList' => $servicesList,
                'firstText' => $templatesText
			];

            $order = new Orders();
            $price = $order->getOrderPrice(2);

           $services = [
                    'surgutch' =>
                        ['id' => 1],
                    'smell' =>
                        ['id' => 1],
                    'meal' =>
                        ['id' => 1],
                    'delivery' =>
                        ['id' => 2],
                    'burnt_edges' =>
                        ['id' => 1]
               ];

            $letter = [
                'templateId' => '1'
                ];
            $order->setOrderData($services,$letter);
            $price = $order->calculateOrderPrice(20);
            $errors = $order->checkCorrectness();
            $templates = $template->substitutePattern($templatesText);
            \Anex::showArray($templates);
			//\Anex::showArray($templateText);
			//\Anex::showArray($servicesList);
			echo \App\View::getIndexView ($data);
		}
	}