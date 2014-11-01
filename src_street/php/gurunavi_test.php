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
            
            session_start();
            
            $accessKey = "0c7aaf7272c9db0e0c7da255a8bafc30";
            $param = array(
                "format" => "xml",
                "input_coordinates_mode" => "1",
                "latitude" => $_SESSION['lat'],
                "longitude" => $_SESSION['long'],
                "range" => "2",
                "hit_per_page" => "100"
            );
            
            $gurunavi = new GuruNavi($accessKey);
            $res = $gurunavi->GetResponse($param);            
            $parser = new GuruNaviParser($res);                      
            
            //html generate
            if(isset($_POST['submit'])){
                //next choice
                $selectedCategory = key($_POST['submit']);
                $rest = $parser->RestaurantMatchCategory($selectedCategory);
                echo '<form method="post" action="restinfo.php">';
                foreach ($rest as $key) {
                    echo '<input type="submit" name="submit[' .$key->id .']" '
                            . 'value="' .$key->name->name .'"><br/>';                    
                }
                echo '</form>';
            }
            else {
                //form draw
                $categories = $parser->GetRestaurantCategoriesCount(10);  
                echo '<form method="post" action="">';
                foreach ($categories as $key => $value) {                    
                    echo '<input type="submit" name="submit[' .$key .']" value="' .$key .'"><br/>';                    
                }
                echo '</form>';
            }            
        ?>
    </body>
</html>
