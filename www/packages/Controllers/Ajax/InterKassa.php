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
			$this->jsonData = json_decode($_GET ['jsonData']);
			$method = 'method_' . $_GET ['method'];
			$this->$method ();
		} else
			exit ('Access error!');
	}

	public function method_redirect () {
		$orders = new \Models\Orders ();
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
		(new \Models\InterKassa())->redirect ();
	}
}