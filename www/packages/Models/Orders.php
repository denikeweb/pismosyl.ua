<?php

namespace Models;


class Orders {
	public static function getAllOrders ($page = NULL) {
		if (is_null($page)) $page = 1;
		$count = 30;
		$from = ($page - 1) * $count;
		$query = \App\Core::db()->query ("
			SELECT
				*
			FROM
				`orders`
			RIGHT JOIN `users` ON `orders`.`users_id`=`users`.`users_id`
			RIGHT JOIN `users` ON `orders`.`users_id`=`users`.`users_id`
			INNER JOIN `orders_data` ON `orders`.`orders_id`=`orders_data`.`orders_id`
			WHERE
				1
			LIMIT
				$from, $count
		");
		$result = $query->fetch_all (MYSQL_ASSOC);
		return $result;
	}
} 