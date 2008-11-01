== TinyMCE plugin for Frog ==

This plugin was created by Martijn van der Kleijn (www.vanderkleijn.net) for the Frog CMS (www.madebyfrog.com).
Development of the plugin is based on the latest stable Frog version, in this case v0.9.2.
The plugin uses an un-altered, stock TinyMCE download which can be found in the tinymce subdirectory of the plugin.

== CHANGES ==
         
v2.0.0 - Removed TinyMCE's tab in Frog backend
         Moved plugin's settings DB table stuff into enable.php
         Added a settings page

v1.2.0 - Added a configuration/preferences tab to Frog's admin section.
         Added an option to also list HIDDEN pages that are unprotected in TinyMCE's link dropdown box.

v1.1.0 - Added dropdown in-frog pages selector for easy linking
            The dropdown currently only shows PUBLISHED pages, when desired, I can add HIDDEN or even all aswell.
            You could also edit the SQL yourself, it's in lists/pages_list.php
         Added small performance tweak to tiny_init.js based on TinyMCE website (button_tile_map : true)
         Updated to the latest TinyMCE version (from 3.0.5 to 3.1.0.1)
         
v1.0.0 - Fixed a small problem with the default configuration not allowing alignment of images.
         Fixed the "use your own stylesheet" function so TinyMCE provides true WYSIWYG functionality.
         Updated the readme layout.

v0.0.6 - Minor fixes and one fix for TinyMCE itself.
         Possibility to use custom CSS for editing and preview.
         Your mileage with that might vary as it seems a not-so-stable function within TinyMCE.

v0.0.5 - Added dropdown image selector.
         Made it so tinymce only appears on textareas in the "Pages" section.
         Fixed some minor problems.

v0.0.1 - Initial release.

== UPGRADING ==

When upgrading this plugin, here's some tips to help you out:
    1 - Temporarily disable the plugin in the Administration section
    2 - Install the plugin as you would normally
    3 - Empty your browser cache
    4 - Re-activate the plugin in the Administration section and check the settings on the TinyMCE tab.

== INSTALLATION ==

You can install this plugin in 3 easy steps.

1 - Unzip and upload this plugin to the Frog plugins directory.

2 - IF NECESSARY, edit the tinymce.js file and change the "urlToFrog" variable.
    This variable should be set to the server relative url in which Frog was installed.
    For example:
        - if you access Frog's frontpage with http://www.example.com/frog
        - The value for urlToFrog should be "/frog"
        - When you frog lives on your site's root, leave this value empty.

3 - Access the Frog Administration screen and activate the plugin. Refresh/reload the screen and
    click on the Tinymce tab that appeared. The plugin will automatically add configuration information
    to the database.
    
    Please fill in the various paths and click on the save button. Your TinyMCE plugin should now be ready for use.

== PROBLEM SOLVING ==

   1) when using the image selection dropdown box and if images are showing up properly in the
      editor but their paths are wrong on the actual pages, you might need to add the following
      line to tiny_init.js:

          relative_urls : false,

      and possibly the following line aswell, but my installation works fine without it:

          document_base_url : "/public/images",


== OPTIONAL ==

    If you want to change any other TinyMCE settings, edit the tiny_init.js file.
