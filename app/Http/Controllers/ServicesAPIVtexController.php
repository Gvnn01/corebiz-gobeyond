<?php

namespace App\Http\Controllers;

use App\Services\VtexSearchService;

class ServicesAPIVtexController extends Controller
{
    protected $endpointSearch;

    public function __construct()
    {
        //? Controller API VTEX que utiliza o Service Search, podendo utilizar diversos Services Diferentes.
        $this->endpointSearch = new VtexSearchService();
    }

    public function listagemSearchVtex()
    {
        return $this->endpointSearch->searchServiceVtex(env('URL'));
    }

}
