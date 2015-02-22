<?php
/**
 * Created by PhpStorm.
 * User: Andriy
 * Date: 15.02.2015
 * Time: 17:04
 */
namespace Annex;

class Annex {
    public static function showArray ($array) {
        echo '<pre style="white-space: pre-wrap; overflow: hidden; text-align: left; background: #ffffff;"><code class="php">';
        print_r($array);
        echo '</code></pre>';
    }
} 