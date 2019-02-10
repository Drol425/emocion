<?php

include ('dbcron.php');

$set = $DB->query("SELECT id,url_img FROM `images`");
echo '<pre>';

	foreach ($set as &$value) {
		$cou_set = $DB->query("SELECT COUNT(*) FROM `emo` WHERE id_img=?", array($value['id']));
			//print_r($cou_set[0]['COUNT(*)']);
			if($cou_set[0]['COUNT(*)'] != 0){
					echo '<img src="'.$value['url_img'].'"><br />';
					$set_emo = $DB->query("SELECT emocion FROM `emo` WHERE id_img=?", array($value['id']));
						foreach ($set_emo as &$value_emo) {
							echo $value_emo['emocion'].'<br />';
						}
			}
	}