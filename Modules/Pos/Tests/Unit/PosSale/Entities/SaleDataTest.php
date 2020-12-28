<?php

namespace Modules\Pos\Tests\Unit\PosSale\Entities;

use Modules\Pos\Services\PosSale\Entities\SaleData;
use Tests\TestCase;


class SaleDataTest extends TestCase
{

    // Venta de 60 baltilocas a $380 debiese retornar $22.800
    private $baltilocaId = 4;

    /**
     * Test if sale of 60 baltilocas, with a cost of $380 returns
     * $22.800 in ticket and $22.800 in invoice
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice()
    {
        $saledata = new SaleData(1, 1, 1, 0);
        $saledata->attachDetailSaleData(1, $this->baltilocaId, 60, 380, false, 0, 0);
        $saledata->apply();
        $this->assertEquals(22800, $saledata->getTicketTotal());
        $this->assertEquals(22800, $saledata->getInvoiceTotal());
    }

    /**
     * Test if sale of 1 product $100 and 2 product $200, should return
     * $261 in ticket and $262 in invoice
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case2()
    {
        $saledata = new SaleData(1, 1, 1, 10);
        $saledata->attachDetailSaleData(1, 1, 1, 100, false, 10, 0);
        $saledata->attachDetailSaleData(1, 1, 1, 200, false, 0, 0);
        $saledata->apply();
        $this->assertEquals(261, $saledata->getTicketTotal());
        $this->assertEquals(262, $saledata->getInvoiceTotal());
    }

    /**
     * Test if sale of 7 baltiloca at price $400 with discount line returns
     * $2600 in ticket and $2600 in invoice
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case3()
    {
        $saledata = new SaleData(1, 1, 1, 0);
        $saledata->attachDetailSaleData(1, $this->baltilocaId, 7, 400, false, 0, 200);
        $saledata->apply();
        $this->assertEquals(2600, $saledata->getTicketTotal());
        $this->assertEquals(2600, $saledata->getInvoiceTotal());
    }

    /**
     * Test if sale of 3 packing of promo of baltiloca + kryspo at price $55.000 with no discount line,
     * return $156.750 in ticket total and $156.748 in invoice total
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case4()
    {
        $saledata = new SaleData(1, 1, 1, 5);
        // 7: Id de packings
        $saledata->attachDetailSaleData(1, 7, 3, 55000, false, 0, 0);
        $saledata->apply();
        $this->assertEquals(156750, $saledata->getTicketTotal());
        $this->assertEquals(156749, $saledata->getInvoiceTotal());
        $this->assertEquals(131722, $saledata->getNewNetSubtotal());
        $this->assertEquals(25027, $saledata->getIva());
    }

    /**
     * return $10.000 in ticket total and $9.050 in invoice total
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case5()
    {
        $saledata = new SaleData(1, 1, 1, 0);
        $saledata->attachDetailSaleData(1, 6, 5, 3000, false, 0, 5000);
        $saledata->apply();
        $this->assertEquals(10000, $saledata->getTicketTotal());
        $this->assertEquals(10000, $saledata->getInvoiceTotal());
    }

    /**
     * Should return $184.655 in factura
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case6()
    {
        $saledata = new SaleData(1, 1, 1, 12);
        $saledata->attachDetailSaleData(1, 4, 2, 400, false, 0, 0);
        $saledata->attachDetailSaleData(1, 5, 10, 200, false, 0, 0);
        $saledata->attachDetailSaleData(1, 6, 5, 3000, false, 0, 5000);
        $saledata->attachDetailSaleData(1, 7, 4, 55000, false, 10, 0);
        $saledata->apply();
        dump($saledata);
        $this->assertEquals(185504, $saledata->getTicketTotal());
        $this->assertEquals(185504, $saledata->getInvoiceTotal());
    }

    /**
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case7()
    {
        $saledata = new SaleData(1, 1, 1, 10);
        $saledata->attachDetailSaleData(1, 1, 1, 100, false, 10, 0);
        $saledata->attachDetailSaleData(1, 1, 1, 200, false, 0, 10);
        $saledata->apply();
        $this->assertEquals(252, $saledata->getTicketTotal());
        $this->assertEquals(252, $saledata->getInvoiceTotal());
    }

    /**
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case8()
    {
        $saledata = new SaleData(1, 1, 1, 0);
        $saledata->attachDetailSaleData(1, 1, 9, 2340, false, 0, 0);
        $saledata->apply();
        $this->assertEquals(21060, $saledata->getTicketTotal());
        $this->assertEquals(21061, $saledata->getInvoiceTotal());
    }

    /**
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case9()
    {
        $saledata = new SaleData(1, 1, 1, 0);
        $saledata->attachDetailSaleData(1, 1, 62, 990, false, 42, 0);
        $saledata->apply();
        $this->assertEquals(35600, $saledata->getTicketTotal());
        $this->assertEquals(35601, $saledata->getInvoiceTotal());
    }

    /**
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case10()
    {
        $saledata = new SaleData(1, 1, 1, 17);
        $saledata->attachDetailSaleData(1, 1, 42, 3920  , false, 41, 0);
        $saledata->attachDetailSaleData(1, 1, 95, 2330  , false, 7 , 0);
        $saledata->attachDetailSaleData(1, 1, 27, 840   , false, 18, 0);
        $saledata->attachDetailSaleData(1, 1, 87, 770   , false, 32, 0);
        $saledata->attachDetailSaleData(1, 1, 85, 7650  , false, 4 , 0);
        $saledata->attachDetailSaleData(1, 1, 87, 14240 , false, 49, 0);
        $saledata->attachDetailSaleData(1, 1, 7 , 360700, false, 17, 0);
        $saledata->attachDetailSaleData(1, 1, 48, 990   , false, 44, 0);
        $saledata->apply();
        $this->assertEquals(3108758, $saledata->getTicketTotal());
        $this->assertEquals(3108757, $saledata->getInvoiceTotal());
    }

    /**
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case11()
    {
        $saledata = new SaleData(1, 1, 1, 2);
        $saledata->attachDetailSaleData(1, 1, 60, 5110  , false, 35, 0);
        $saledata->attachDetailSaleData(1, 1, 99, 490   , false, 19, 0);
        $saledata->attachDetailSaleData(1, 1, 27, 940   , false, 9 , 0);
        $saledata->attachDetailSaleData(1, 1, 33, 1260  , false, 1 , 0);
        $saledata->attachDetailSaleData(1, 1, 86, 1120  , false, 28, 0);
        $saledata->attachDetailSaleData(1, 1, 6 , 360   , false, 7 , 0);
        $saledata->attachDetailSaleData(1, 1, 50, 820   , false, 7 , 0);
        $saledata->attachDetailSaleData(1, 1, 5 , 1440  , false, 35, 0);
        $saledata->apply();
        $this->assertEquals(408672, $saledata->getTicketTotal());
        $this->assertEquals(408669, $saledata->getInvoiceTotal());
    }

    /**
     * Test if sale of 1 product $100 and 2 product $200, should return
     * $261 in ticket and $262 in invoice
     *
     * @return void
     */
    public function test_ShouldReturn_GoodTicketAndInvoice_Case12()
    {
        $saledata = new SaleData(1, 1, 1, 10);
        $saledata->attachDetailSaleData(1, 1, 2, 100, false, 10, 0);
        $saledata->attachDetailSaleData(1, 1, 2, 200, false, 0, 10);
        $saledata->apply();
        dump($saledata);
        $this->assertEquals(513, $saledata->getTicketTotal());
        $this->assertEquals(513, $saledata->getInvoiceTotal());
    }

}
