== TinyMCE plugin for Wolf CMS ==

This plugin was created by Martijn van der Kleijn (www.vanderkleijn.net) for Wolf CMS (www.wolfcms.org).
The plugin uses an un-altered, stock TinyMCE download, apart from the addition of the codeprotect plugin,
which can be found in the tinymce subdirectory of the plugin.

For TinyMCE itself, see http://tinymce.moxiecode.com

== UPGRADING ==

When upgrading this plugin, here's some tips to help you out:
    1 - Temporarily disable the plugin in the Administration section
    2 - Install the plugin as you would normally
    3 - Empty your browser cache
    4 - Re-activate the plugin in the Administration section and check the settings on the TinyMCE plugin's setting page.

== INSTALLATION ==

You can install this plugin in 3 easy steps.

1 - Unzip and upload this plugin to the Wolf CMS plugins directory.

2 - Access the Wolf CMS Administration screen and activate the plugin.

3 - Refresh/reload the screen and click on the "settings" link behind the TinyMCE plugin's listing.
    Please check/fill in the various paths and click on the save button.

Your TinyMCE plugin should now be ready for use.

== PROBLEM SOLVING ==

1 - When using the image selection dropdown box and if images are showing up properly in the
    editor but their paths are wrong on the actual pages, you might need to add the following
    line to tiny_init.php:

        relative_urls : false,

    and possibly the following line aswell, but my installation works fine without it:

        document_base_url : "/public/images",

== OPTIONAL ==

1 - If you want to change any other TinyMCE settings, edit the tiny_init.php file.

2 - You can upgrade the TinyMCE version that this plugin uses at any time yourself by downloading
    the latest TinyMCE version and unpacking it to the tinymce subdirectory of this plugin.

    If you want to keep intact the protection of PHP code, you will need to backup the codeprotect TinyMCE
    plugin. You can find this in ..../tinymce/jscripts/tiny_mce/plugins
