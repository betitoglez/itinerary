<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 28/05/2017
 * Time: 21:45
 */

namespace Itinerary\Cards;

use Itinerary\Places\Place;
use Itinerary\Transports\Transport;

class Card
{
    protected $comment;

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

    /**
     * @var Place $departure Place where the node starts
     * @var Place $arrival Place where the node ends
     */
    protected $departure , $arrival;

    /**
     * @var Transport transport used for this node
     */
    protected $transport;

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param mixed $departure
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
    }

    /**
     * @return mixed
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * @param mixed $arrival
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;
    }

    /**
     * @return Transport
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param Transport $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }


    /**
     * Card constructor.
     * @param Place $departure
     * @param Place $arrival
     * @param Transport $transport
     * @param null $comment
     */
    public function __construct(Place $departure , Place $arrival, Transport $transport , $comment = NULL)
    {
        $this->departure = $departure;
        $this->arrival = $arrival;
        $this->transport = $transport;
        $this->comment = $comment ?? NULL;

    }
}