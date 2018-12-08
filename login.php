<?php 
	session_start();//sidの醗酵
	$sid = session_id();//ssidの確認
	//フォームの入力値を確認
	if ( !empty($_POST['password'])	&& !empty($_POST['email']) ){

		require_once("mojifilter.php");
		require_once("connect.php");
			$dbh = dbconnect();
		//emailでuserテーブルを検索 ヒットした行数をカウント
	$email = h($_POST['email']);
	$password = h($_POST['password']);
	$zerofrag = false;
		
	$sql="SELECT code, email, password,timestump,counter 
				FROM users WHERE email = ?";
		$stmt = $dbh->prepare($sql);
			$stmt->bindValue(1, $email, PDO::PARAM_STR);
			$stmt->execute();

		$rowcount = $stmt->rowCount(); //行数数える
			if($rowcount){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				//1件あったらタイムストンプと現時刻の差を調べる
				if ($row['timestump']!==0 &&
					time() - $row['timestump']> (60*30) ){
					//counterを0に戻す
					if($row['counter']!=0){
							//今の値が0で無いのなら
						$sql="UPDATE users SET counter = 0 ,timestump=0 WHERE email = ? ";
						$stmt = $dbh->prepare($sql);
						$stmt->bindValue(1, $email , PDO::PARAM_STR);
						$res=$stmt->execute();
						$zerofrag = true;
						}


						//ここから,パスワード照合
					if(pv(1)){
						$_SESSION['code'] = $row['code'];
						exit;//認証成功でストップ
					}	else{
						if(!$zerofrag &&$row['counter'] >= 3){
							updateTime();
						}
					}//追加ここまで

					}else{	//30分経っていないなら?
						if($row['counter'] < 3){//失敗回数が<3
								//ここからパスワード照会
							if(pv(2)){
								$SESSION['code'] = $row['code'];
								exit;
							}
					}else{
						echo "只今ログインできません";
						//失敗回数が>=3
							updateTime();
						}
					}//30分経っていないならEND

				}else{
					//未登録
						echo "メールアドレスかパスワードが違います";
				}//else end
			}

		//パスワードをDBの値,入力値で称号
		function pv($t){
			//外側の変数を関数内で使うための宣言
			global $password; global $row;
			global $dbh; global $email;
			global $zerofrag; 
			if(password_verify($password,$row['password'])){
				$sql="UPDATE users SET counter=0 WHERE email = ?";
				$stmt = $dbh->prepare($sql);
				$stmt->bindValue(1, $email , PDO::PARAM_STR);;
				$stmt->execute();
				//認証成功
				header('Location: ./dashboard.php');
				return true;

			}else{
			$addcount = $zerofrag ? 1 : ++$row['counter'];
			$sql="UPDATE users SET counter=". $addcount . " WHERE email = ?";
				$stmt = $dbh->prepare($sql);
				$stmt->bindValue(1, $email , PDO::PARAM_STR);
				$stmt->execute();
				echo "認証失敗!!".$t ;	
			var_dump($addcount,$zerofrag);		
				return false;
			}
		}
	function updateTime(){	//タイムスタンプを刻む関数
		global $dbh; global $email;
		$sql="UPDATE users SET timestump = ". time() . " WHERE email = ?";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(1, $email , PDO::PARAM_STR);
		$stmt->execute();
}//繰り返し行うのでできるだけ関数にしよう 変数はグローバル宣言するか引数にして渡す
//SQL文は "WHERE "ではなく " WHERE "スペースを忘れないように

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログイン確認</title>
</head>
<body>
	<h2>GOGGLE JAPONにログイン</h2>
	<form  method="post">
		<input type="hidden" name="hiddenmachine" value="<?=$sid?>">

		<p><label>メールアドレス</label></p>
			<input type="email" name="email" required>
	
		<p><label>パスワード</label></p>
			<input type="password" name="password" required>
	
		<p><input type="submit" value="ログイン"></p>
	</form>
	<p>アカウントを作っていない?<a href="create_acount.php">Goggle.com</a></p>
</body>
</html>