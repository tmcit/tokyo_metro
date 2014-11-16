<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>東京メトロ de ぶらり旅</title>
    </head>
    <body>
        <?php
            require 'GuruNavi.php';
            require 'GuruNaviParser.php';
            
            $accessKey = "0c7aaf7272c9db0e0c7da255a8bafc30";
            $gurunavi = new GuruNavi($accessKey);
        
            $id = htmlspecialchars($_GET['id']);

            $param = array(
                "format" => "xml",
                "id" => $id
            );               
            $res = $gurunavi->GetResponse($param);            
            $parser = new GuruNaviParser($res);    
            $xml = $parser->GetRestaurant();
            //to gurunaviPage
            header('Location:' .$xml->rest->url);
        ?>
    </body>
</html>
