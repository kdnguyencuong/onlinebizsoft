<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LẤY DỮ LIỆU WEBSITE TỪ URL</title>
	<link rel="stylesheet" href="">
	<script src="js/jquery-3.2.1.min.js"></script>
	<style>
		.container{
			width: 1000px;
			margin:0 auto;
		}

		table{
			/*position: absolute;
			right:0;
			left: 0;
			bottom: 0;
			top:0;*/
			margin:auto;
			width: 50%;
		}

		input[type="text"]{
			width: 100%;
		}

		textarea{
			width: 100%;
		}
	</style>
	<script>
	function post_Data(){
		var url = $('#url').val();
		var title = $('#attTitle').val();
		var date = $('#attDate').val();
		var content = $('#attContent').val();

		var error = {url:"Url not empty!", title:"Title not empty!", date:"Date not empty !",content:"Content not empty !"}; 

			if(url == ''){
				alert(error["url"]);
				$('#url').focus();
				return false;
			}

			if(title == ''){
				alert(error["title"]);
				$('#attTitle').focus();
				return false;
			}

			if(date == ''){
				alert(error["date"]);
				$('#attDate').focus();
				return false;
			}

			// if(description == ''){
			// 	alert(error["description"]);
			// 	$('#attDes').focus();
			// 	return false;
			// }

			if(content == ''){
				alert(error["content"]);
				$('#attContent').focus();
				return false;
			}

			$.ajax({
			url : 'data.php',
			type : 'post',
			dataType : 'json',
			data : {
				url : url,
				title : title,
				date : date,
				content : content
			},
			success : function($result){
				console.log($result[1]);
				var html = '';
					html += '<table border="1" cellspacing="0" cellpadding="10">';
					html += '<tr>';
						html += '<td colspan="2" style="color:red;border:none;font-weight:bold;text-align:center">';
							html += 'DATA FROM DATABASE WHEN INSERT DATA';
						html += '</td>';
					html += '</tr>';
					html += '<tr>';
						html += '<td>';
							html += 'url';
						html += '</td>';
						html += '<td>';
							html+= $result[1];
						html += '</td>';
					html += '</tr>';
					html += '<tr>';
						html += '<td>';
							html += 'title';
						html += '</td>';
						html += '<td>';
							html+= $result[2];
						html += '</td>';
					html += '</tr>';
					html += '<tr>';
						html += '<td>';
							html += 'date';
						html += '</td>';
						html += '<td>';
							html+= $result[3];
						html += '</td>';
					html += '</tr>';
					html += '<tr>';
						html += '<td>';
							html += 'description';
						html += '</td>';
						html += '<td>';
							html+= $result[4];
						html += '</td>';
					html += '</tr>';
					html += '<tr>';
						html += '<td>';
							html += 'content';
						html += '</td>';
						html += '<td>';
							html+= $result[5];
						html += '</td>';
					html += '</tr>';

					html += '</table>';

					$('#result').html(html);
			}
		});

		
	}
	</script>
</head>
<body>
	<div class="container">
	<div style="text-align: center;">
		MỜI ANH TÙNG NHẬP TEST LẤY DATA TỪ 1 URL
	</div>
	<hr>
	<p>
		Mẫu URL:
		<hr>
		<br>
		Mẫu 1 : http://vietnamnet.vn/vn/thoi-su/rut-giay-phep-cong-ty-da-cap-thien-ngoc-minh-uy-368471.html
		<br>
		Các thuộc tính cần nhập của mẫu 1 :
		<br>
		title : h1.title
		<br>
		date : span.ArticleDate
		<br>
		content : #ArticleContent
		<br>
		<hr>
		Mẫu 2 : http://thethao.vnexpress.net/tin-tuc/bong-da-trong-nuoc/clb-han-quoc-khong-muon-xuan-truong-ve-nuoc-doi-dau-u20-argentina-3575650.html
		<br>
		Các thuộc tính cần nhập của mẫu 1 :
		<br>
		title : #box_details_news .title_news h1
		<br>
		date : #box_details_news .block_timer
		<br>
		content : #box_details_news .fck_detail
		<br>
		<hr>
	</p>
	<form action="" method="POST">
		<table border='1'>
			<tr>
				<td colspan="2" style="text-align: center;color:red;font-weight: bold;border:none">GET DATA WEBSITE BY URL</td>
			</tr>
			
			<tr>
				<td>URL :</td>
				<td>
					<input type="text" value="" name="url" id="url"/>
				</td>
			</tr>
			<tr>
				<td>Please enter id | class of title:</td>
				<td>
					<input type="text" value="" id="attTitle" name="attTitle"/>
				</td>
			</tr>
			<tr>
				<td>Please enter id | class of date:</td>
				<td>
					<input type="text" value="" id="attDate" name="attDate"/>
				</td>
			</tr>
			<tr>
				<td>Please enter id | class of content:</td>
				<td>
					<input type="text" value="" id="attContent" name="attContent"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="button" name="btnSubmit" value="GET DATA" id="btnSubmit" onclick="post_Data()">
				</td>
			</tr>
			
		</table>
		</form>
		<div id="result">
			
		</div>
	</div>
</body>
</html>