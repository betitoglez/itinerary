<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 30/05/2017
 * Time: 12:48
 */

use Itinerary\Places;


use PHPUnit\Framework\TestCase;


class PlaceTest extends TestCase
{


    public function testPlaces()
    {
        $place = Places\Place::getPlace('Cities\Madrid');
        $this->assertInstanceOf(Places\Cities\Madrid::class, $place);

        $place = Places\Place::getPlace('Sites\EmpireState');
        $this->assertInstanceOf(Places\Sites\EmpireState::class, $place);
    }


    public function testPlaceNotFoundException()
    {
        $this->expectException(\Exception::class);
        Places\Place::getPlace('NonExistingPlace');
    }
}
