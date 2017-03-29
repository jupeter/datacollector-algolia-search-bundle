<?php

namespace Jupeter\DataCollectorAlgoliaSearchBundle\Debug;


interface DebugClientInterface
{
    /**
     * @return array
     */
    public function getTransactions();
}