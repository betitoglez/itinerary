<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 28/05/2017
 * Time: 10:51
 */

namespace Itinerary;


use Itinerary\App\Controllers\Console;
use Itinerary\App\Controllers\Controller;
use Itinerary\App\Controllers\Error;
use Itinerary\App\Request;

class Kernel
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function dispatch(){

        if ($this->request->isCli()){
            $sController = Console::class;
        }else{
            $sRoute = ucfirst(strtolower($this->request->getRoute()));
            if ($sRoute == '/'){
                $sRoute = 'Index';
            }

            if (!file_exists(CONTROLLERS_PATH . "/{$sRoute}.php")){
                throw new \Exception('Controller not found');
            }


            $sController = $this->_getControllerClassName($sRoute);
        }


        /**
         * @var Controller dynamic controller
         */
        $oController = new $sController;

        $oController->setRequest($this->request);
        $oController->main();
    }

    public function dispatchError(\Exception $error){
        $oController = new Error();
        $oController->setRequest($this->request);
        $oController->setException($error);
        $oController->main();
    }

    protected function _getControllerClassName ($sRoute)
    {
        return '\\'.str_replace('/','\\',str_replace(SRC_PATH . '/','',CONTROLLERS_PATH) . '/' . $sRoute);
    }
}