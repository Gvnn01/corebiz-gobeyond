<?php

namespace App\Traits;

use App\Models\Challenge;
use App\Services\RedisService;
use App\Services\VtexConnect;

trait ChallengeT
{
    use VtexConnect;
    use RedisService;

    public function CreateDataChallenge($url)
    {
        $data = $this->connectGet($url)->collect();
        $filteredData = $data->filter(function ($item) {
            return $item['productId'] === '1328137';
        })->map(function ($item) {
            $item['productId'] = (int) $item['productId'];
            return [
                'productId' => $item['productId'],
                'productName' => $item['productName'],
                'brand' => $item['brand'],
            ];
        })
            ->values();
        $filteredData = (object) $filteredData->first();
        try {
            $desafio = Challenge::updateOrCreate([
                'productId' => $filteredData->productId,
                'productName' => $filteredData->productName,
                'brand' => $filteredData->brand,
            ]);
            $arrayData = Challenge::all()->toArray();
            $this->setCacheTrait(json_encode($arrayData), '_challenge', now()->addMinutes(1));
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => [],
            ];
        }
        return [
            'status' => 201,
            $desafio,
        ];
    }
}
