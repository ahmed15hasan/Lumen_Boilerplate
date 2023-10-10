<?php
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Carbon\Carbon;

if (!function_exists('curlRequest')) {


function curlRequest($method, $endPoint, $params = [],$curlSettings = [])
{   
    
    if (config('main.custom_log')) {
        $startTime = \Carbon::now();
    }

    $curlThroughPackage = isset($curlSettings['curlThroughPackage']) ? $curlSettings['curlThroughPackage'] : true;
    $curlSettings['requestLog'] = isset($curlSettings['requestLog']) ? $curlSettings['requestLog'] : TRUE;

    $response = null;
    if($curlThroughPackage){ // when guzzle or any package is used
        try{
            $client = new Client();
           
            $response = $client->request($method, $endPoint, $params);
             
        }catch(\Throwable $e){
            dd($e->getMessage());
            // if($log_reader = getRequestLogData("Exception",$method, $endPoint, $params,$e,$curlSettings) AND $curlSettings['requestLog']){
            //     readRequestLog($log_reader);
            // }
            throw $e;
        }
    }else{
        if("HEAD" == $method ){ // when core curl is used without any package
            $ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $endPoint);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_NOBODY, true); // for HEAD call
            $data = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE );
            curl_close ($ch);
            $response = [];
            $response['statusCode'] = $httpCode;
            $response['contentType'] = $contentType;
            $response['content'] = [];

        }else if("POST" == $method){
            \Log::debug('post condition');
            $curl = curl_init();
            curl_setopt_array($curl, $params);
            $response = curl_exec($curl);
            curl_close($curl);

        }else if("GET" == $method){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $endPoint);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec ($ch);
            curl_close($ch);
        }
    }

    try{
        if($log_reader = getRequestLogData("POST",$method, $endPoint, $params,$response,$curlSettings) AND $curlSettings['requestLog']){
            readRequestLog($log_reader);
        }
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return $response;
    } catch (\Throwable $t) {
        \Log::error($t->getMessage());
        return $response;
    }

    if (config('main.custom_log')) {
        $timeleft = $startTime->diffInMilliSeconds(Carbon::now());
        \Log::debug("CURL Request Execution Time: " . ($timeleft/1000) . " Seconds | " . $endPoint);
    }

    return $response;
}
}