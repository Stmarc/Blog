<?php
declare(strict_types=1);

require_once('debug/debug.php');
class View{

    public static function render (string $page,array $params = null,$params1=null): void
    {
      
        include_once('layouts/pages/dashboard.php');
    }

}