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
        <link type="text/css" href="../css/inner_shadowbox.css" rel="stylesheet" />
    </head>
    <body bgcolor="#ffffff">
        <?php
            require 'WebResponse.php';            

            $accessKey = "dj0zaiZpPUlBQWJWT0tLOUJpNyZzPWNvbnN1bWVyc2VjcmV0Jng9NjA-";
            $param = array(
                "lat" => htmlspecialchars($_GET['lat']),
                "lon" => htmlspecialchars($_GET['lng']),
                "output" => "xml"
            );
            $web = new WebResponse();
            $req = "http://placeinfo.olp.yahooapis.jp/V1/get?"
                    ."appid=" .$accessKey                    
                    .$web->GenerateRequestParameter($param);
            $res = $web->GetResponse($req); 

            $xml = simplexml_load_string($res);

            echo '<div class="place">';
            echo '<div class="here">今いる場所は、' .$xml->Address ." です。</div>\n";
            echo '<div class="area">エリア名は、' .$xml->Area[0]->Name ." です。</div>\n";

            echo '<div class="info">';
            foreach ($xml->Result as $key => $value) {
				echo '<div class="name">' .$value->Name .'</div>';
				echo '<div class="category">' .$value->Category .'</div>';
				echo '<div class="combined">' .$value->Combined .'</div>';
            }
            echo '</div>';
            echo '</div>'; 
        ?>
    </body>
</html>
