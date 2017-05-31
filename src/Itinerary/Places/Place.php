<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 27/05/2017
 * Time: 18:09
 */

namespace Itinerary\Places;

/**
 * Class Place
 * @package Itinerary\Places
 */
class Place
{
    /**
     * @var string unique identifier
     */
    protected $id;

    /**
     * @var float $lat Latitude
     * @var float $long Longitude
     */
    protected $lat , $long;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return float
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @param float $long
     */
    public function setLong($long)
    {
        $this->long = $long;
    }


    /**
     * Returns a valid place instance, throws an exception otherwise
     * @param $place
     * @return Place
     * @throws \Exception
     */
    public static function getPlace ($place) : Place
    {
        $sBase = 'Itinerary\\Places\\';

        if (class_exists($sBase.$place)){
            $rClass = new \ReflectionClass($sBase.$place);
            if ($rClass->isInstantiable())
                return $rClass->newInstance();
        }

        //Otherwise throw an exception
        throw new \Exception('Place not found');

    }


}