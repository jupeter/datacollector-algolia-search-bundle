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

namespace Jupeter\DataCollectorAlgoliaSearchBundle\Debug;

use AlgoliaSearch\Client;
use Jupeter\DataCollectorAlgoliaSearchBundle\DataCollector\ClientDataCollector;
use Symfony\Component\Stopwatch\Stopwatch;

class DebugClient extends Client implements DebugClientInterface
{
    /**
     * @var array
     */
    private $transactions = [];
    /**
     * @var bool
     */
    private $disableRequests = false;
    /**
     * @var array
     */
    private $responseStack = [];
    /**
     * @var Stopwatch
     */
    private $stopwatch;

    /**
     * @var ClientDataCollector|false
     */
    private $dataCollector = false;

    /**
     * @param bool $disable
     */
    public function disableRequests($disable = false)
    {
        $this->disableRequests = $disable;
    }

    /**
     * @param array $response
     */
    public function pushResponse(array $response)
    {
        $this->responseStack[] = $response;
    }

    /**
     * @param Stopwatch $stopwatch
     */
    public function setStopwatch(Stopwatch $stopwatch)
    {
        $this->stopwatch = $stopwatch;
    }

    /**
     * {@inheritdoc}
     */
    public function doRequest(
        $context,
        $method,
        $host,
        $path,
        $params,
        $data,
        $connectTimeout,
        $readTimeout
    ) {
        $transactionId = md5(microtime().uniqid('trans', false));
        $request       = [
            'context'         => $context,
            'method'          => $method,
            'host'            => $host,
            'path'            => $path,
            'params'          => $params,
            'data'            => $data,
            'connect_timeout' => $connectTimeout,
            'read_timeout'    => $readTimeout,
        ];
        if ($this->stopwatch) {
            $this->stopwatch->start('algolia_transaction');
        }
        $start    = microtime(true);
        $response = [];
        if ($this->disableRequests) {
            if ($this->responseStack !== []) {
                $response = array_shift($this->responseStack);
            }
        } else {
            $response = parent::doRequest($context, $method, $host, $path, $params, $data, $connectTimeout, $readTimeout);
        }
        $time = microtime(true) - $start;
        if ($this->stopwatch) {
            $this->stopwatch->stop('algolia_transaction');
        }

        if($this->dataCollector) {
            $this->dataCollector->addTransaction(
                $transactionId,
                [
                    'mocked' => $this->disableRequests,
                    'request' => $request,
                    'response' => $response,
                    'ms' => round($time * 1000),
                ]
            );
        }

        return $response;
    }

    /**
     * @return array
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    public function setDataCollector($dataCollector)
    {
        $this->dataCollector = $dataCollector;
    }
}
