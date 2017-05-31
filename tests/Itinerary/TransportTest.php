<?php
/**
 * Created by PhpStorm.
 * User: betit
 * Date: 30/05/2017
 * Time: 12:56
 */

use Itinerary\Transports;

use PHPUnit\Framework\TestCase;

class TransportTest extends TestCase
{


    public function testTransports()
    {
        $transport = Transports\Transport::getTransport('Airplane', '20A', 'Jumbo 547');
        $this->assertInstanceOf(Transports\Airplane::class, $transport);
        $this->assertEquals('20A',$transport->getSeat());
        $this->assertEquals('Jumbo 547',$transport->getComment());

        $transport = Transports\Transport::getTransport('Ship', '101', 'Royal Caribbean Cruise');
        $this->assertInstanceOf(Transports\Ship::class, $transport);
    }


    public function testPlaceNotFoundException()
    {
        $this->expectException(\Exception::class);
        Transports\Transport::getTransport('NonExistingTransport');
    }
}
