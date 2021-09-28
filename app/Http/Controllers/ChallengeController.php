<?php

namespace App\Http\Controllers;

use App\Traits\ChallengeT;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    use ChallengeT;

    public function challengeCorebiz()
    {
        $result = $this->CreateDataChallenge('https://loja.chillibeans.com.br/api/catalog_system/pub/products/search?Rayban');
        return Response($result, $result['status']);
    }
}
