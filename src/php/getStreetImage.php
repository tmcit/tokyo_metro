<?php


	class GetStreetImage {
		private $base_url = 'http://maps.googleapis.com/maps/api/streetview';
	
		public function get_street_image($prms) {
			$api_url = $this->base_url.self::get_prms($prms);
			return $api_url;
			//return file_get_contents($api_url);
		}

		private function get_prms($datas) {
			$temp = '';
			foreach ($datas as $key => $value) {
				# code...
				$temp .= (!$temp)?"?":"&";
				$temp .= $key . "=" .$value;
			}
			return $temp;
		}
	}