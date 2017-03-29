# Data Collector for Algolia Search Bundle

## Installation

    composer require --dev jupeter/datacollector-algolia-search-bundle
    
## Add new Bundle to AppKernel

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
