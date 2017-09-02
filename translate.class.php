<?php 


/**
* 
*/
class Translator {
	public static $_instance = null;
	private $db;
	public function __construct(){
		$this->db = new Db();
	}


	public function trans($word = '', $lang, $upperCase = false, $lowerCase = false, $scram = array()){



		$query = $this->db->queryNoFilter("SELECT * from master_data.tbl_language_modify where l_id = :l_id", array(':l_id'=>$lang));
		$words_arr = array(); /*STORE CERTAIN WORDS THAT YOU WANT TO TRANSLATE INTO ARRAY*/
		if($query->count()>0){
			foreach ($query->results() as $res_parent) {
				$words_arr[$res_parent->words] = $res_parent->converted_words;
			}
		}


		if(!empty($word)){
			if(array_key_exists($word, $words_arr)){

				if($upperCase){
					return strtoupper($words_arr[$word]);
				}else{
					return $words_arr[$word];

				}
			}
		}else{

			$scramble = array();
			foreach ($scram as $key => $value) {
				if(array_key_exists($value, $words_arr)){
					if($upperCase){
						array_push($scramble, strtoupper($words_arr[$value])); 
					}else if ($lowerCase){
						array_push($scramble, strtolower($words_arr[$value])); 
					}else{
						array_push($scramble, $words_arr[$value]); 
					}
				}else{
					array_push($scramble, $value);
				}
			}
			return implode(' ', $scramble);
		}
		
		
		if($upperCase){
			return strtoupper($word);
		}else if ($lowerCase){
			return strtolower($word);
		}else{
			return $word;
		}
		
	}

	public static function getInstance(){
		if(!isset(self::$_instance)){
		  self::$_instance = new Translator();
		}
		return self::$_instance;
	}
}