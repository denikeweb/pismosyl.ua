<?php

namespace Models;


class Orders
{

    public $id;

    private $services;
    private $letter;
    private $user;

    public static function getAllOrders($page = NULL)
    {
        if (is_null($page)) $page = 1;
        $count = 30;
        $from = ($page - 1) * $count;
        $query = \App\Core::db()->query("
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
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function setOrderData($services, $letter, $user)
    {
        $this->services = $services;
        $this->letter = $letter;
        $this->user = $user;
    }

    //TODO: Зробити перевірку всіх параметрів, щоб була безпечна робота із БД
    //TODO: 1) Поставить у Values кавички
    //TODO: 2) у всіх рядках проеккранувати дані (створити змінні)
    /**
     * function for creating a new order
     *
     * @param $services = [
     * 'surgutch' =>
     * ['id' => ],
     * 'meal' =>
     * ['id' => ],
     * 'smell' =>
     * ['id' => ],
     * 'delivery' =>
     * ['id' => ,
     * 'address' =>,
     * 'nameWhom' =>],
     * 'burnt_edges' =>
     *              ['id' => ]
     * ];
     * @param $letter = [
     * 'templateId' => ,
     * 'customerText' => ,
     * 'commentsPersonalText' => ,
     * ];
     * @param   $customerContacts = [ 'email' => ,
     *                                'phone' => ,
     *                                'name' =>
     *                              ]
     * @param   $price - ціна у гривнях з копійками
     */
    public function createOrder($services, $letter, $customerContacts, $price)
    {
        $userId = $this->createUser($customerContacts);
        if ($userId != 0) {
            $addOrderTableCols = 'INSERT INTO `orders_data`(`orders_data_status`,';
            $addOrderValues = ' VALUES(\'0\',';

            if (array_key_exists('surgutch', $services)) {
                $addOrderTableCols .= '`surguch_id`,';
                $addOrderValues .= '\''.$services['surgutch']['id'] . '\',';
            }
            if (array_key_exists('smell', $services)) {
                $addOrderTableCols .= '`smell_id`,';
                $addOrderValues .= '\''.$services['smell']['id'] . '\', ';
            }
            if (array_key_exists('eat_id', $services)) {
                $addOrderTableCols .= '`eat_id`,';
                $addOrderValues .= '\''.$services['meal']['id'] . '\', ';
            }
            if (array_key_exists('burnt_edges', $services)) {
                $addOrderTableCols .= '`orders_data_burnt_edges`,';
                $addOrderValues .= '\''.$services['burnt_edges']['id'] .'\', ';
            }

            $addOrderTableCols .= '`delivery_id`, `orders_data_to`, `orders_data_whom`,';
            $addOrderValues .= '\''.$services['delivery']['id'] .'\',\'' . $services['delivery']['address'] . '\','
                . '\'' . $services['delivery']['nameWhom'] . '\',';

            if (array_key_exists('templateId', $letter)) {
                $addOrderTableCols .= '`templates_id`,';
                $addOrderValues .= '\''.$letter['templateId'] . '\',';
            }

            if (array_key_exists('customerText', $letter)) {
                $addOrderTableCols .= '`orders_data_text`,';
                $addOrderValues .= '\''.$letter['customerText'] . '\',';
            }

            if (array_key_exists('commentsPersonalText', $letter)) {
                $needCopywriting = 1;
                $addOrderTableCols .= '`orders_data_details`, `orders_data_need_copywriting`,';
                $addOrderValues .= '\''.$letter['commentsPersonalText'] . '\',\'' . $needCopywriting . '\',';
            }

            $payed = 0;
            $addOrderTableCols .= '`orders_data_price`,`orders_data_payed`,';
            $addOrderValues .= '\''.($price * 100) . '\',\'' . $payed . '\',';

            $addOrderTableCols .= '`user_id`) ';
            $addOrderValues .= '\''.$userId . '\')';

            $addOrderQuery = $addOrderTableCols . $addOrderValues;
        }
        $res = \App\Core::db()->query($addOrderQuery);
        $id = \App\Core::db()->insert_id;
        return $id;
    }

    private function createUser($customerContacts)
    {
        $insertUserQuery = 'INSERT INTO `users`(`users_email`,`users_phone`, `users_name`)
                            VALUES(\'?\',\'?\',\'?\')';
        if ($stmt = \App\Core::db()->prepare($insertUserQuery)) {
	        $email = htmlspecialchars($customerContacts['email']);
	        $phone = htmlspecialchars($customerContacts['phone']);
	        $name = htmlspecialchars($customerContacts['name']);
            $stmt->bind_param('sss', $email, $phone, $name);
            $stmt->execute();
            $id = \App\Core::db()->insert_id;
            $stmt->close();
        }
        return $id;
    }

    //TODO: перевірити на помилки і зробити реакцію адекватну на них
    public function getOrderPrice($id)
    {
        $price = 0;
        //$id = intval($id);
        $queryString = "SELECT `orders_data_price`
                    FROM  `orders_data`
                    WHERE `orders_data`.`orders_id`=?";
        if ($stmt = \App\Core::db()->prepare($queryString)) {
            $stmt->bind_param('i', $id);
            $stmt->bind_result($price);
            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
        }
        return $price;
    }

	private function getDiscount () {
		return 20;
	}

	public function getCalcPrice ($services = null, $letter = null) {
		return $this->calculateOrderPrice($services = null, $letter = null) ['discount'];
	}

    /**TEST. TODO: оплату на 100 символів начислять
     * function for calculating price for order
     * @param $discount знижка у відсотках - впливає на закреслену ціну
     *
     * @return $price = [
     *                   'discount' => , ціна, яку платить користувач
     *                    'usual' => ];  ціна, яка показується закресленою
     */
    public function calculateOrderPrice($services = null, $letter = null) {
	    $discount = $this->getDiscount();

        if (is_null($services))
            $services = $this->services;
        if (is_null($letter))
            $letter = $this->letter;

        $START_PRICE = 300;
        $servicesList = new Services();
        $sum = 0;
        $sum += $START_PRICE;
        foreach ($services as $key => $value) {
            $sum += $servicesList->getServiceById($key, $value['id'])['price'];
        }

        $PRICE_TEMPLATE_LETTER = 2.67;
        $templateData = new Templates();
        $templateText = $templateData->getTemplateText($letter['templateId']);
        $templateLength = iconv_strlen($templateText, 'UTF-8') - 2;
        $priceForTemplate = $templateLength * $PRICE_TEMPLATE_LETTER;
        $sum += $priceForTemplate;

        if (array_key_exists('customerText', $letter)) {
            $PRICE_CUSTOMER_LETTER = 5;
            $customerText = $letter['customerText'];
            $customerTextLength = iconv_strlen($customerText, 'UTF-8');
            $priceForCustomer = $customerTextLength * $PRICE_CUSTOMER_LETTER;
            $sum += $priceForCustomer;
        }

        $PROFIT = 700;
        $sum += $PROFIT;

        if (array_key_exists('personalText', $letter)) {
            $PRICE_PERSONAL_TEXT = 4000;
            $sum += $PRICE_PERSONAL_TEXT;
        }

        $price['discount'] = round($sum / 100.0, 2);
        $price['usual'] = round($sum / (100 - $discount), 2);
        return $price;
    }

    /**
     * @param null $services
     * @param null $letter
     * @return array список ошибок в формате
     *         array = [
     *                    [ 'code' =>, //Код ошибки
     *                      'description' => ] //Описание
     *                 ]
     */
    public function checkCorrectness($services = null, $letter = null)
    {
        if (is_null($services))
            $services = $this->services;
        if (is_null($letter))
            $letter = $this->letter;

        $errors = [];
        $error = [];
        if ($services['delivery']['id'] == 1) { //перевіряємо чи замовлення доставляється поштою
            if (array_key_exists('surgutch', $services)) {
                $error['code'] = '1';
                $error['description'] = 'Нельзя выбирать сургуч, если доставка осуществляется почтой.';
                array_push($errors, $error);
            }
            if (array_key_exists('meal', $services)) {
                $error['code'] = '2';
                $error['description'] = 'Нельзя выбирать еду, если доставка осуществляется почтой.';
                array_push($errors, $error);
            }
        }
        if (array_key_exists('personalText', $letter)) {
            if (array_key_exists('templateId', $letter)) {
                $error['code'] = '3';
                $error['description'] = 'Нельзя выбирать шаблон, если заказывается персональное письмо.';
                array_push($errors, $error);
            }
        }

        if (count($errors)==0)
            $errors = true;

        return $errors;
    }

    /**
     * @param $id - id замовлення, за яке здійснили оплату
     *
     * @return - повертає 1, якщо вдалось здійснити оплату; 0 - якщо не вдалось
     */
    public function setPaid($id)
    {
        $id = intval($id);
        $res = 0;
        $paidQuery = 'UPDATE `orders_data` SET `orders_data`.`orders_data_payed`=\'1\'
                      WHERE `orders_data`.`orders_id`=\'?\'';
        if ($stmt = \App\Core::db()->prepare($paidQuery)) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $res = $stmt->affected_rows;
            $stmt->close();
        }
        return $res;
    }
}