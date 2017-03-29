<?php
/*
 * This file is part of the MyJobCompany platform.
 *
 * © MyJobCompany https://myjob.company
 */


namespace Jupeter\DataCollectorAlgoliaSearchBundle\Debug;

use Algolia\AlgoliaSearchBundle\Indexer\Indexer;
use Doctrine\ORM\EntityManager;

class DebugIndexer extends Indexer
{
    protected $client;

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }
}