<?php
/**
 * Created by PhpStorm.
 * User: Andriy
 * Date: 17.02.2015
 * Time: 19:48
 */

namespace Models;


class Services {
    public function getAllServicesList()
    {
        $services['surgutch'] = [];
        $services['meal'] = [];
        $services['smell'] = [];
        $services['delivery'] = [];
	    //$services['design'] = [];
	    $services['burnt_edges'] = [];

        $surgutch = &$services['surgutch'];
        $surgutch[0]['id'] = 1;
        $surgutch[0]['name'] = 'С логотипом «Письмосыла»';
        $surgutch[0]['price'] = 100;
        $surgutch[0]['img'] = 'img/none.jpg';

        $surgutch[1]['id'] = 2;
        $surgutch[1]['name'] = 'С сердцем';
        $surgutch[1]['price'] = 100;
        $surgutch[1]['img'] = 'img/none.jpg';

        $surgutch[2]['id'] = 3;
        $surgutch[2]['name'] = 'Со смайликом';
        $surgutch[2]['price'] = 100;
        $surgutch[2]['img'] = 'img/none.jpg';

        $meal = &$services['meal'];
        $meal[0]['id'] = 1;
        $meal[0]['name'] = 'Snikers';
        $meal[0]['price'] = 2500;
        $meal[0]['img'] = 'img/none.jpg';

        $meal[1]['id'] = 2;
        $meal[1]['name'] = 'Lion';
        $meal[1]['price'] = 2500;
        $meal[1]['img'] = 'img/none.jpg';

        $smell = &$services['smell'];
        $smell[0]['id'] = 1;
        $smell[0]['name'] = 'Кофе';
        $smell[0]['price'] = 1000;

        $smell[1]['id'] = 2;
        $smell[1]['name'] = 'Розы';
        $smell[1]['price'] = 1000;

        $smell[2]['id'] = 3;
        $smell[2]['name'] = 'Мандарин';
        $smell[2]['price'] = 1000;

	    $services['delivery'] = [
	        [
		        'id' => 1,
		        'name' => 'Почта',
		        'price' => 300
	        ],
	        [
		        'id' => 2,
		        'name' => 'Курьер',
		        'price' => 2000
	        ],
	        [
		        'id' => 3,
		        'name' => 'Самовывоз',
		        'price' => 0
	        ],
        ];

        $design=&$services['burnt_edges'];
        $design ['id'] = 1;
        $design ['name'] = 'Обожженные края';
        $design ['price'] = 400;

        return $services;
    }
} 