<?php

class WebResponse {
    
    public function GenerateRequestParameter($param){
        $req = "";
        foreach ($param as $key => $value) {
            $req .= "&" .$key ."=" .$value;
        }
        return $req;
    }
        
    public function GetResponse($url){      
        return file_get_contents($url);
    }
    
}
