<?php
/**
 * Created by IntelliJ IDEA.
 * User: jupeter
 * Date: 29.03.17
 * Time: 14:45
 */

namespace Jupeter\DataCollectorAlgoliaSearchBundle\DataCollector;

use AlgoliaSearch\Client;
use Jupeter\DataCollectorAlgoliaSearchBundle\Debug\DebugClientInterface;
use Jupeter\DataCollectorAlgoliaSearchBundle\Debug\DebugIndexer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class ClientDataCollector extends DataCollector
{
    /**
     * @var DebugClientInterface
     */
    private $client;

    private $transactions = [];

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        if(count($this->transactions) === 0) {
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
        return $this->data['transactions'];
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

    public function addTransaction($id, $transaction)
    {
        $this->transactions[$id] = $transaction;
    }
}