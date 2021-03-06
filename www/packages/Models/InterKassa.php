<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 22.02.2015
 * Time: 19:44
 */

namespace Models;


class InterKassa {
	private $kassId = '54d4da12bf4efcbf0d441ccf';
	private $ik_key = 'TyFQbIgXHFgXKhBm';
	private $test_ik_key = 'gYNvFFaiEmFBR7WN';
	private $cur = 'UAH';
	private $desc = 'Оплата за письмо; Письмосыл.com';
	const DEBUG = false;
	const TEST_MODE = false;

	public function redirect ($id, $price) {
		$comment = '';
		$params = [
			'ik_co_id' => $this->kassId,
			'ik_pm_no' => $id,
			'ik_am' => $price,
			'ik_cur' => $this->cur,
			'ik_desc' => $this->desc
		];
		if (self::DEBUG) {
			$comment = '//';
			\Annex\Annex::showArray ($params);
		}
		echo '<html>
			<head>
				<meta charset="utf-8">
				<title>Идет перенаправление на страницу оплаты...</title>
			</head>
			<body>
			Идет перенаправление на страницу оплаты...', '<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/"
				enctype="utf-8">
					<input type="hidden" name="ik_co_id" value="'.$params ["ik_co_id"].'" />
					<input type="hidden" name="ik_pm_no" value="'.$params ["ik_pm_no"].'" />
					<input type="hidden" name="ik_am" value="'.$params ["ik_am"].'" />
					<input type="hidden" name="ik_cur" value="'.$params ["ik_cur"].'" />
					<input type="hidden" name="ik_desc" value="'.$params ["ik_desc"].'" />
			        <!--input type="submit" value="Pay"-->
				</form>
				<script>
					'.$comment.'document.getElementById("payment").submit ();
				</script>
			</body>
		</html>';
		\Annex\Files::writeToEnd('logs_ik.txt', 'one rand');
	}

	public function handle () {
		\Annex\Files::writeToEnd('logs_ik.txt', '1ds');
		$order = new \Models\Orders();
		$ik_key = (!self::TEST_MODE) ? $this->ik_key : $this->test_ik_key;
		$dataSet = $_POST;
		ob_start();
		print_r($_POST);
		$content = ob_get_clean();
		\Annex\Files::writeToEnd('logs_ik.txt', $content);
		$id = $dataSet['ik_pm_no'];
		$price = $order->getOrderPrice($id);
		if (!isset($dataSet ['ik_sign']))
			die ('Error: input data not exist');
		$ik_sign = $dataSet ['ik_sign'];
		unset($dataSet['ik_sign']); // видаляємо з даних строку підпису
		ksort ($dataSet, SORT_STRING); // сортуємо по ключам в алфавітному порядку елементи масиву
		array_push ($dataSet, $ik_key); // додаємо в кінець масиву "секретний ключ"
		$signString = implode (':', $dataSet); // конкатенуємо значення через символ ":"
		$sign = base64_encode (md5 ($signString, true)); // беремо MD5 хеш в бінарному вигляді по
		//сформованому рядку і кодуємо в BASE64
		$status = $dataSet['ik_inv_st'] == 'success';
		$result = $ik_sign == $sign;
		$tmpSum = $price;
		$correctSumm =  ($dataSet['ik_co_rfn'] > $tmpSum - 1 || $dataSet['ik_co_rfn'] < $tmpSum + 1);
		if ($result && $status && $correctSumm) {
			// notification about success payment, changes in database
			$order->setPaid ($id);
		} else
			die  ('Error: faulty input data');
	}
}