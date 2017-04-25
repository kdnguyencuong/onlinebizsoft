<?php 

		include_once('class.php');
		include_once('helper.php');

		class Tin extends Database{
			
			function __construct(){
				global $url;
				$this->_table = 'news';
				$this->_link = $url;
				parent::connect();
			}
		}
		$url = isset($_POST['url']) ? $_POST['url'] : false;
		$title = isset($_POST['title']) ? $_POST['title'] : false;
		$date = isset($_POST['date']) ? $_POST['date'] : false;
		$content = isset($_POST['content']) ? $_POST['content'] : false;
		$tin = new Tin();

		$tieude = $tin->set_title($title);
		$link = changeTitle($tieude);
		preg_match('/[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}/',$tin->set_date($date),$view);
		$ngaythang = implode('',$view);
		$str_date = DateTime::createFromFormat('d/m/Y',$ngaythang);
		$date_insert = $str_date->format('Y-m-d');
		$noidung = $tin->set_content($content);
		$mota = $tin->set_short_content($noidung);

		$data = array('url' => $link,'title' => $tieude,'date' => $date_insert,'description' => $mota,'content' => $noidung);

			
		$tin->insert($data);

		$result = $tin->get_row();
		die(json_encode($result));
		//die(json_encode($result));
		// var_dump($tieude);
		// var_dump($ngaythang);
		// var_dump($noidung);
		// var_dump($mota);
		// var_dump($link);
		// $url = 'http://vietnamnet.vn/vn/thoi-su/rut-giay-phep-cong-ty-da-cap-thien-ngoc-minh-uy-368471.html';

		// $obj = new BaseClass();
		// $obj->data_clean = array('script','.thumblock');
		// $date = $obj->get_date($url,'span.ArticleDate');
		// preg_match('/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}/',$date,$view);
		// $date = implode('',$view);
		// $content = $obj->get_content($url,'#ArticleContent');
		//h1.title span.ArticleDate #ArticleContent
		//var_dump($content);
		//$content1 = $obj->remove_link($content);
		// $content = $obj->remove_first_element($content,'p');
		// $content = $obj->remove_last_element($content,'p');
		
?>