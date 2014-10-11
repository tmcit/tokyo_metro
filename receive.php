<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>結果</title>
</head>
<body>
	<?php
	require 'metro.php';
	$input_data = $_POST['station'];
	echo '選択された駅は',$input_data,'です','<br>';
	$metro = new metro();
	
	//データ検索API
	$data = array('rdf:type'=>'odpt:Station',  'dc:title'=>$input_data);
	
	$datas = $metro->get_datapoints( $data );
	echo '経度';
	print_r($data->{'geo:long'});
	echo '</br>';
	echo '緯度';
	print_r($data->{'geo:lat'});
	echo '</br>';
	?>
</body>
</html>