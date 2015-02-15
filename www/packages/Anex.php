<?php
/**
 * Created by PhpStorm.
 * User: Andriy
 * Date: 15.02.2015
 * Time: 17:04
 */

class Anex {
    public static function showArray ($array) {
        echo '<pre style="white-space: pre-wrap; overflow: hidden; text-align: left; background: #ffffff;"><code class="php">';
        print_r($array);
        echo '</code></pre>';
    }
} 