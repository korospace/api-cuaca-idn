<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiV1Controller extends Controller
{

    /**
     * Validation Messages
     */
    protected function messages()
    {
        return [
            'required' => ':attribute harus diisi',
        ];
    }

    /**
     * Weather
     */
    public function getWeather(Request $request): JsonResponse
    {
        // request validation
        $validator = Validator::make($request->query(),[
            'province' => "required",
            'city'     => "required",
        ],$this->messages());

        // if validation error
        if ($validator->fails()) {

            return response()->json($validator->getMessageBag(),400);

        }
        
        $reqProvince  = preg_replace("/ /","",$request->query('province')); // replace space
        $reqProvince  = ucwords(strtolower($reqProvince));                  // capitalize
        $reqCity = strtolower($request->query('city'));         // lowercase
        $reqCity = preg_replace("/kabupaten/","kab.",$reqCity); // kabupaten -> kab.

        $link = "https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-$reqProvince.xml";
        $xml  = @simplexml_load_file($link, "SimpleXMLElement", LIBXML_NOCDATA);

        // 404 handling
        if ($xml == false) {
            return response()->json(['message' => 'province not found'],404);
        }
        else {

            $xmlToJson  = json_encode($xml);
            $xmlToArray = json_decode($xmlToJson,TRUE);
    
            // filter by city
            $dataByCity = [];
            foreach ($xmlToArray['forecast']['area'] as $data) {
                if (strtolower($data['name'][1]) == $reqCity) {
                    $dataByCity[] = $data;
                }
            }

            if (count($dataByCity) <= 0) {
                return response()->json(['message' => 'city not found'],404);
            }
            else {

                // create district array 
                $arrDistrict = [];
                foreach ($dataByCity as $district) {
        
                    foreach ($district['parameter'] as $p) {
                        $now = [];
                        
                        foreach ($p['timerange'] as $t) {
                            $dateTime  = Helpers::createTimeStamp($t['@attributes']['datetime']);
                            $attrValue = Helpers::createAttrValue($t['value'],$p['@attributes']['description']);
                            
                            // now
                            if (time() < strtotime($dateTime)) {
                                $now[] = [
                                    "timestamp" => $dateTime,
                                    "value"     => $attrValue,
                                ]; 
                            }
                            
                            // three_days_ahead
                            $arrDistrict[$district['name'][0]]['three_days_ahead'][$p['@attributes']['description']][] = [
                                "timestamp" => $dateTime,
                                "value"     => $attrValue,
                            ];
                        
                        }

                        $arrDistrict[$district['name'][0]]['now'][$p['@attributes']['description']] = $now[0];
                            
                    }
        
                }
        
                $data = [
                    'timestamp' => Helpers::createTimeStamp($xmlToArray['forecast']['issue']['timestamp']),
                    'province'  => $request->query('province'),
                    'city'      => $request->query('city'),
                    'district'  => $arrDistrict,
                ];
        
                return response()->json($data,200);

            }
    
        }

    }

    /**
     * Province
     */
    public function getProvince(): JsonResponse
    {
        $output = Helpers::curlData("https://dev.farizdotid.com/api/daerahindonesia/provinsi",array('Content-Type:application/json'));
    
        return response()->json($output['provinsi'],200);
    }

    /**
     * City
     */
    public function getCity(Request $request): JsonResponse
    {
        // request validation
        $validator = Validator::make($request->query(),[
            'provId' => "required",
        ],$this->messages());

        // if validation error
        if ($validator->fails()) {

            return response()->json($validator->getMessageBag(),400);

        }

        $output = Helpers::curlData(
            "https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=".$request->query('provId'),
            array('Content-Type:application/json')
        );
    
        return response()->json($output['kota_kabupaten'],200);
    }

}
