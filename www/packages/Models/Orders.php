<?php

namespace Models;


class Orders {

    public $id;
    private $services;
    private $letter;

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
     *              ['id' => ]
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

    /**TEST. TODO: оплату на 100 символів начислять
     * function for calculating price for order
     * @param $discount знижка у відсотках - впливає на закреслену ціну
     *
     * @return $price = [
     *                   'discount' => , ціна, яку платить користувач
     *                    'usual' => ];  ціна, яка показується закресленою
     */
    public function calculateOrderPrice($services, $letter,$discount){
        $START_PRICE = 300;
        $servicesList = new Services();
        $sum = 0;
        $sum += $START_PRICE;
        foreach ($services as $key => $value) {
            $sum += $servicesList->getServiceById($key,$value['id'])['price'];
        }

        $PRICE_TEMPLATE_LETTER = 2.67;
        $templateData = new Templates();
        $templateText = $templateData->getTemplateText($letter['templateId']);
        $templateLength = iconv_strlen($templateText, 'UTF-8')-2;
        $priceForTemplate = $templateLength * $PRICE_TEMPLATE_LETTER;
        $sum += $priceForTemplate;

        if (array_key_exists('customerText',$letter)) {
            $PRICE_CUSTOMER_LETTER = 5;
            $customerText = $letter['customerText'];
            $customerTextLength = iconv_strlen($customerText, 'UTF-8');
            $priceForCustomer = $customerTextLength * $PRICE_CUSTOMER_LETTER;
            $sum += $priceForCustomer;
        }

        $PROFIT = 700;
        $sum += $PROFIT;

        if (array_key_exists('personalText',$letter)){
            $PRICE_PERSONAL_TEXT = 4000;
            $sum += $PRICE_PERSONAL_TEXT;
        }

        $price['discount'] = round($sum/100.0,2);
        $price['usual'] = round($sum/(100 - $discount),2);
        return $price;
    }
} 