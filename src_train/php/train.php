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
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
        
        
        <link rel="stylesheet" href="../css/train.css">      
    </head>
    <body>
        
        <div class="contents_right">
            <div class="line" style="background: #0094ff"></div>
            <ul class="station">                
                <?php
                require '../../src/php/metro.php';                
                $metro = new metro();
                $stationArray =  $metro->stations("odpt.Railway:TokyoMetro.Tozai");
                
                foreach (array_reverse($stationArray) as $stajp => $value) {
                    echo '<li><div class="circle"></div>';
                    echo '<p>' .$stajp .'</p>';
                    echo '</li>';
                }   
                ?>
            </ul>
        </div>
        
        
        
    </body>
</html>
