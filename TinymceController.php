<?php
/*
 * TinyMCE plugin for Wolf CMS. <http://www.wolfcms.org>
 * Copyright (C) 2008,2009 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of the TinyMCE plugin for Wolf CMS.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * The TinyMCE plugin provides the TinyMCE editor to Wolf CMS users.
 *
 * @package wolf
 * @subpackage plugin.tinymce
 *
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @version 3.0.0
 * @since Wolf version 0.5.5
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Martijn van der Kleijn, 2008,2009
 */

/**
 * The TinyMCEController class is the heart of the plugin.
 */
class TinyMCEController extends PluginController {

    public function __construct() {
        // Check to make sure user is logged in.
        AuthUser::load();
        if ( ! AuthUser::isLoggedIn()) {
            redirect(get_url('login'));
        }
        
        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../plugins/tinymce/views/sidebar'));
    }

    public function index() {
        $this->documentation();
    }    
    
    public function documentation() {
        $this->display('tinymce/views/documentation');
    }

    function settings() {
        $settings = Plugin::getAllSettings('tinymce');

        if (!$settings) {
            Flash::set('error', 'TinyMCE - '.__('unable to retrieve plugin settings.'));
            return;
        }

        $this->display('tinymce/views/settings', $settings);
    }
    
    public function save() {
        $tablename = TABLE_PREFIX.'tinymce';
        
        if (!array_key_exists('listhidden', $_POST))
            $listhidden = '0';
        else
            $listhidden = '1';

        if (!array_key_exists('imagesdir', $_POST) || !array_key_exists('imagesuri', $_POST) || !array_key_exists('cssuri', $_POST)) {
		    Flash::set('error', 'TinyMCE - '.__('form was not posted.'));
		    redirect(get_url('plugin/tinymce'));
        }
        else {
            $imagesdir = $_POST['imagesdir'];
            $imagesuri = $_POST['imagesuri'];
            $cssuri = $_POST['cssuri'];

            if ($imagesdir[strlen($imagesdir)-1] == '/' || $imagesdir[strlen($imagesdir)-1] == '\\')
                $imagesdir = substr($imagesdir, 0, strlen($imagesdir)-1);
            if ($imagesuri[strlen($imagesuri)-1] == '/' || $imagesuri[strlen($imagesuri)-1] == '\\')
                $imagesuri = substr($imagesuri, 0, strlen($imagesuri)-1);
        }

		if(empty($imagesdir) || empty($imagesuri) || empty($cssuri)) {
		    Flash::set('error', 'TinyMCE - '.__('one of the fields was empty, please try again!'));
		    redirect(get_url('plugin/tinymce'));
		}
		else {
            $settings = array('listhidden' => $listhidden,
                              'imagesdir' => $imagesdir,
                              'imagesuri' => $imagesuri,
                              'cssuri'=> $cssuri
                             );
		    
		    if (Plugin::setAllSettings($settings, 'tinymce'))
		        Flash::set('success', 'TinyMCE - '.__('plugin settings saved.'));
		    else
		        Flash::set('error', 'TinyMCE - '.__('plugin settings not saved!'));
                
		    redirect(get_url('plugin/tinymce/settings'));
		}	    	
    }
}