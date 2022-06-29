<?php

declare(strict_types=1);

namespace Interns2022B;

use Illuminate\Support\Collection;

class Providers
{
    public const LIST = "list";

    public function getProviders(array $data): Collection
    {

//        $providers = [];
     //C   $providers = new Collection($data);
//        foreach ($data as $row => $rowValue) {
//            $providers[] = $data[$row]["provider"];
//        }
  //C      foreach ($providers as $row => $rowValue) {
    //C        $providers = $data[$row]["provider"];
    //C    }

       //c return toa$providers;
    $collectionOfProviders = new Collection($data);
    $list = $collectionOfProviders->map(function ($prov){
        return $prov['provider'];
    });



        return $list;
    }
}
