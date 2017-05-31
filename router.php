<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])){
    return false;
}else {
    require 'www/index.php';
}
