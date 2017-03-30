# Data Collector for Algolia Search Bundle

![Data Collector for Algolia Search Bundle](https://raw.githubusercontent.com/jupeter/datacollector-algolia-search-bundle/master/docs/profiler.png)

## Install using composer

    composer require --dev jupeter/datacollector-algolia-search-bundle
    
## Register the bundle

Add ``Jupeter\DataCollectorAlgoliaSearchBundle\DataCollectorAlgoliaSearchBundle()`` to your application Kernel:

    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            // all bundles
            if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
                // all test/dev bundles
                $bundles[] = new Jupeter\DataCollectorAlgoliaSearchBundle\DataCollectorAlgoliaSearchBundle();
            }
        }
    }
