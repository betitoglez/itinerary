<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 29/05/2017
 * Time: 16:15
 */

use Itinerary\Cards\Card;
use Itinerary\Places\Cities\{
    Madrid, London, Barcelona, Dubai, Rome
};
use Itinerary\Places\Sites\{
    GreatWall, EmpireState
};
use Itinerary\Transports\{
    Airplane, Bus, Car, Ship
};

use PHPUnit\Framework\TestCase;

class ItineraryTest extends TestCase
{

    private $itinerary;

    protected function setUp()
    {
        $this->itinerary = new \Itinerary\Itinerary();
    }

    /**
     *  Create unsorted Cards
     */
    protected function mockItinerary()
    {

        $this->itinerary->add(
            new Card(
                new EmpireState(),
                new Barcelona(),
                new Airplane(),
                'Come back to home!'
            )
        );

        $this->itinerary->add(
            new Card(
                new Dubai(),
                new GreatWall(),
                new Airplane()
            )
        );

        $this->itinerary->add(
            new Card(
                new London(),
                new Rome(),
                new Car(),
                'Rent a car in Gatwick'
            )
        );

        $this->itinerary->add(
            new Card(
                new Rome(),
                new Dubai(),
                new Ship('305'),
                'Royal Cruise'
            )
        );


        $this->itinerary->add(
            new Card(
                new Madrid(),
                new London(),
                new Bus('30B'),
                'November 14th, 15:30. International Bus Station'
            )
        );


        $this->itinerary->add(
            new Card(
                new GreatWall(),
                new EmpireState(),
                new Airplane()
            )
        );


    }


    public function testItineraryFailsWhenWrongCardAdded(): void
    {
        $this->expectException(\Exception::class);
        $this->itinerary->add('expect error');
    }

    public function testItineraryFailsWhenCardsAreMissing(): void
    {

        $this->expectException(\Exception::class);

        $this->mockItinerary();

        $this->itinerary->add(
            new Card(
                new Rome(),
                new London(),
                new Airplane()
            )
        );

        $this->itinerary->create();
    }



    public function testItineraryIsSorted(): void
    {

        $this->mockItinerary();

        /**
         * @var \Itinerary\Cards\Collection
         */
        $sortedCollection = $this->itinerary->create();

        $this->assertEquals('MAD',$sortedCollection->first()->getDeparture()->getId());
        $this->assertEquals('BAR',$sortedCollection->last()->getArrival()->getId());
        $this->assertCount(6,$sortedCollection);

    }


    public function testGenerateItineraryFromArray() : void
    {
        $itinerary = \Itinerary\Itinerary::arrayToItinerary([
            [
                'from' => 'Cities\Madrid',
                'to'   => 'Cities\London',
                'transport' => 'Airplane'
            ] ,

            [
                'from' => 'Cities\London',
                'to'   => 'Sites\EmpireState',
                'transport' => 'Bus',
                'seat' => '14D',
                'comment' => 'It is a really long trip...'
            ]
        ]);

        $this->assertInstanceOf(\Itinerary\Itinerary::class,$itinerary);
    }

}
