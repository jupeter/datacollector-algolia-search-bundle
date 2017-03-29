<?php

namespace Jupeter\DataCollectorAlgoliaSearchBundle;

use Jupeter\DataCollectorAlgoliaSearchBundle\DependencyInjection\DataCollectorAlgoliaSearchExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DataCollectorAlgoliaSearchBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new DataCollectorAlgoliaSearchExtension();
        }
        return $this->extension;
    }
}
