<?php 

	require_once("connect.php");
	$dbh = dbconnect();
	//このファイルのパス
	$dir = $_SERVER['REQUEST_URI'];
		$path = pathinfo($dir)['dirname'];
			var_dump($path);
	
	$sql = "SELECT post_id, post, post_date, Author, gazo 
			FROM posts 
			LEFT JOIN users 
			ON Author = code ";	 //テーブル結合
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		if(isset($stmt))
		foreach ($stmt as $row) {
	//タグを多く書くのでphpをここで切る
?>
<article>
	<div class="Author">
		<img src="<?=$path."/".$row['gazo']?>" alt="投稿者">
	</div>
	<p><?=$row['post']?></p>
	<div class="">
		<time>投稿日:<?=$row['post_date']?></time>
	</div>
</article>
<?php } ?>