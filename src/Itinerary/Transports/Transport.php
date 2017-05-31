<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 29/05/2017
 * Time: 7:51
 */

namespace Itinerary\Transports;

/**
 * Class Transport
 * @package Itinerary\Transports
 */
abstract class Transport
{
    protected $id;
    protected $seat;
    protected $comment;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @param mixed $seat
     */
    public function setSeat($seat)
    {
        $this->seat = $seat;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function __construct($seat = null, $comment = null)
    {
        $this->seat = $seat ?? NULL;
        $this->comment = $comment ?? NULL;
    }


    /**
     * Returns a transport instance, throws an exception otherwise
     * @param $transport
     * @param null $seat
     * @param null $comment
     * @return Transport
     * @throws \Exception
     */
    public static function getTransport ($transport,$seat=null,$comment=null) : Transport
    {
        $sBase = 'Itinerary\\Transports\\';

        if (class_exists($sBase.$transport)){
            $rClass = new \ReflectionClass($sBase.$transport);
            if ($rClass->isInstantiable())
                return $rClass->newInstance($seat,$comment);
        }

        //Otherwise throw an exception
        throw new \Exception('Transport not found');

    }


}