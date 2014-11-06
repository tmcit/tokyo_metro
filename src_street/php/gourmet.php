<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" href="../css/gourmet.css" rel="stylesheet" />
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    </head>
    <body bgcolor="#ffffff">
        <?php
            require 'GuruNavi.php';
            require 'GuruNaviParser.php';
            
            session_start();
            
            $accessKey = "0c7aaf7272c9db0e0c7da255a8bafc30";
            $param = array(
                "format" => "xml",
                "input_coordinates_mode" => "1",
                "latitude" => htmlspecialchars($_GET['lat']),
                "longitude" => htmlspecialchars($_GET['lng']),
                "range" => "1",
                "hit_per_page" => "50"
            );
            
            $gurunavi = new GuruNavi($accessKey);
            $res = $gurunavi->GetResponse($param);            
            $parser = new GuruNaviParser($res);                      
            
            echo '<div class="gourmet">';
            //html generate
            if(isset($_POST['submit'])){
                //next choice
                $selectedCategory = key($_POST['submit']);
                $rest = $parser->RestaurantMatchCategory($selectedCategory);
                echo '<form method="post" action="restinfo.php">';
                foreach ($rest as $key) {
                    echo '<input type="submit" class="rest" name="submit[' .$key->id .']" '
                            . 'value="' .$key->name->name .'"><br/>';                    
                    echo '<img src="' .$key->image_url->thumbnail .'" />';
                }
                echo '</form>';
            }
            else {
                //form draw
                $categories = $parser->GetRestaurantCategoriesCount(100);  
                echo '<form method="post" action="">';
                foreach ($categories as $key => $value) {                    
                    echo '<input type="submit" class="category" name="submit[' .$key .']" value="' .$key .'"><br/>';                    
                }
                echo '</form>';
            }
            echo '</div>';
        ?>
    </body>
</html>
