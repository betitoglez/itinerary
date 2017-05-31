<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 28/05/2017
 * Time: 21:35
 */

namespace Itinerary;


use Itinerary\Cards\Card;
use Itinerary\Cards\Collection;
use Itinerary\Places\Place;
use Itinerary\Transports\Transport;

class Itinerary
{
    protected $cards;

    /**
     * @return Collection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @param Collection $cards
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
    }

    public function __construct(Collection $cards = null)
    {
        if (isset($cards)) {
            $this->cards = $cards;
        } else {
            $this->cards = new Collection();
        }
    }


    /**
     * @param $card
     * @return void
     * @throws \Exception
     */
    public function add($card): void
    {
        if ($card instanceof Card) {
            $this->cards->add($card);
        } else if ($card instanceof Collection) {
            $this->cards = new Collection(array_merge($this->cards, $card));
        } else {
            throw new \Exception('Not a valid Card Structure');
        }
    }


    public function create(): Collection
    {
        //Get the Collection which is gonna be sorted with the departure point
        $sortedCollection = $this->_getDeparture();

        //Clone collection and iterate over it
        $_auxCollection = clone ($this->cards);
        //Remove departure Point
        $_auxCollection->removeAll($sortedCollection);

        $this->_sort($sortedCollection, $_auxCollection);

        //Check if auxCollection is empty. Otherwise there was an error in the provided cards
        if (count($_auxCollection)>0)
            throw new \Exception('Itinerary cannot be calculated. There are missing cards');

        $this->cards = $sortedCollection;
        return $sortedCollection;
    }

    /**
     * Recursive function to sort collection and calculate itinerary
     *
     * @param Collection $sortedCollection
     * @param Collection $_auxCollection
     * @return Collection
     */
    protected function _sort(Collection $sortedCollection, Collection $_auxCollection) : Collection
    {
        $last = $sortedCollection->last();
        foreach ($_auxCollection as $card) {
            if ($last->getArrival()->getId() == $card->getDeparture()->getId()){
                $sortedCollection->add($card);
                $_auxCollection->offsetUnset($card);
                if (count($_auxCollection)>0){
                    return $this->_sort($sortedCollection,$_auxCollection);
                }
            }
        }
        return $sortedCollection;
    }


    /**
     * Get Departure point
     * @return Collection
     * @throws \Exception
     */
    protected function _getDeparture(): Collection
    {
        //Summarize cards to find out Departure (First Card)
        //We assume departure is those point with no arrivals and a departure
        //Bear in mind Arrival and Departure MUST BE different!
        $_places = [];
        foreach ($this->cards as $card) {
            $departure = $card->getDeparture();
            $arrival = $card->getArrival();

            if (!array_key_exists($departure->getId(), $_places))
                $_places[$departure->getId()] = [
                    'arrivals' => 0,
                    'departures' => 0,
                    'card' => $card
                ];

            if (!array_key_exists($arrival->getId(), $_places))
                $_places[$arrival->getId()] = [
                    'arrivals' => 0,
                    'departures' => 0,
                ];

            $_places[$departure->getId()]['departures']++;
            $_places[$arrival->getId()]['arrivals']++;

        }

        foreach ($_places as $place) {
            if ($place['arrivals'] == 0 && $place['departures'] == 1) {
                $departurePoint = $place['card'];
            }
        }


        if (!isset($departurePoint))
            throw new \Exception('Departure point cannot be calculated');

        $oSortedCollection = new Collection();
        $oSortedCollection->add($departurePoint);
        return $oSortedCollection;
    }

    public static function arrayToItinerary (Array $cards) : Itinerary
    {
        $itinerary = new static();
        foreach ($cards as $card) {
            if (!isset($card['from']) || !isset($card['to']) || !isset($card['transport']))
                throw new \Exception('Array cards not well formatted');
            $_auxCard = new Card(Place::getPlace($card['from']),
                                 Place::getPlace($card['to']),
                                 Transport::getTransport($card['transport'] , $card['seat']??NULL),
                                 $card['comment']??NULL);

            $itinerary->add($_auxCard);
        }
        return $itinerary;
    }
}