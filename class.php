<?php 
	require_once('simple_html_dom.php');

	class BaseClass{
		public $html_content = '';
		public $data_clean = array();

		public function get_title($link,$att_tag){
			if($this->html_content == ''){	
				$html = file_get_html($link);
				$this->html_content = $html;
			}
			else{
				$html = $this->html_content;
			}

			foreach ($html->find($att_tag) as $item) {
				$title = $item->innertext; 
			}

			return $title;

		}

		public function get_content($link,$att_tag){
			if($this->html_content == ''){
				$html = file_get_html($link);
				$this->html_content = $html;
			}else{
				$html = $this->html_content;
			}

			foreach ($html->find($att_tag) as $item) {
				$content = $item->plaintext;
			}

			$html = str_get_html($content);

			foreach ($this->data_clean as $clean) {
				foreach ($html->find($clean) as $val) {
					$val->outertext = '';
				}
			}

			$ret = $html->save();
			return $ret;
		}

		public function get_date($link,$att_tag){
			if($this->html_content == ''){
				$html = file_get_html($link);
				$this->html_content = $html;
			}else{
				$html = $this->html_content;
			}

			$date = $html->find($att_tag,0)->innertext;

			return $date;
		}


	}

	class Database extends BaseClass{
		private $__conn = '';
		protected $_link = '';
		public $_title = '';
		public $_date = '';
		public $_descriptopn = '';
		public $_content = '';
		protected $_table = '';

		//Hàm kết nối
		function connect(){
			try {

			    $this->__conn = new PDO('mysql:host=localhost;dbname=php_example;charset=utf8','root','');
			    // echo 'Kết nối thành công';

			} catch (PDOException $e) {
			    print "Error!: " . $e->getMessage() . "<br/>";
			    die();
			}
		}

		//Hàm ngắt kết nối
		function dis_connect(){
			$this->__conn = null;
		}

		public function set_title($att){
			return parent::get_title($this->_link,$att);
		}

		public function set_date($att){
			return parent::get_date($this->_link,$att);
		}

		public function set_content($att){
			return parent::get_content($this->_link,$att);
		}

		public function set_short_content($data){
			return substr($data,0,200);
		}

		function insert($data){
			$this->connect();
			$table = $this->_table;
			//Lưu trữ danh sách field
			$field_list = '';

			//Lưu trữ danh sách giá trị tương ứng với field
			$value_list = '';

			foreach ($data as $key => $value) {
				$field_list .= ','.$key;
				$value_list .= ','.$this->__conn->quote($value);
			}

			$field_key = trim($field_list, ',');
			$field_val = trim($value_list, ',');
			//var_dump($field_val);
			//Vì sau vòng lặp các biến $field_list và $value_list sẽ thừa 1 dấu ,nên ra sẽ dùng hàm 
			//trim để xóa đi
			$sql = "INSERT INTO $table($field_key) VALUES ($field_val)";
			//var_dump($sql);
			$stmt = $this->__conn->exec($sql);
			return $stmt;
			$this->dis_connect();
		}

		function get_row(){
			$this->connect();
			$table = $this->_table;
			$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
			$stmt = $this->__conn->prepare($sql); 
			$stmt->execute(); 
			$row = $stmt->fetch();

			return $row;
			$this->dis_connect();
		}
	}
?>