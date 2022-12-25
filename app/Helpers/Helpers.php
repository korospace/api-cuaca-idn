<?php

namespace App\Helpers;

class Helpers
{

    /**
     * CURL
     * 
     * @param string $url
     * @param array $headerItem
     */
    public static function curlData(string $url,array $headerItem): array
    {
        // persiapkan curl
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url);
        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerItem);
        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch);
        $output = json_decode($output); 
        $output = (array)$output; 
        // tutup curl 
        curl_close($ch);      
    
        // menampilkan hasil curl
        return $output;
    }

    /**
     * Create Time Stamp
     * 
     * @param string $data
     * @return string 
     */
    public static function createTimeStamp(string $data): string 
    {
        $year  = substr($data,0,4);
        $month = substr($data,4,2);
        $day   = substr($data,6,2);
        $hour  = substr($data,8,2);
        $minute= substr($data,10,2);
        $second= substr($data,12,2);

        return ($second) ? "$year-$month-$day $hour:$minute:$second" : "$year-$month-$day $hour:$minute";
    }

    /**
     * Create Attribute Value
     * 
     * @param Array|string $data
     * @param string $attrName
     * @return array|string 
     */
    public static function createAttrValue(array | string $data,string $attrName): array | string
    {
        if (is_array($data)) {
            if (strtolower($attrName) == 'wind direction') {
                return [
                    'deg'  => $data[0],
                    'CARD' => self::decodeCARD($data[1]),
                    'SEXA' => $data[2],
                ];
            }
            elseif (strtolower($attrName) == 'wind speed') {
                return [
                    'Kt'  => $data[0],
                    'MPH' => $data[1],
                    'KPH' => $data[2],
                    'MS'  => $data[3],
                ];
            } 
            elseif (in_array(strtolower($attrName),["max temperature","min temperature","temperature"])) {
                return [
                    'C'=>$data[0],
                    'F'=>$data[1]
                ];
            }
        }
        else {
            if (strtolower($attrName) == 'weather') {
                return self::decodeWeather($data);
            } else {
                return $data."%";
            }
        }
    }

    /**
     * Decode Weather
     * 
     * @param string $code
     * @return array 
     */
    public static function decodeWeather(string $code): array
    {
        $arrayCode = [
            '0'  => 'Cerah / Clear Skies',
            '1'  => 'Cerah Berawan / Partly Cloudy',
            '2'  => 'Cerah Berawan / Partly Cloudy',
            '3'  => 'Berawan / Mostly Cloudy',
            '4'  => 'Berawan Tebal / Overcast',
            '5'  => 'Udara Kabur / Haze',
            '10' => 'Asap / Smoke',
            '45' => 'Kabut / Fog',
            '60' => 'Hujan Ringan / Light Rain',
            '61' => 'Hujan Sedang / Rain',
            '63' => 'Hujan Lebat / Heavy Rain',
            '80' => 'Hujan Lokal / Isolated Shower',
            '95' => 'Hujan Petir / Severe Thunderstorm',
            '97' => 'Hujan Petir / Severe Thunderstorm'
        ];

        return [
            'icon' => $code,
            'description' => $arrayCode[$code]
        ];
    }

    /**
     * Decode WIND DIRECTION
     * 
     * @param string $code
     * @return string 
     */
    public static function decodeCARD(string $code): string
    {
        $arrayCode = [
            'N' => "North",
            'NNE' => "North-Northeast",
            'NE' => "Northeast",
            'ENE' => "East-Northeast",
            'E' => "East",
            'ESE' => "East-Southeast",
            'SE' => "Southeast",
            'SSE' => "South-Southeast",
            'S' => "South",
            'SSW' => "South-Southwest",
            'SW' => "Southwest",
            'WSW' => "West-Southwest",
            'W' => "West",
            'WNW' => "West-Northwest",
            'NW' => "Northwest",
            'NNW' => "North-Northwest",
            'VARIABLE' => "berubah-ubah"
        ];

        return strtolower($arrayCode[$code]);
    }
}
