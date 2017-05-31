<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 31/05/2017
 * Time: 11:36
 */

namespace Itinerary\App\Controllers;

class Console extends Controller
{

    public function main()
    {
        if (!file_exists(ROOT_PATH.'/input.txt'))
            throw new \Exception('A valid JSON file called input.txt must be placed in the root path');

        $json = file_get_contents(ROOT_PATH.'/input.txt');
        $oItinerary = $this->_parseJSONString($json);
        $oSortedCollection = $oItinerary->create();

        file_put_contents(ROOT_PATH.'/output.txt',
            json_encode($this->_getReadableArrayFromCollection($oSortedCollection),JSON_PRETTY_PRINT));
    }
}