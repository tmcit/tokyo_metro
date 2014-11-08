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
            
            
            $categories = $parser->GetRestaurantCategoriesCount(50);
            foreach ($categories as $category => $count) {
                echo '<div class="panel panel-warning">';
                echo '<div class="panel-heading">' .$category .'<span class="badge">' .$count .'</span></div>';
                echo '<div class="panel-body">';
                $restaurants = $parser->RestaurantMatchCategory($category);
                foreach ($restaurants as $rest) {
                    echo '<a href="./restinfo.php?id=' .$rest->id .'">' .$rest->name->name .'</a></br>';
                }
                echo '</div></div>';
            }
        ?>
    </body>
</html>
