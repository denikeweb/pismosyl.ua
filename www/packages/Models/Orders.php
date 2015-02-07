<?php

namespace Models;


class Orders {
	public static function getAllOrders ($page = NULL) {
		if (is_null($page)) $page = 1;
		$count = 30;
		$from = ($page - 1) * $count;
		$query = \App\Core::db()->query ("SELECT * FROM `orders` WHERE 1 LIMIT $from, $count");
		$result = $query->fetch_all ();
		return $result;
	}
} 