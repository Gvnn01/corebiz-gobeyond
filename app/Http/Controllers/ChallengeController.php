<?php

namespace App\Http\Controllers;

use App\Traits\ChallengeT;

class ChallengeController extends Controller
{
    use ChallengeT;

    public function challengeCorebiz()
    {
        $result = $this->CreateDataChallenge(env('URL'));
        return Response($result, $result['status']);
    }
}
