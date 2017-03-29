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

namespace Jupeter\DataCollectorAlgoliaSearchBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class ClientDataCollector extends DataCollector
{
    /**
     * @var array
     */
    private $transactions = [];

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        if (count($this->transactions) === 0) {
            return;
        }

        $this->data = [
            'transactions' => $this->transactions,
        ];
    }

    /**
     * @return array
     */
    public function getTransactions()
    {
        return isset($this->data['transactions']) ? $this->data['transactions'] : [];
    }

    /**
     * @return int
     */
    public function getTransactionCount()
    {
        return count($this->getTransactions());
    }

    /**
     * @return int
     */
    public function getTotalTime()
    {
        $time = 0;
        foreach ($this->getTransactions() as $query) {
            $time += $query['ms'];
        }

        return (int) $time;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'algolia_data_collector.client_data_collector';
    }

    /**
     * Add translation
     *
     * @param string $id
     * @param string $transaction
     */
    public function addTransaction($id, $transaction)
    {
        $this->transactions[$id] = $transaction;
    }
}
