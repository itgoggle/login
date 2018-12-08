<?php
	//タグや記号を無力化しなす ',(カンマ)',' (スペース)','-(ハイフン)'
	function h($p){
		$p = htmlspecialchars($p,ENT_QUOTES);
		$p = str_replace( "," , "，", $p );
		$p = str_replace( "-" , "ー", $p );
		$p = str_replace( "/" , "\/", $p );
		$p = nl2br($p);
			return $p;
	}
?>