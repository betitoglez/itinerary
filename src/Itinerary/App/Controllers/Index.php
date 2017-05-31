<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 28/05/2017
 * Time: 12:07
 */

namespace Itinerary\App\Controllers;


use Itinerary\Cards\Card;
use Itinerary\Itinerary;

use Itinerary\Places\Cities\{Madrid,Rome,Barcelona,London};
use Itinerary\Transports\Airplane;

class Index extends Controller
{

    public function main ()
    {
        $this->render('index');
    }
}