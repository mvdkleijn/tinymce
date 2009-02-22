<?php

function substrtruncate($string, $needle) {
    return substr($string, 0, strrpos($string, $needle)+1);
}

require_once(substrtruncate($_SERVER['SCRIPT_FILENAME'], '/plugins').'../config.php');
require_once(substrtruncate($_SERVER['SCRIPT_FILENAME'], '/plugins').'/Framework.php');

$image_list_dir = null;
$image_public_path = null;
$preview_css = null;
$listhidden = null;

$tablename = TABLE_PREFIX.'plugin_settings';

if (USE_PDO) {
    try {
        $PDO = new PDO(DB_DSN, DB_USER, DB_PASS);
    }
    catch (PDOException $error) {
        die('DB Connection failed: '.$error->getMessage());
    }

    if ($PDO->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql')
        $PDO->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
}
else {
    require_once(substrtruncate($_SERVER['SCRIPT_FILENAME'], '/plugins').'/libraries/DoLite.php');
    $PDO = new DoLite(DB_DSN, DB_USER, DB_PASS);
}

Record::connection($PDO);
$PDO = Record::getConnection();
$PDO->exec("set names 'utf8'");

$sql = "SELECT name,value FROM $tablename WHERE plugin_id='tinymce'";

$settings = array();

$stmt = $PDO->prepare($sql);
$stmt->execute();

while ($obj = $stmt->fetchObject()) {
    $settings[$obj->name] = $obj->value;
}

if ($settings) {
    $image_list_dir = $settings['imagesdir'];
    $image_public_path = $settings['imagesuri'];
    $preview_css = $settings['cssuri'];
    $listhidden = $settings['listhidden'];
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
