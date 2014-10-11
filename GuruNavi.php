<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GuruNavi
 *
 * @author YUHI
 */
class GuruNavi {
    
    private $accessKey;
    private $url = "http://api.gnavi.co.jp/ver2/RestSearchAPI/?";
            
    function __construct($accessKey) {
        $this->accessKey = $accessKey;
    } 
    
    private function GenerateRequestUrl($param){
        $req = $this->url;
        $req .= "keyid=" .$this->accessKey;
        
        foreach ($param as $key => $value) {
            $req .= "&" .$key ."=" .$value;
        }
        return $req;
    }
        
    public function GetResponse($param){
        $req = $this->GenerateRequestUrl($param);        
        return file_get_contents($req);
    }
    
}
