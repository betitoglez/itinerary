<?php

require (__DIR__.'/../bootstrap.php');

use Itinerary\Kernel;
use Itinerary\App\Request;

$kernel = new Kernel(new Request());
try{
    $kernel->dispatch();
} catch (\Exception $exception){
    $kernel->dispatchError($exception);
}
