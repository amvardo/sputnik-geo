<?php

namespace Anklaav\Sputnik;

use GuzzleHttp\Client;

class Geo
{
    private $guzzle;
    private $uri;
    protected $apikey;
    protected $query;
    protected $limit;
    protected $format;

    public function __construct() 
    {
        $this->guzzle = new Client();
        $this->uri = 'http://search.maps.sputnik.ru/search/addr';
        $this->apikey = '';
        $this->query = '';
        $this->limit = 10;
        $this->format = 'json';
    }

    /**
     * Секретный ключ (пока не нужен)
     *
     * @param string $apikey
     * @return Geo
     */
    public function setToken(string $apikey): self
    {
        $this->apiKey = $apikey;
        return $this;
    }

    /**
     * Строка запроса (сам адрес)
     *
     * @param string $address
     * @return Geo
     */
    public function setQuery(string $address): self
    {
        $this->query = $address;
        return $this;
    }

    /**
     * Количество результатов (по-умолчанию 10)
     *
     * @param int $number
     * @return Geo
     */
    public function setLimit(int $number): self
    {
        $this->limit = $number;
        return $this;
    }

    /**
     * Запрос в геокодер и получение ответа
     *
     * @return array
     */
    public function geocode()
    {
        $uri = $this->uri.'?q='.$this->query.'&addr_limit='.$this->limit.'&apikey='.$this->apikey.'&format='.$this->format;
        $response = $this->guzzle->get($uri)->getBody()->getContents();
        $response = json_decode($response, 1);
        return $response;
    }

}
