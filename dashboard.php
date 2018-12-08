<?php
	session_start();
	date_default_timezone_set('Asia/Tokyo');

//1.送信されていたら
//4.投稿者ID(Author)取得の方法は
	if( !empty($_POST['toko']) && !empty($_POST['Author'])){ //空じゃなければtrue
//2.DBにつなげる
		require_once("connect.php");
		$dbh = dbconnect();
//3.php 現在時刻の取得
		$post_date = date("Y-m-d H:i:s");//「-」区切り
//5.INSERTするSQL文→実行
		$sql = "INSERT INTO posts(post, post_date, Author)
		VALUES (?, ?, ?)";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1,$_POST['toko'],PDO::PARAM_STR);
	$stmt->bindValue(2,$post_date,PDO::PARAM_STR);
	$stmt->bindValue(3,$_POST['Author'],PDO::PARAM_INT);
	$stmt->execute();
}//投稿はここまで
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>投稿文作成</title>
</head>
<body>
<?php 
	if (empty($_SESSION['code'])) {
		echo "ログインしてください";
	}
?>
	<form id="imgform" action="" method="post" enctype="multipart/form-data">
		<input type="file" name="up_file">
		<input type="button" id="mediaup" value="アップロード">
	</form>
	<hr>
	<img id="image_file" alt="アップした画像" style="display: none;">

	<form accept="" method="post">
		<h2>タイトル</h2>
		<input type="text" name="title" id="title"><br>
		<h2>内容</h2>
		<textarea name="toko" id="toko" cols="30" rows="10"></textarea>
		<input type="hidden" value="<?=$_SESSION['code']?>" name="Author">
		<p><input type="submit" value="公開"></p>
	</form>


<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script>
	$('#mediaup').click(function(){
	 //画像送信して映すまでのajax通信を書く
	 var updir = '/php/ussrninshow';
	 //ファイルを送る場合はこうかく↓
	 var formdata = new FormData($('#imgform').get(0));
	 $.ajax({
    url: "http://localhost/" + updir + "/image_up.php",
		type: "post",   //method
		processData: false, //文字列に変換しない
   contentType: false, // デフォルトではない
    dataType: "html",  // 送信データの種類 ,html ,json とか
    data:formdata 
	})
	.done(function (response) {
  	// 通信が成功した場合 php からの戻り値がreoponseにはいる
		$("#image_file").attr('src',updir + "/img/" + response).show();
		$('#gazo').val(response);  //画像のhiddenフィールドに入れる
		$('textarea').text("<img src='"+gazoName+"'>");
	})
	.fail(function (xhr,textStatus,errorThrown) {
      //通信が失敗した場合
      alert('error');
  });
});
</script>

</body>
</html>