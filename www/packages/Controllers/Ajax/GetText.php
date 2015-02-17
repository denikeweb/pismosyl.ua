<?php
/**
 * Created by PhpStorm.
 * User: Andriy
 * Date: 17.02.2015
 * Time: 22:00
 */

	namespace Controllers\Ajax;

	use Models\Templates;

    class GetText {
	    public function run(){
            $template = new Templates();
            echo $template->getTemplateText($_REQUEST['id']);
	    }
	}