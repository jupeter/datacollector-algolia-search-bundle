<?php

namespace Jupeter\DataCollectorAlgoliaSearchBundle\Tests\Debug;


use AlgoliaSearch\ClientContext;
use Jupeter\DataCollectorAlgoliaSearchBundle\Debug\DebugClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugClientTest extends TestCase
{
    public function testDoRequestWithDisabledRequestsReturnsEmptyArray()
    {
        $testInstance = new DebugClient('app_id', 'api_key');
        $testInstance->disableRequests(true);
        $response = $testInstance->doRequest('s', 's', 's', 's', [], [], 13, 37);
        self::assertInternalType('array', $response);
        self::assertEmpty($response);
    }
    public function testDoRequestWithDisabledRequestsReturnsPushedResponse()
    {
        $response = ['success' => true];
        $testInstance = new DebugClient('app_id', 'api_key');
        $testInstance->disableRequests(true);
        $testInstance->pushResponse($response);
        self::assertSame($response, $testInstance->doRequest('s', 's', 's', 's', [], [], 13, 37));
    }
}
