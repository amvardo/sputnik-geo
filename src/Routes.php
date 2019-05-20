<?php

namespace Anklaav\Sputnik;

class Routes
{
    private $uri_general;
    private $uri_human;
    private $origins;
    private $destionations;
    
    public function __construct() 
    {
        $this->uri_general = 'http://routes.maps.sputnik.ru/osrm/router/viaroute';
        $this->uri_human = 'http://footroutes.maps.sputnik.ru/';
    }    
}
