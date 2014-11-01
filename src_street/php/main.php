<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body body bgcolor="#ffffff">
        <?php
            require 'GuruNavi.php';
            require 'GuruNaviParser.php';
            
			print($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
			
            echo "testaaaaaaaaaaaaa";
            echo htmlspecialchars($_GET['lat']);
            echo $_GET['lng'];
            
        ?>
    </body>
</html>
