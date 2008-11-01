<?php

class TinyMCEController extends PluginController {

    public function __construct() {
    
        AuthUser::load();
        if ( ! AuthUser::isLoggedIn())
        {
            redirect(get_url('login'));
        }
        else if ( ! AuthUser::hasPermission('administrator') && ! AuthUser::hasPermission('developer'))
        {
            Flash::set('error', __('You do not have permission to access the requested page!'));
            redirect(get_url());
        }
        
        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../../plugins/tinymce/views/sidebar'));
    }
    
    public function documentation() {
        $this->display('tinymce/views/documentation');
    }
    
    public function index() {
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
    }
    
    public function save() {
        //$listpublished = mysql_escape_string($_POST['listpublished']);
		$listhidden = mysql_escape_string($_POST['listhidden']);
		$imagesdir = mysql_escape_string($_POST['imagesdir']);
		$imagesuri = mysql_escape_string($_POST['imagesuri']);
        $cssuri = mysql_escape_string($_POST['cssuri']);
        
		if(empty($imagesdir) || empty($imagesuri) || empty($cssuri)) {
		    Flash::set('error', __('You did not complete one of the fields, please try again!'));
		    redirect(get_url('plugin/tinymce'));
		}
		else {
		    $sql = "UPDATE `".TABLE_PREFIX."tinymce` SET `listhidden`=".($listhidden=='on'?'1':'0').",`imagesdir`='".$imagesdir."',`imagesuri`='".$imagesuri."',`cssuri`='".$cssuri."' WHERE `id`=1";
		    
		    global $__FROG_CONN__;
            $PDO = Record::getConnection();
		    $return = $PDO->exec($sql) !== false;
		    if ($return) {
		        Flash::set('success', __('TinyMCE - plugin settings saved.'));
		    }
		    else {
		        Flash::set('error', __('TinyMCE - plugin was unable to save its settings!'));
		    }
		    redirect(get_url('plugin/tinymce'));
		}	    	
    }
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
