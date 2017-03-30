<?php
/**
 * Created by IntelliJ IDEA.
 * User: jupeter
 * Date: 30.03.17
 * Time: 09:14
 */

namespace Jupeter\DataCollectorAlgoliaSearchBundle\Tests\Debug;


use Jupeter\DataCollectorAlgoliaSearchBundle\Debug\DebugIndexer;


class DebugIndexerTest extends \PHPUnit_Framework_TestCase
{
    public function testClient()
    {
        $client = new \stdClass();
        $indexer = new DebugIndexer();
        $indexer->setClient($client);
        $this->assertSame($client, $indexer->getClient());
    }

}
