<?php
//アップロードされているかチェック

if(@is_uploaded_file($_FILES['up_file']['tmp_name'])){
	$fils = $_FILES['up_file'];
	$img = ''; 
	//ファイル形式が画像のみ の条件を加える,
	}elseif(@is_upload_file($_FILE['up_toko']['tmp_name'])){
	$fils = $_FILES['up_toko'];
	$img = 'img/';
}

if(isset($fils)){
	$type = $fils['type'];
	$size = $fils['size'];

	if(($type == "image/jpeg" || $type == "image/png"
		 	|| $type == "image/gif") && $size < 5000000){
	//サイズは5メガまで
		if(move_uploaded_file($fils['tmp_name'],"./".$fils['name'])){
				echo $fils['name'];		
		}else{
				//コピー失敗(ディレクトリが無いかパーミッションエラーがほとんど)
				echo "アップロードに失敗しました";
		}
	}else{echo "無効なデータです";}
}else{ echo "ファイルが来ていない";}
?>