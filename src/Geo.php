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
    protected $response;

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
     * @return Geo
     */
    public function geocode()
    {
        $uri = $this->uri.'?q='.$this->query.'&addr_limit='.$this->limit.'&apikey='.$this->apikey.'&format='.$this->format;
        $response = $this->guzzle->get($uri)->getBody()->getContents();
        $response = json_decode($response, 1);
        $this->response = $response;
        return $this;
    }

    /**
     * Получение ответа в исходном виде от Sputnik.Geocoder
     *
     * @return array
     */
    public function getContent()
    {
        return $this->response;
    }

    /**
     * Получение строки адреса от Sputnik.Geocoder
     *
     * @return string
     */
    public function getFullAddress()
    {
        $description = implode(',',
            array_reverse(
                explode(',', $this->response['result']['address'][0]['features'][0]['properties']['description'])
            )
        );
        $title = $this->response['result']['address'][0]['features'][0]['properties']['title'];
        $full = $description.', '.$title;
        return $full;
    }

    /**
     * Точность определения адреса (например: house, street, admin)
     *
     * @return string
     */
    public function getKind()
    {
        return $this->response['result']['address'][0]['features'][0]['properties']['type'];
    }

    /**
     * Получение координат в формате lon/lat (не стандартно)
     *
     * @param bool $line
     * @return string
     */
    public function getCoordinates(bool $line=false)
    {
        $geometry = $this->response['result']['address'][0]['features'][0]['geometry']['geometries'];
        $coordinates = $geometry['coordinates'];
        $coordinates = $line ? $coordinates[0].' '.$coordinates[1] : $coordinates;
        return $coordinates;
    }

}
