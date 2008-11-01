<?php

function substrtruncate($string, $needle) {
    return substr($string, 0, strrpos($string, $needle)+1);
}

require_once(substrtruncate($_SERVER['SCRIPT_FILENAME'], '/plugins').'../config.php');

$image_list_dir = null;
$image_public_path = null;
$preview_css = null;
$listhidden = null;

$sql = "SELECT * FROM `".TABLE_PREFIX."tinymce` WHERE `id`=1";
		    
function connect() {
    $db_settings = explode('=',DB_DSN);
    $db_name = explode(';' , $db_settings[1]);
    $db_name = $db_name[0];
    $db_host = $db_settings[2];
    $db_user = DB_USER;
    $db_pass = DB_PASS;

    $con = mysql_connect($db_host, $db_user, $db_pass);
    $selectdb = mysql_select_db($db_name, $con);
    if(!$selectdb){
        die('Incorect');
    }
}
connect();
$results = mysql_query($sql) or die ("Error in query: $sql. " . mysql_error()); 
		    
if ($results && $result = mysql_fetch_array($results)) {      
    $image_list_dir = $result['imagesdir'];
    $image_public_path = $result['imagesuri'];
    $preview_css = $result['cssuri'];
    $listhidden = $result['listhidden'];
}
else {
    $image_list_dir = '';
    $image_public_path = '';
    $preview_css = '';
    $listhidden = 0;
}

if (isset($_GET['g'])) {
    $get = $_GET['g'];

    if ($get == 'css') {
        header("Location: $preview_css");
        exit;
    }
}

?>
