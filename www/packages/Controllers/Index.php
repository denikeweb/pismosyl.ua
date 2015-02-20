<?php

	namespace Controllers;

	use Models\Orders;
    use Models\Services;
    use Models\Templates;

    class Index {
		public function run () {
            $template = new Templates();
            $listTemplates = $template->getAllTemplatesCategoriesPreviews();

            //$templateText = $template->getTemplateText(1);

            $services = new Services();
            $servicesList = $services->getAllServicesList();

			$data = [
				'c' => $listTemplates,
				//'templateText' => $templateText,
				'servicesList' => $servicesList
			];

            $order = new Orders();
            $price = $order->getOrderPrice(2);

           $services = [
                    'surgutch' =>
                        ['id' => 1],
                    'smell' =>
                        ['id' => 1],
                    'delivery' =>
                        ['id' => 2],
                    'burnt_edges' =>
                        ['id' => 1]
               ];

            $letter = [
                'templateId' => '1',
                'personalText' =>
                    ['description' => 'dfsfsdsdf']
                ];
            $price = $order->calculateOrderPrice($services,$letter,20);
            \Anex::showArray($price);
			//\Anex::showArray($templateText);
			//\Anex::showArray($servicesList);
			echo \App\View::getIndexView ($data);
		}
	}