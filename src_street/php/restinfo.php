<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require 'GuruNavi.php';
            require 'GuruNaviParser.php';
            
            $accessKey = "0c7aaf7272c9db0e0c7da255a8bafc30";
            $gurunavi = new GuruNavi($accessKey);
        
            if(isset($_POST['submit'])){
                $id = key($_POST['submit']);
                               
                $param = array(
                    "format" => "xml",
                    "id" => $id
                );               
                $res = $gurunavi->GetResponse($param);            
                $parser = new GuruNaviParser($res);    
                $xml = $parser->GetRestaurant();
                //to gurunaviPage
                header('Location:' .$xml->rest->url);
            }
        ?>
    </body>
</html>
