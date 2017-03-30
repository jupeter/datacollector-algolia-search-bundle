<?php

/*
 * Copyright (c) 2015 Piotr Plenik
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Jupeter\DataCollectorAlgoliaSearchBundle\Tests\Debug;

use Jupeter\DataCollectorAlgoliaSearchBundle\Debug\DebugClient;
use PHPUnit\Framework\TestCase;

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
        $response     = ['success' => true];
        $testInstance = new DebugClient('app_id', 'api_key');
        $testInstance->disableRequests(true);
        $testInstance->pushResponse($response);
        self::assertSame($response, $testInstance->doRequest('s', 's', 's', 's', [], [], 13, 37));
    }
}
