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

use Itinerary\Places\Cities\{
    Madrid, Rome, Barcelona, London
};
use Itinerary\Transports\Airplane;

class Index extends Controller
{

    public function main()
    {
        if ($this->request->isPost() && $this->request->isXmlHttpRequest()) {
            if (!$this->request->hasPost('data'))
                throw new \Exception('Data post attribute is mandatory');
            $collection = $this->_parseJSONString($this->request->getPost('data'))->create();
            echo json_encode($this->_getReadableArrayFromCollection($collection));
        } else {
            $this->render('index');
        }

    }
}