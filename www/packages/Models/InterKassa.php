<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 22.02.2015
 * Time: 19:44
 */

namespace Models;


class InterKassa {
	private $kassId = '';
	private $secretKassId = '';
	private $cur = 'UAH';
	private $desc = 'Оплата за письмо; Письмосыл.com';
	const DEBUG = true;

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
			\Annex\Dev::showArray ($params);
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
	}
} 