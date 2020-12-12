<?php


namespace App\Traits;


trait TracingGeoIp
{
    private string $url_api = 'https://api.sypexgeo.net/json/';

    /**
     * Повертає інформацію з апі сайту SypexGeo про ір користувача
     * @param string $ip
     * @return mixed
     */
    public function getInfoFromIp(string $ip){
        return json_decode(file_get_contents($this->url_api . $ip), true);
    }
}
