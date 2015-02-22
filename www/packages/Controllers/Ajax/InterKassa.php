<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 22.02.2015
 * Time: 19:20
 */

namespace Controllers\Ajax;

/**
 * Class InterKassa
 *
 * @methods:
 *         redirect
 *         error
 *         response_handler
 *
 * @package Controllers\Ajax
 */
class InterKassa {
	private $jsonData;

	public function run () {
		if (isset ($_GET ['method']) and isset ($_GET ['jsonData'])) {
<<<<<<< HEAD
			$this->jsonData = json_decode($_GET ['jsonData'], true);
			\Annex\Annex::showArray($this->jsonData);
=======
			$this->dataConvert();
>>>>>>> origin/master
			$method = 'method_' . $_GET ['method'];
			$this->$method ();
		} else
			exit ('Access error!');
	}

    private function dataConvert() {
        $customerData = json_decode($_GET ['jsonData']);
        $services['surgutch']['id'] = $customerData['services']['surgutchId'];
        $services['smell']['id'] = $customerData['services']['smellId'];
        $services['meal']['id'] = $customerData['services']['mealId'];
        $services['burnt_edges']['id'] = $customerData['services']['burnt_edgesId'];
        $services['delivery'] = $customerData['services']['delivery'];

        $this->jsonData['services'] = $services;
        $this->jsonData['letter'] = $customerData['letter'];
        $this->jsonData['customerContacts'] = $customerData['customerContacts'];
    }

	public function method_redirect () {
		$orders = new \Models\Orders ();
		$hasErrors = $orders->checkCorrectness(
			$this->jsonData ['services'],
			$this->jsonData ['letter']
		);
		if ($hasErrors !== true)
			exit ('Ошибка валидации!');
		$price = $orders->getCalcPrice(
			$this->jsonData ['services'],
			$this->jsonData ['letter']
		);
		$orderId = $orders->createOrder (
			$this->jsonData ['services'],
			$this->jsonData ['letter'],
			$this->jsonData ['customerContacts'],
			$price
		);
		(new \Models\InterKassa())->redirect ($orderId, $price);
	}

	public function method_error () {
		echo 'Произошла ошибка';
	}

	public function method_response_handler () {
		(new \Models\InterKassa())->handle ();
	}
}