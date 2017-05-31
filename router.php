<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ttf|woff|svg|ico)$/', $_SERVER["REQUEST_URI"])){
    if (file_exists(__DIR__.'/www/'.$_SERVER["REQUEST_URI"])){
      //  include (__DIR__.'/www/'.$_SERVER["REQUEST_URI"]);
    }else{
        return false;
    }

    return false;
}else {
    require 'www/index.php';
}
