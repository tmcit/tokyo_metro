<?php
	
	class metro {
		private $token 	= '5dd14250f3a9800f224dff10be83fe71a4d4f8d803e340f7e4422775978a97b5';
		private $base_url  = 'https://api.tokyometroapp.jp/api/v2/';
		private $color_code_json;
		private $metro_train_ownerDict_json;
		private $metro_train_typeDict_json;
		private $metro_railwayDict_json;
		private $metro_rail_directionDict_json;
		private $metro_stationDict_json;
		private $other_stationDict_json;

		public function __construct() {
                        $baseFolder = dirname(__FILE__) ."/../json/tokyo_metro_json";
			$this->color_code_json = file_get_contents(dirname(__FILE__) ."/../json/color_code/color_code.json");
			$this->metro_train_ownerDict_json = file_get_contents($baseFolder ."\metro_train_ownerDict.json");
			$this->metro_train_typeDict_json = file_get_contents($baseFolder ."\metro_train_typeDict.json");
			$this->metro_railwayDict_json = file_get_contents($baseFolder ."/metro_railwayDict.json");
			$this->metro_rail_directionDict_json = file_get_contents($baseFolder ."\metro_rail_directionDict.json");
			$this->metro_stationDict_json = file_get_contents($baseFolder ."\metro_stationDict.json");
			$this->other_stationDict_json = file_get_contents($baseFolder ."\other_stationDict.json");                        
		}

                /**
                 * 任意のリクエストパラメータから、駅情報 odpt:Stationを提供します。
                 * @param type $reqArray リクエストパラメータの配列。
                 * @return type 駅情報 odpt:Station
                 */
                public function searchStationFromRequestArray($reqArray){
                        return self::get_datapoints($reqArray);
                }                
                
		//緯度,経度,半径から駅を検索
		public function searchStation($lat, $lon, $radius) {
			$prm= array('rdf:type'=>'odpt:Station', 'lat'=>$lat, 'lon'=>$lon, 'radius'=>$radius);
			$data = self::get_places($prm);
	
			foreach ($data as $key=>$value) {
			if ($value->{"dc:title"} === "中野新橋" || $value->{"dc:title"} === "中野富士見町" || $value->{"dc:title"} === "方南町") {
					unset($data[$key]);
			}
			else {
					//	路線
					if ($value->{'odpt:railway'}) {
						$railway = self::cut_word( $value->{'odpt:railway'})[1];
						$value->{'odpt:railway'} = self::railway_jp($railway);
				 	}
	
					//	社名
					if( $value->{'odpt:operator'} ){
						$operator = self::cut_word( $value->{'odpt:operator'})[0];
						$value->{'odpt:operator'} = self::train_owner_jp($operator);
					}
					// 乗り換え可能路線
					if ($value->{'odpt:connectingRailway'}) {
						foreach ($value->{'odpt:connectingRailway'} as $key=>$railway) {
							$value->{'odpt:connectingRailway'}{$key} = self::railway_jp(self::cut_word($railway)[1]);	
						}
					}
				}
				
			}

			return $data;
		}
                
                /**
                 * 任意のリクエストパラメータから、地物情報 ug:Poiを提供します。
                 * @param type $reqArray リクエストパラメータの配列。
                 * @return type 地物情報 ug:Poi。
                 */
                public function searchStationExitFromRequestArray($reqArray){
                        return self::get_datapoints($reqArray);
                }

		//緯度,経度,半径から,駅の出口を検索
		public function searchStationExit($lat, $lon, $radius) {
			$prm= array('rdf:type'=>'ug:Poi', 'lat'=>$lat, 'lon'=>$lon, 'radius'=>$radius);
			$data = self::get_places($prm);
			foreach ($data as $key => $value) {
				if (stristr($value->{"dc:title"}, "中野新橋") || stristr($value->{"dc:title"}, "中野富士見町") || stristr($value->{"dc:title"}, "方南町"))
				unset($data[$key]);
			}
			return $data;
		}

		public function station($station_name) {
			$prm= array('rdf:type'=>'odpt:Station', 'dc:title'=>$station_name);
			$data = self::get_datapoints($prm);
			foreach ($data as $value) {
				//	路線
				if( $value->{'odpt:railway'} ){
					$railway = self::cut_word( $value->{'odpt:railway'})[1];
					// print $data;
					$value->{'odpt:railway'} = self::railway_jp($railway);
				 }
	
				//	社名
				if( $value->{'odpt:operator'} ){
					$operator = self::cut_word( $value->{'odpt:operator'})[0];
					$value->{'odpt:operator'} = self::train_owner_jp($operator);
				}
				// 乗り換え可能路線
				if ($value->{'odpt:connectingRailway'}) {
					foreach ($value->{'odpt:connectingRailway'} as $key=>$railway) {
						$value->{'odpt:connectingRailway'}{$key} = self::railway_jp(self::cut_word($railway)[1]);	
					}
				}
			}
			return $data;
		}	

		public function stations($railway_name) {
			$prm= array('rdf:type'=>'odpt:Station', 'odpt:railway'=>$railway_name);
			$data = self::get_datapoints($prm);
			$array = array();
			$railway_jp_name = self::railway_jp(self::cut_word($railway_name)[1]);
			if ($railway_name === 'odpt.Railway:TokyoMetro.Ginza') {
				foreach ($data as $key=>$value) {
					$array += array($key=>array('color_code'=>'#FF9500','odpt:stationcode'=>$value->{'odpt:stationCode'}, "station_eng_name"=>self::cut_word($value->{'owl:sameAs'})[2] , "station_jp_name"=>$value->{'dc:title'}, "railway_jp_name"=>$railway_jp_name));
				}
			}
			else if ($railway_name === 'odpt.Railway:TokyoMetro.Marunouchi') {
				$nakano_station = null;
				foreach ($data as $key=>$value) {
					if ($value->{"dc:title"} === "中野坂上" && $nakano_station == null) {
						$nakano_station = $value->{"dc:title"};
					}
					else if ($value->{"dc:title"} === "中野坂上" && $nakano_station != null) {
						continue;
					}
					if ($value->{"dc:title"} === "中野新橋" || $value->{"dc:title"} === "中野富士見町" || $value->{"dc:title"} === "方南町") {
						continue;
					}
					else {
						$array += array($key=>array('color_code'=>'#F62E36','odpt:stationcode'=>$value->{'odpt:stationCode'}, "station_eng_name"=>self::cut_word($value->{'owl:sameAs'})[2] , "station_jp_name"=>$value->{'dc:title'}, "railway_jp_name"=>$railway_jp_name));				
					}
				
				
				}
			}
			else if ($railway_name === 'odpt.Railway:TokyoMetro.Hibiya') {
				foreach ($data as $key=>$value) {
					$array += array($key=>array('color_code'=>'#B5B5AC','odpt:stationcode'=>$value->{'odpt:stationCode'}, "station_eng_name"=>self::cut_word($value->{'owl:sameAs'})[2] , "station_jp_name"=>$value->{'dc:title'}, "railway_jp_name"=>$railway_jp_name));
				}
			}
			else if ($railway_name === 'odpt.Railway:TokyoMetro.Tozai') {
				foreach ($data as $key=>$value) {
					$array += array($key=>array('color_code'=>'#009BBF','odpt:stationcode'=>$value->{'odpt:stationCode'}, "station_eng_name"=>self::cut_word($value->{'owl:sameAs'})[2] , "station_jp_name"=>$value->{'dc:title'}, "railway_jp_name"=>$railway_jp_name));
				}
			}
			else if ($railway_name === 'odpt.Railway:TokyoMetro.Chiyoda') {
				foreach ($data as $key=>$value) {
					if ($value->{'dc:title'} === "明治神宮前〈原宿〉")
						$value->{'dc:title'} = "明治神宮前";
					$array += array($key=>array('color_code'=>'#00BB85','odpt:stationcode'=>$value->{'odpt:stationCode'}, "station_eng_name"=>self::cut_word($value->{'owl:sameAs'})[2] , "station_jp_name"=>$value->{'dc:title'}, "railway_jp_name"=>$railway_jp_name));
				}
			}
			else if ($railway_name ==='odpt.Railway:TokyoMetro.Yurakucho') {
				foreach ($data as $key=>$value) {
					$array += array($key=>array('color_code'=>'#C1A470','odpt:stationcode'=>$value->{'odpt:stationCode'}, "station_eng_name"=>self::cut_word($value->{'owl:sameAs'})[2] , "station_jp_name"=>$value->{'dc:title'}, "railway_jp_name"=>$railway_jp_name));
				}
			}
			else if ($railway_name === 'odpt.Railway:TokyoMetro.Hanzomon') {
				foreach ($data as $key=>$value) {
					if ($value->{'dc:title'} === "押上〈スカイツリー前〉")
						$value->{'dc:title'} = "押上";
					$array += array($key=>array('color_code'=>'#8F76D6','odpt:stationcode'=>$value->{'odpt:stationCode'}, "station_eng_name"=>self::cut_word($value->{'owl:sameAs'})[2] , "station_jp_name"=>$value->{'dc:title'}, "railway_jp_name"=>$railway_jp_name));
				}
			}
			else if ($railway_name === 'odpt.Railway:TokyoMetro.Namboku') {
				foreach ($data as $key=>$value) {
					$array += array($key=>array('color_code'=>'#00AC9B','odpt:stationcode'=>$value->{'odpt:stationCode'}, "station_eng_name"=>self::cut_word($value->{'owl:sameAs'})[2] , "station_jp_name"=>$value->{'dc:title'}, "railway_jp_name"=>$railway_jp_name));
				}
			}
			else if ($railway_name === 'odpt.Railway:TokyoMetro.Fukutoshin') {
				foreach ($data as $key=>$value) {
					if ($value->{'dc:title'} === "明治神宮前〈原宿〉")
						$value->{'dc:title'} = "明治神宮前";
					$array += array($key=>array('color_code'=>'#9C5E31','odpt:stationcode'=>$value->{'odpt:stationCode'}, "station_eng_name"=>self::cut_word($value->{'owl:sameAs'})[2] , "station_jp_name"=>$value->{'dc:title'}, "railway_jp_name"=>$railway_jp_name));
				}
			}

			
			arsort($array);	
			return $array;
		} 


		public function station_timetable($odpt_Station) {
			$prm = array('rdf:type'=>'odpt:StationTimetable', 'odpt:station'=>$odpt_Station);
			$data = self::get_datapoints($prm);
			foreach ($data as $value) {
				//	路線を日本語に変換.対応したカラーコードがあれば配列に追加
				if( $value->{'odpt:railway'} ) {
					$railway = self::cut_word( $value->{'odpt:railway'})[1];
					// print $data;
					$value->{'odpt:railway'} = self::railway_jp($railway);
				 }
	
				//	社名
				if( $value->{'odpt:operator'} ) {
					$operator = self::cut_word( $value->{'odpt:operator'})[0];
					$value->{'odpt:operator'} = self::train_owner_jp($operator);
				}
				// 駅
				if ($value->{'odpt:station'}) {
					$station = self::cut_word($value->{'odpt:station'})[2];
					$value->{'odpt:station'} = self::station_jp($station);
					// print_r(	$value->{'odpt:station'});
				}
				// 方面
				if ($value->{'odpt:railDirection'}) {
					$railway_direction = self::cut_word($value->{'odpt:railDirection'})[1];
					$value->{'odpt:railDirection'} = self::rail_direction_jp($railway_direction);
				}
			}
			return $data;

		}



		private function get_datapoints($prm) {
			$api_name = "datapoints";
			$api_url = $this->base_url.$api_name;
			$decoede_json = self::get_decoded_json($api_url, $prm);
			return $decoede_json;
		}

		private function get_places($prm) {
			$api_name = 'places';
			$api_url = $this->base_url.$api_name;
			$decoede_json = self::get_decoded_json($api_url, $prm);

			return $decoede_json;
		}


		// jsonをデコードして返す
		private function get_decoded_json($apiUrl, $prms) {
				$prms['acl:consumerKey'] = $this->token;
				$prms = self::get_prms($prms);
				$json = file_get_contents($apiUrl.$prms);
				$decoede_json = json_decode($json);
				return $decoede_json;
		}

		// 受け取った配列をパラメーターの形式に変換して返す
		private function get_prms($datas) {
			$temp = '';
			foreach ($datas as $key => $value) {
				$temp .= ( !$temp )?"?":"&";
				$temp .= $key."=".urlencode($value);
			}
			return $temp;
		}	

                //メトロ路線名に対応するカラーコードを取得する
                public function getColor($railway){
			// $json = file_get_contents("../json/color_code/color_code.json");
			$data = json_decode($this->color_code_json);

			foreach ($data as $key=>$value) {
				if( $key === $railway ){
					return $value;
				}
			}	
			return;          	
		}
                
                /**
                 * 駅odpt:Stationに接続する、東京メトロの全路線を取得します。
                 * @param type $station 駅情報odpt:Station。
                 * @return type 東京メトロの路線名(日本語)の配列。
                 */
                public function connectingMetroRailway($station) {
                    $connectingRailway = array(
                        $station->{"odpt:railway"}
                    );
                    foreach ((array)$station->{"odpt:connectingRailway"} as $key => $value) {
                        if($value !== NULL){
                            array_push($connectingRailway, $value);
                        }
                    }
                    return $connectingRailway;
                }                

		// 日本語の列車所有会社取得
		private function train_owner_jp($english) {
			// $json = file_get_contents("../json/tokyo_metro_json/metro_train_ownerDict.json");
			$data = json_decode($this->metro_train_ownerDict_json);

			foreach ($data as $key=>$value) {
				if( $key === $english ){
					return $value;
				}
			}
			return $english;
		}

		// 日本の列車種別取得
		private function train_type_jp($english) {
			// $json = file_get_contents("../json/tokyo_metro_json/metro_train_typeDict.json");
			$data = json_decode($this->metro_train_typeDict_json);
			foreach ($data as $key=>$value) {
				if( $key === $english ){
					return $value;
				}
			}
			return $english;
		}

		// 日本語の路線名取得
		private function railway_jp($english){
  			// $json = file_get_contents("../json/tokyo_metro_json/metro_railwayDict.json");
  			$data = json_decode($this->metro_railwayDict_json);
			foreach ($data as $key=>$value) {
				if( $key === $english ){
					return $value;
				}
			}
			return;
 		}
 		public function railway_eng($japanese) {
 			$data = json_decode($this->metro_railwayDict_json);
			foreach ($data as $key=>$value) {
				if( $value === $japanese ){
					return "odpt.Railway:TokyoMetro.".$key;
				}
			}
			return;
 		}

 		//方向
 		private function rail_direction_jp($english) {
 			// $json = file_get_contents("../json/tokyo_metro_json/metro_rail_directionDict.json");
 			$data = json_decode($this->metro_rail_directionDict_json);
			foreach ($data as $key=>$value) {
				if( $key === $english ){
					return $value;
				}
			}
			return $english;
 		}

 		// 日本語の駅名取得
		private function station_jp($english) {
			// $json = file_get_contents("../json/tokyo_metro_json/metro_stationDict.json");
			$data = json_decode($this->metro_stationDict_json);
			foreach ($data as $key=>$value) {
				if( $key === $english ){
					return $value;
				}
			}
			// $json = file_get_contents("../json/tokyo_metro_json/other_stationDict.json");
			$data = json_decode($this->other_stationDict_json);
			foreach ($data as $key=>$value) {
				if( $key === $english ){
					return $value;
				}
			}
			return $english;
		}

		private function cut_word( $string ){
			preg_match('/.*:(.*)/', $string, $data);
			return explode(".", $data[1]);
		}	
	}	
