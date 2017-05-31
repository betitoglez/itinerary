<?php

namespace Itinerary\Cards;

/**
 * Created by PhpStorm.
 * User: betit
 * Date: 28/05/2017
 * Time: 21:36
 */
class Collection extends \SplObjectStorage
{

    public function add(Card $object, $data = null)
    {
        parent::attach($object, $data);
    }

    public function attach($object, $data = null)
    {
        $this->add($object, $data);
    }

    public function first ()
    {
        $this->rewind();
        return $this->current();
    }

    public function last ()
    {
        $this->rewind();
        while($this->valid()) {
            $last = $this->current(); // similar to current($s)
            $this->next();
        }
        return $last;
    }

}