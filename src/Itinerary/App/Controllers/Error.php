<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 30/05/2017
 * Time: 21:57
 */

namespace Itinerary\App\Controllers;


class Error extends Controller
{
    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @return \Exception
     */
    public function getException(): \Exception
    {
        return $this->exception;
    }

    /**
     * @param \Exception $exception
     */
    public function setException(\Exception $exception)
    {
        $this->exception = $exception;
    }


    public function main()
    {
        http_response_code(501);

        if ($this->request->isXmlHttpRequest()) {
            echo json_encode(
                [
                    'error' => $this->exception->getMessage()
                ]
            );
        }else if ($this->request->isCli()){
            die ("\033[31m ".$this->exception->getMessage()) . "\033[0m";
        }else {
            $this->render('error');
        }

    }
}