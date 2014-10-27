<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>サンプル：ストリートビューの表示</title>
    <script src="http://maps.google.com/maps/api/js?sensor=false"
            type="text/javascript" charset="utf-8"></script>
    <script src="./googlemap.js" type="text/javascript"></script>
  </head>
  <body onload="initialize()">
    <div id="map_canvas" style="width: 40%; height: 100%; float: left"></div>
     <!-- <div id="panel" style="margin-left:-100px"> -->
      <!-- <input type="button" value="Toggle Street View" onclick="toggleStreetView();"></input> -->
    <div id="pano" style="width: 40%; height: 100%; float: left"></div>
    <div id="currentTime"></div>
    <p>
      <form>
        <?php
          $json = file_get_contents('../json/tokyo_metro_json/metro_stationDict.json');
          $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
          $data = json_decode($json,true);
          echo 'スタート駅は', '<select name="startStation">';
          foreach ($data as $key => $value) {
            echo "<option value=$key>$value</option>";
          }
          echo '</select>';
          echo "<input type='submit' value='送信'/>";
        ?>
      </form>
    </p>
  </body>
</html>
