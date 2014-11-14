<?php
class GuruNaviParser {
    private $xml;
            
    function __construct($xml) {
        $this->xml = simplexml_load_string($xml);
    }
        
    
    public function GetRestaurant(){
        return $this->xml;
    }
    
    
    public function GetRestaurantCategoriesCount($takeNum){
        $categoryCount = array();   
        
        foreach ($this->xml->rest as $rest) {
            $categoryName = (string)$rest->categories->category;
            //add count
            if(key_exists($categoryName, $categoryCount)){
                $categoryCount[$categoryName]++;
            }
            else {
                $categoryCount[$categoryName] = 1;
            }
        }        
        //descending order sort
        arsort($categoryCount);     
        //take
        return array_slice($categoryCount, 0, $takeNum);
    }
    
            
    public function RestaurantMatchCategory($category){
        $restArray = array();        
        
        foreach ($this->xml->rest as $rest) {
            if($category == (string)$rest->categories->category){
                array_push($restArray, $rest);
            }
        }
        return $restArray;
    }
    
    
}
