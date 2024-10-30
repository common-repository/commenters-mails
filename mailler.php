<?php
/*
Plugin Name: Mailler
Plugin URI: http://hmert.com/mailler
Description: English: Gathers commenters mails that sapareted with commas.
		Turkish: Sitenize yorum yapan herkesin mail adresni aralarına virgül koyarak çıkartır.
Author: Hüseyin MERT
Version: 1.0
Author URI: http://hmert.com
*/

 
function mailler(){
	global $wpdb;
	$yorum_mailleri = $wpdb->get_results("SELECT DISTINCT comment_author_email FROM ".$wpdb->prefix."comments LIMIT 100000");
	$mail_adeti = $wpdb->get_var("SELECT DISTINCT COUNT(*) comment_author_email FROM ".$wpdb->prefix."comments");
	echo'<div id="message" class="updated fade">Mail Adedi: '.$mail_adeti.'<strong></div>
		<div class="wrap">
		<h2>Yorumlardaki mailler</h2>
		<textarea style="width: 98%;" rows="6" cols="50">';
		foreach ($yorum_mailleri as $yorum_mail) {
			echo $yorum_mail->comment_author_email.', ';
		}
		echo'</textarea></div>';
}
function mailler_actions(){
    add_options_page("Mailler", "Mailler", 1,"mailler", "mailler");
}

add_action('admin_menu', 'mailler_actions');
?>