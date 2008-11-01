<?php

require_once('../config.php');
require_once('../../../../config.php');

function startsWith($Haystack, $Needle){
    return strpos($Haystack, $Needle) === 0;
}

function dumpChildren($root = 0, $slug = '') {

$listhidden = 1;
    if ($slug != '')
        $slug = $slug.'/';
    connect();
    $query = 'SELECT title,slug FROM '.TABLE_PREFIX.'page WHERE (status_id=\'100\''.($listhidden?' OR status_id=\'101\' AND is_protected=\'0\'':'').') AND id=\''.$root.'\'';
    $results = mysql_query($query) or die ("Error in query: $query. " . mysql_error());     
    while($result = mysql_fetch_array($results)) {
        if ($root > 1)
            echo ',';
        echo '["'.$result['title'].'", "'.URL_PUBLIC.($result['slug'] == '' ? '' : $slug.$result['slug'].URL_SUFFIX).'"]';
        $slug = $slug.$result['slug'];
    }
    
    $query = 'SELECT id FROM '.TABLE_PREFIX.'page WHERE (status_id=\'100\''.($listhidden?' OR status_id=\'101\' AND is_protected=\'0\'':'').') AND parent_id=\''.$root.'\'';
    $results = mysql_query($query) or die ("Error in query: $query. " . mysql_error());     
    while($result = mysql_fetch_array($results)) {
        dumpChildren($result['id'], $slug);
    }
}

print 'var tinyMCELinkList = new Array(';
dumpChildren();
print ');';

?>
