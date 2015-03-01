<?php

	namespace Controllers;

	use Models\Orders;
    use Models\Services;
    use Models\Templates;

    class Index {
		public function run () {
            $template = new Templates();
            $listTemplates = $template->getAllTemplatesCategoriesPreviews();

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
                    'meal' =>
                        ['id' => 1],
                    'delivery' =>
                        ['id' => 2,
                         'address' => 'м. Київ, вул. Київська 21',
                         'nameWhom' => 'Софія Крушельницька'],
                    'burnt_edges' =>
                        ['id' => 1]
               ];

            $letter = [
                'templateId' => '1',
                'commentsPersonalText' => 'sdfsfsgjshfks hfdhskfhds k'
                ];
			$userData = [  'email' => 'den@lux-blog.org',
	                        'phone' => '097 888 88 44',
	                        'name' => 'Lacosta'
	                      ];
            $order->calculateOrderPrice($services, $letter);
            $order->setOrderData ($services, $letter, $userData);
            //$discount = 20;
            //$query = $order->createOrder($services, $letter,$userData,$discount);
            //\Annex\Annex::showArray($query);
            //$errors = $order->checkCorrectness();
            //\Anex::showArray($templates);
			//\Anex::showArray($templateText);
			//\Anex::showArray($servicesList);
			echo \App\View::getIndexView ($data);
		}
	}