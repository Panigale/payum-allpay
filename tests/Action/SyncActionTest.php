<?php

use Mockery as m;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayInterface;
use Payum\Core\Request\GetHttpRequest;
use Payum\Core\Request\Sync;
use PayumTW\Allpay\Action\SyncAction;
use PayumTW\Allpay\Request\Api\GetTransactionData;

class SyncActionTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function test_execute()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
        */

        $action = new SyncAction();
        $gateway = m::mock(GatewayInterface::class);
        $request = m::mock(Sync::class);
        $details = new ArrayObject();

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
        */

        $request->shouldReceive('getModel')->andReturn($details)->twice();

        $gateway
            ->shouldReceive('execute')->with(m::type(GetHttpRequest::class))
            ->shouldReceive('execute')->with(m::type(GetTransactionData::class));

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
        */

        $action->setGateway($gateway);
        $action->execute($request);
    }
}