<?php

namespace Models;


class Orders {

    public $id;

	public static function getAllOrders ($page = NULL) {
		if (is_null($page)) $page = 1;
		$count = 30;
		$from = ($page - 1) * $count;
		$query = \App\Core::db()->query ("
			SELECT
				*
			FROM
				`orders`
			INNER JOIN `orders_data` ON `orders`.`orders_id`=`orders_data`.`orders_id`
			WHERE
				1
			LIMIT
				$from, $count
		");
		/*
			RIGHT JOIN `users` ON `orders`.`users_id`=`users`.`users_id`
			RIGHT JOIN `users` ON `orders`.`users_id`=`users`.`users_id`
		 */
		$result = $query->fetch_all (MYSQLI_ASSOC);
		return $result;
	}

    /**
     * function for creating a new order
     * @param $request
     *
     * @param $services = [
                'surgutch' =>
                    ['id' => ],
                'meal' =>
                    ['id' => ],
                'smell' =>
                    ['id' => ],
                'delivery' =>
                    ['id' => ,
                     'address' =>,
                     'nameWhom' =>],
                'burnt_edges' =>
               ];

     * @param $letter = [
                'templateId' => ,
                'customerText' => ,
                'comments' => ,
                'personalText' =>
                    ['description' => ,
                     'photo' => ,
                     'socialNetwors' => ]
                ];

     * @param   $price
    */
    public function createOrder($services, $letter, $price) {

        //set $id;
        return true;
    }

    public function getOrderPrice($id) {
        $price = 0;
        $queryString = 'SELECT `orders_data_price`
                    FROM  `orders_data`
                    WHERE `orders_data`.`orders_id`=?';
        if ($stmt = \App\Core::db()->prepare($queryString)) {
            $stmt->bind_param('i', $id);
            $stmt->bind_result($price);
            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
        }
        return $price;
    }

} 