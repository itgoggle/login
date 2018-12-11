<?php header('Content-type: text/html; vharset=UTF-8'); 
	//通信ヘッダは 文字を書き出す前に実行
	$prioDisp = 2;
	$slStr = array('','','');	//空文字が3つで初期化できます
	$prio = 0;
		if(isset($_POST['priority'])){
			//post値は文字列型であるので数値型に変換 空であれば0になります
			$prio = (int)$_POST['priority'];
		}

		require_once('connect.php');
	require_once('mojifilter.php');
	$dbh=dbconnect();

	if(!empty($_POST['insert']) && !empty($_POST['todocont']))
	{
	//追加buttonが押された
	if($prio == 2)$prio = 0;	//すべてを選んだら強制的に絶になる
	$sql = '
		INSERT INTO todolist (todo,prio,created)
		VALUES(?,?,CURDATE() )';
		$sth = $dbh->prepare($sql);
		$sth->bindValue(1 ,$_POST['todocont'],PDO::PARAM_STR);	
		$sth->bindValue(2 ,$prio,PDO::PARAM_INT);	
		$sth->execute();

	}else if(!empty($_POST['search'])){
			//検索ボタンが押された
		//$_POST['prio'] //は2なら"すべて"

	$sql = "SELECT * FROM todolist ";
		if($_POST['priority'] != 2 )
				$sql .= "WHERE prio = ?";

	$sth=$dbh->prepare($sql);
	if($_POST['priority'] != 2 )
		$sth->bindValue(1,$_POST['priority'] , PDO::PARAM_INT);
	$sth->execute();//mysqlからもってこいデータ

	$ichiran = "";
	foreach ($sth as $key => $row){
		$ichiran .= "
		<input type='checkbox' name='checktodo[]' value=' "
			.h($row["id"]) ."'> "
			.h($row['todo']) ;
		}
	}else if(!empty($_POST['delete']) 
		&& !empty($_POST['checktodo']) ){
		//削除ボタンが押されていた
		//空欄はよく埋めていってください
		$checkOn = $_POST['checktodo'];
		//一回のmDELETEで複数行の削除
		$ids = '';
			foreach($checkOn as $id){
				$ids .= $id . ",";
			}
			$ids = rtrim($ids , ","); //文字列の最後カンマ除去
				$sql="DELETE FROM todolist WHERE id IN($ids)";
				$sth=$dbh->prepare($sql);
				$sth->execute();
				}

?>
<form method="post">
	<p>やること
	<textarea name="todocont"></textarea>
	
	<select name="priority">
		<option value="2">すべて</option>
		<option value="1">高</option>
		<option value="0">低</option>
	</select>
</p>
	<input type="submit" name="insert" value="追加">
	<input type="submit" name="search" value="検索">
	<input type="submit" name="delete" value="削除">
<p>
<?php echo @$ichiran;	//警告を出さない,そのための「@」?>
</form>