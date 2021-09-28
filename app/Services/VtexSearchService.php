<?php

namespace App\Services;

//? Classe de serviço Search, que utiliza a conexão.
class VtexSearchService
{
    use VtexConnect;

    public function searchServiceVtex($url)
    {
        return $this->connectGet($url)->collect();
    }
}
