<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 28/05/2017
 * Time: 11:33
 */

namespace Itinerary\App\Controllers;


use Itinerary\App\Request;
use Itinerary\Cards\Collection;
use Itinerary\Itinerary;

abstract class Controller
{

    /**
     * @var mixed|string
     */
    protected $viewPath;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @return mixed|string
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }

    /**
     * @param mixed|string $viewPath
     */
    public function setViewPath($viewPath)
    {
        $this->viewPath = $viewPath;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function __construct($aConfig = [], $request = null)
    {
        $this->viewPath = array_key_exists('VIEW_PATH', $aConfig) ? $aConfig['VIEW_PATH'] : VIEW_PATH;
        $this->request = $request ?? NULL;
    }

    public abstract function main();

    /**
     * Render an html view
     * @param $view
     * @throws \Exception
     */
    public function render($view, $params = [])
    {

        if (file_exists($this->viewPath . "/{$view}.html")) {
            include $this->viewPath . "/{$view}.html";
        } else {
            throw new \Exception('View not found');
        }
    }


    /**
     * @param $sJson
     * @return Itinerary
     * @throws \Exception
     */
    protected function _parseJSONString($sJson): Itinerary
    {
        $aArrayFromJson = json_decode($sJson, TRUE);
        if (FALSE === $aArrayFromJson)
            throw new \Exception('JSON string not well formatted');
        return Itinerary::arrayToItinerary($aArrayFromJson);
    }


    /**
     * Parse a Collection to an Array
     * @param Collection $oCollection
     * @return array
     */
    protected function _getReadableArrayFromCollection(Collection $oCollection) : array
    {
        $result = [];
        foreach ($oCollection as $item) {
            $result[] = [
                'from' => $this->_filterName($item->getDeparture()),
                'to' => $this->_filterName($item->getArrival()),
                'transport' => $this->_filterName($item->getTransport()),
                'seat' => $item->getTransport()->getSeat(),
                'comment' => $item->getComment(),
            ];
        }

        return $result;
    }

    /**
     * Removes suffix
     * @param $item
     * @return mixed
     */
    protected function _filterName($item)
    {
        return str_ireplace([
            'Itinerary\\Places\\',
            'Itinerary\\Transports\\'
        ], '', get_class($item));
    }
}