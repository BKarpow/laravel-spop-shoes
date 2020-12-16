<?php


namespace App\Traits;


trait NovaPoshtaAPI
{

    /**
     * Будує рядок запиту для апі нової пошти
     * @param string $model
     * @param string $method
     * @param array $property
     * @param bool $api_key
     * @return string
     */
    private function apiQueryBuild(string $model,
                                   string $method,
                                   array $property = [],
                                   bool $api_key = true):string
    {
        if ($api_key) $query['apiKey'] = $this->token;
        $query['modelName'] = $model;
        $query['calledMethod'] = $method;
        $query['methodProperties'] = (object) $property;
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/loggerNP.txt',
            json_encode($query).PHP_EOL.PHP_EOL, FILE_APPEND);
        return json_encode($query);
    }

    /**
     * Виконує пост запит
     * @param string $url
     * @param string $query
     * @return bool|array
     */
    private function post(string $url, string $query)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => True,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $query,
            CURLOPT_HTTPHEADER => array("content-type: application/json",),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return json_decode( $response, true);
    }


    public function getRegions()
    {
        return $this->post($this->url,
            $this->apiQueryBuild(
                'Address',
                'getAreas'
            )
        );
    }

    public function getCity(string $search_string)
    {
        return $this->post($this->url,
            $this->apiQueryBuild(
                'Address',
                'getCities',
                [
                    'FindByString' => $search_string
//                    'Warehouse' => 1
                    ]
            )
        );
    }


    /**
     * Повертає список ввіділень для міста
     * @param string $city_ref
     * @param string $city_name
     * @return array|bool
     */
    public function getBranch(string $city_ref, string $city_name)
    {
        return $this->post($this->url,
            $this->apiQueryBuild(
                'Address',
                'getWarehouses',
                ['CityRef' => $city_ref, 'CityName'=>$city_name]
            )
        );
    }

    /**
     * Розраховує вартість доставки
     * @param string $city_rec
     * @param float $weight
     * @return array|bool
     */
    function calculationCast(string $city_rec, float $weight)
    {
        $property = [
            'CitySender' => env('NOVA_POSHTA_CITY_SENDER', ''),
            'CityRecipient' => $city_rec,
            'Weight' => $weight,
            'Cost' => 850,
            'SeatsAmount' => '1',
            'CargoType' => 'Cargo',
            "ServiceType" => "DoorsDoors"
        ];
        return $this->post($this->url,
            $this->apiQueryBuild(
                'InternetDocument',
                'getDocumentPrice',
                $property
            )
        );
    }
}
