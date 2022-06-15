<?php

declare(strict_types=1);

namespace Interns2022B;

class BreweryCacheBuilder
{
    public function build(): string
    {
        $entries = [];

        foreach ($this->getProviders() as $provider) {
            $results = $provider->get();
            foreach ($results as $result) {
                $entries[] = $result;
            }
        }
        
        return json_encode($entries);
    }

    /**
     * @return array<DataProvider>
     */
    protected function getProviders(): array
    {
        return [
            KasparSchulzDataProvider::class,
            CasparyDataProvider::class,
        ];
    }
}
