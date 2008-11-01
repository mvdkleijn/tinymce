<?php

class TinyMCEController extends PluginController {

    public function __construct() {

        // Check to make sure user is logged in.
        AuthUser::load();
        if ( ! AuthUser::isLoggedIn())
        {
            redirect(get_url('login'));
        }
        
        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../../plugins/tinymce/views/sidebar'));
    }

    public function index() {
        $this->documentation();
    }    
    
    public function documentation() {
        $this->display('tinymce/views/documentation');
    }

    function settings() {
        $this->display('tinymce/views/settings');
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