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
            require '../../src/php/metro.php';

            $lat = htmlspecialchars($_GET['lat']);
            $lng = htmlspecialchars($_GET['lng']);
            
            $metro = new metro();
            $station = $metro->searchStation($lat, $lng, 1000);
            
            //var_dump($station);
            echo '<div class="station">';
            foreach ($station as $key) {
                echo '<div class="title">' .$key->{"dc:title"} .'</div>';
                echo '<div class="railway">' .$key->{"odpt:railway"} .'</div>';
            }
            echo '</div>';
        ?>
    </body>
</html>