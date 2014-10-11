//データ検索API
//$data = array( 'rdf:type' => 'odpt:RailwayFare', 'odpt:fromStation' => 'Tokyo', 'odpt:toStation' => 'Ayase' );
$data = array( 'rdf:type' => 'odpt:StationTimetable', 'odpt:railway' => 'TokyoMetro.Hanzomon' );
$json = $metro->datapoints( $data );

/*

//地物情報API
$data = array( 'rdf:type' => 'ug:Poi', 'lon' => '139.766926', 'lat' => '35.681265', 'radius' => '1000' );
$json = $metro->places( $data );

*/

//変数のダンプ出力
var_dump( $json );
