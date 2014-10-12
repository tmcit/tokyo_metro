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
        <p align="center">
            地上の苦痛こそ、我らが糧。<br>
            苦境を通じ神聖なものへ。<br>
            困難を通じて楽園へ。<br>
        </p>
        <?php
            require 'metro.php';
            $input_data = $_POST['station'];
            $metro = new metro();

            //データ検索API
            $data = array('rdf:type'=>'odpt:Station',  'dc:title'=>$input_data);
            $datas = $metro->get_datapoints( $data );
                        
            echo '<form method="post" action="gurunavi_test.php">';                  
            echo '<input type="submit" value="' .$input_data. '駅周辺の楽園を探す"><br/>';
            echo '</form>';
            session_start();
            $_SESSION['long'] = $datas[0]->{'geo:long'};
            $_SESSION['lat'] = $datas[0]->{'geo:lat'};
        ?>
    </body>
</html>
