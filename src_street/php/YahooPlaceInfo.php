<?php
require 'WebResponse.php';  

class YahooPlaceInfo {          

    private $apiurl = "http://placeinfo.olp.yahooapis.jp/V1/get?";
    private $accessKey = "dj0zaiZpPUlBQWJWT0tLOUJpNyZzPWNvbnN1bWVyc2VjcmV0Jng9NjA-";
    private $web;

    function __construct() {
        $this->web = new WebResponse();
   }


    public function getPlaceInfo($lat, $lng) {
        $param = array(
            "lat" => $lat,
            "lon" => $lng,
            "output" => "xml"
        );
        
        $req = $this->apiurl ."appid=" .$this->accessKey . $this->web->GenerateRequestParameter($param);
        $res = $this->web->GetResponse($req); 
        $xml = simplexml_load_string($res);
        
        return $xml;
    }
    
    public function getSymbolBuilding($placeInfo){
        $name = [];
        
        foreach ($placeInfo->Area as $key => $value){
            if($value->{"Type"} == 1) {
                $name[] = $value->{"Name"};
            }
        }        
        return $name;
    }
    
    public function getSymbolArea($placeInfo){
        $name = [];
        
        foreach ($placeInfo->Area as $key => $value){
            if($value->{"Type"} == 2) {
                $name[] = $value->{"Name"};
            }
        }        
        return $name;
    }
}
