<!DOCTYPE html><html lang="ja"><head><meta charset="UTF-8">
	<title>アカウントを作ろう</title>
</head><body>
	<h2>アカウント作成</h2>
	<p>ログインは <a href="login.php">こちら</a></p>
	<form  method="post">
		<input type="hidden" name="hiddenmachine" value="<?=$sid?>">

		<p><label>メールアドレス</label></p>
		<input type="email" id="email" name="email">
		<div id="info"><!--ここにアジャの戻り値がくるよ--></div>
		<p><label>希望パスワード</label></p>
		<input type="password" id="password" name="password">
		<p><label>希望パスワード確認</label></p>
		<input type="password" id="password_conf" name="password_conf">
		<p><input type="button" id="insert" value="登録する"></p>
		<div id="regist"></div>
		<input type="hidden" name="gazo"id="gazo" value="">
	
	</form>
<img id="image_file" alt="アップした画像" style="display: none;">
	<hr>
	<form method="post" id="imgform" action="" enctype="multipart/form-data">
	ファイル:<input type="file" name="up_file"><br>
	<input type="button" id="imageup" value="設定する">
	</form>


<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script>
	$('#imageup').click(function(){
		//画像を送信してから移すまで
		var updir = '/php/ussrninshow';
		//ファイルを送りたい場合は↓
		var formdata = new FormData($('#imgform').get(0));
		$.ajax({
      url: updir + "/image_up.php",
      type: "post",
      processData: false,//文字列変換しない
      contentType: false,//デフォルトではない
      dataType: "html",
      //送信データの種類,
      data: formdata
		})
		.done(function (response){
    //通信成功時phpの戻り値がreoponseに入る
      $("#image_file").attr('src',updir + "/" + response).show();
    $('#gazo').val(response);

    })
    .fail(function(xhr,textStatus,errorThrown){
    		//通 信 失 敗
        alert('error'); 
    }); //aJax
	});



  $('#email').change(function(){
		$.ajax({//完全なURL
      url: "/php/ussrninshow/image_up.php",
      type: "post",
      dataType: "text",
      //送信データの種類,
      data:{'email':$('#email').val()}//送るデータ 複数なら「,」

    }).done(function (response){
    //通信成功時phpの戻り値がreoponseに入る
      $("div#info").html(response);

    }).fail(function(xhr,textStatus,errorThrown){
    		//通 信 失 敗
        alert('error'); 
    }); //aJax
}); //changeivent

	//ボタンを押したタイミングで双方の一致を確認
	$('#insert').click(function(){
		var pswd = $('[name="password"]').val();
		var pswdcf = $('[name="password_conf"]');
		
		if(pswd == pswdcf.val()){
			pswdcf.next().html();

			$.ajax({
			//完全なURL
      url: "/php/ussrninshow/param.php",
      type: "post",
      dataType: "text",
      //送信データの種類,
      data:{'email':$('#email').val(),'password':$('#password').val(),'gazo':$('#gazo').val()} //送るデータ 複数なら「,」

			}).done(function (response){
    //通信成功時phpの戻り値がreoponseに入る
      $("#regist").html(response);

    }).fail(function(xhr,textStatus,errorThrown){
    		//通 信 失 敗
        alert('error'); 
    }); //aJax
			return true;

				
		
		}else{
			pswdcf.after('<em>一致しません</em>');
			pswdcf.next().css('color','red');
			return false;
		}
	});
</script>
</body>
</html>