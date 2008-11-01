<?php
        if (Flash::get('tinymcedbchecked') != 'true' && !checkInstallForDB()) {
            if (installDB()) {
                Flash::set('success', __('TinyMCE - This plugin\'s config database was created because it didn\'t exist yet.'));
            }
            else {
               Flash::set('error', __('TinyMCE - This plugin\'s config database does not exist and couldn\'t be created! The plugin  should not be used!'));
            }
            Flash::set('tinymcedbchecked', 'true');
            redirect(get_url('plugin/tinymce'));
        }
        else {
            $sql = "SELECT * FROM `".TABLE_PREFIX."tinymce` WHERE `id`=1";
		    
		    global $__FROG_CONN__;
            $stmt = $__FROG_CONN__->prepare($sql);
		    $stmt->execute($sql);
        
            $result = $stmt->fetchObject();
		    
		    // if ($stmt && $result != null) {      
                $this->display('tinymce/views/index', array(
                    'listpublished' => $result->listpublished,
                    'listhidden' => $result->listhidden,
                    'imagesdir' => $result->imagesdir,
                    'imagesuri' => $result->imagesuri,
                    'cssuri' => $result->cssuri
                ));
		    /* }   // Check removed due to possible conflict it generated on David's installation
		    else {
		        Flash::set('error', __('TinyMCE - Unable to retrieve configuration settings but database should be oke. Something is terribly wrong!'));
		        redirect(get_url('setting'));
		    }*/

        }
        
function checkInstallForDB() {
    global $__FROG_CONN__;
    $PDO = Record::getConnection();

    return $PDO->exec("SELECT version FROM ".TABLE_PREFIX."tinymce") !== false;
}

function installDB() {
    $return = true;
    $sql_create = 'CREATE TABLE `'.TABLE_PREFIX.'tinymce` (`version` VARCHAR( 10 ) NOT NULL , `listpublished` BOOL NOT NULL , `listhidden` BOOL NOT NULL , `imagesdir` VARCHAR( 255 ) NOT NULL , `imagesuri` VARCHAR( 255 ) NOT NULL , `cssuri` VARCHAR( 255 ) NOT NULL , `id` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY)';
    $sql_insert = "INSERT INTO `".TABLE_PREFIX."tinymce` (`version`,`listpublished`,`listhidden`,`imagesdir`,`imagesuri`,`cssuri`,`id`) VALUES ('1.2.0',1,0,'/home/user/www/public/images','/public/images','/public/layouts/mylayout/mystylesheet.css',NULL)";

    global $__FROG_CONN__;
    $PDO = Record::getConnection();

    $return = $PDO->exec($sql_create) !== false;
    $return = $PDO->exec($sql_insert) !== false;

    return $return;
}
?>
