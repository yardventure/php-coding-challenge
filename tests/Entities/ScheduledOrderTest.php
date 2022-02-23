<?php

namespace Tests\Entities;

use App\Entities\ScheduledOrder;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ScheduledOrderTest extends TestCase
{
    public function testItSetsAnInterval()
    {
        $date = Carbon::today()->addWeek();
        $order = new ScheduledOrder($date, true);

        $this->assertTrue($order->isInterval());
    }

    public function testItSetsAHoliday()
    {
        $date = Carbon::today()->addWeek();
        $order = new ScheduledOrder($date, true);

        $order->setHoliday(true);

        $this->assertTrue($order->isHoliday());
    }

    public function testItGetsDeliveryDate()
    {
        $date = Carbon::today()->addWeek();
        $order = new ScheduledOrder($date, true);

        $this->assertEquals($date, $order->getDeliveryDate());
    }

    public function testItSetsAnOptIn()
    {
        $date = Carbon::today()->addWeek();
        $order = new ScheduledOrder($date, false);

        $order->setOptIn(true);

        $this->assertTrue($order->isOptIn());
    }

    public function testItDoesntAllowHolidaysOnNonIntervalDates()
    {
        $date = Carbon::today()->addWeek();
        $order = new ScheduledOrder($date, false);

        $order->setHoliday(true);

        $this->assertFalse($order->isHoliday());
    }

    public function testItDoesntAllowOptInsOnIntervalDates()
    {
        $date = Carbon::today()->addWeek();
        $order = new ScheduledOrder($date, true);

        $order->setOptIn(true);

        $this->assertFalse($order->isOptIn());
    }
}