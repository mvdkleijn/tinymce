<h1><?php echo __('TinyMCE settings');?></h1>
<form action="<?php echo get_url('plugin/tinymce/save'); ?>" method="post">
    <fieldset style="padding: 0.5em;">
        <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Internal pages dropdown function'); ?></legend>
        <table class="fieldset" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="label"><label for="listpublished"><?php echo __('List <strong>published</strong> pages:'); ?> </label></td>
                <td class="field"><input name="listpublished" id="listpublished" type="checkbox" disabled="disabled" <?php echo ($listpublished ? 'checked="true"' : ''); ?>/></td>
                <td class="help"><?php echo __('Always true.'); ?></td>
            </tr>
            <tr>
                <td class="label"><label for="listhidden"><?php echo __('List <strong>hidden</strong> pages:'); ?> </label></td>
                <td class="field"><input name="listhidden" id="listhidden" type="checkbox" <?php echo ($listhidden ? 'checked="true"' : ''); ?>/></td>
                <td class="help"><?php echo __('Only lists <strong>hidden</strong> pages that are <strong>UN</strong>protected.'); ?></td>
            </tr>
        </table>
    </fieldset>
    <br/>
    <fieldset style="padding: 0.5em;">
        <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Images dropdown function'); ?></legend>
        <table class="fieldset" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="label"><label for="imagesdir"><?php echo __('Images directory:');?> </label></td>
                <td class="field"><input name="imagesdir" id="imagesdir" type="text" size="35" maxsize="255" value="<?php echo $imagesdir;?>"/></td>
                <td class="help"><?php echo __('Absolute path to images on disk.<br/>For example: <code>/home/user/www/public/images</code>');?></td>
            </tr>
            <tr>
                <td class="label"><label for="imagesuri"><?php echo __('URI to images:');?> </label></td>
                <td class="field"><input name="imagesuri" id="imagesuri" type="text" size="35" maxsize="255" value="<?php echo $imagesuri;?>"/></td>
                <td class="help"><?php echo __('Relative URI to images depending on where Wolf CMS was installed.<br/>For example: <code>/public/images</code>');?></td>
            </tr>
        </table>
    </fieldset>
    <br/>
    <fieldset style="padding: 0.5em;">
        <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Preview function');?></legend>
        <table class="fieldset" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="label"><label for="cssuri"><?php echo __('URI to CSS file:');?> </label></td>
                <td class="field"><input name="cssuri" id="cssuri" type="text" size="35" maxsize="255" value="<?php echo $cssuri;?>"/></td>
                <td class="help"><?php echo __('Relative URI to a CSS file.<br/>For example: <code>/public/layouts/mylayout/mystylesheet.css</code>');?></td>
            </tr>
        </table>
    </fieldset>
    <p class="buttons">
        <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save');?>" />
    </p>
</form>
