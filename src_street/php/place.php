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
        <link type="text/css" href="../css/place.css" rel="stylesheet" />
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    </head>
    <body bgcolor="#ddd">
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

            echo '<div id="header">"' .$xml->Address .'" 付近の施設情報</div>';
            echo '<div class="place">';
            
            foreach ($xml->Result as $key => $value) {
                echo '<div class="drop-shadow info">';
                    echo '<h2 class="name">' .$value->Name .'</h2>';
                    
                    echo'<div class="more">';
                    echo '<span class="label" id="cate">カテゴリ</span>';
                    echo '<p class="category">' .$value->Category .'</p>';
                    echo '<div style="clear:both;"></div></div>';
                    
                    echo'<div class="more">';
                    echo '<span class="label" id="comb">場所</span>';
                    echo '<p class="combined">' .$value->Combined .'</p>';
                    echo '<div style="clear:both;"></div></div>';
                echo '</div>';
            }
            echo '</div>'; 
            echo '<div id="footer">Area:　' .$xml->Area[0]->Name ."　　</br>"
                    .'Address:　' .$xml->Address .'　　</div>';
        ?>
    </body>
</html>
