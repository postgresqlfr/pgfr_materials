<?php 
/*
 * Provide navigation sidebar functionality to Dokuwiki Templates
 *
 * This is not currently part of the official Dokuwiki release
 *
 * @link   http://wiki.jalakai.co.uk/dokuwiki/doku.php?id=tutorials:dev:navigation_sidebar
 * @author Christopher Smith <chris@jalakai.co.uk>
 */

// sidebar configuration settings
$conf['sidebar']['enable'] = 1;               // 1 or true to enable sidebar functionality, 0 or false to disable it
$conf['sidebar']['page'] = tpl_getConf('btl_sidebar_name');         // name of sidebar page
$conf['sidebar']['layout'] = 'inside';        // inside (between button bars) or outside (full height of dokuwiki)
$conf['sidebar']['orientation'] = 'right';     // left or right

// determine the sidebar class
$sidebar_class = "sidebar_{$conf['sidebar']['layout']}_{$conf['sidebar']['orientation']}";

// recursive function to establish best sidebar file to be used
function getSidebarFN($ns, $file) {

	// check for wiki page = $ns:$file (or $file where no namespace)
	$nsFile = ($ns) ? "$ns:$file" : $file;
	if (file_exists(wikiFN($nsFile)) && auth_quickaclcheck($nsFile)) return $nsFile;
	
// remove deepest namespace level and call function recursively
	
	// no namespace left, exit with no file found	
	if (!$ns) return '';
	
	$i = strrpos($ns, ":");
	$ns = ($i) ? substr($ns, 0, $i) : false;	
	return getSidebarFN($ns, $file);
}

// display the sidebar
function tpl_sidebar($user_defined_page_name="") {
	global $ID, $REV, $conf;
	
	// save globals
	$saveID = $ID;
	$saveREV = $REV;

	// discover file to be displayed in navigation sidebar	
	$fileSidebar = '';
	
	// damien
	$pagename="";
	if ($user_defined_page_name!="") {
		$pagename = $user_defined_page_name;
	}else if (isset($conf['sidebar']['page'])) {
		$pagename = $conf['sidebar']['page'];
	}
	if ($pagename != "") {
		$fileSidebar = getSidebarFN(getNS($ID), $pagename);
	}

	// determine what to display
	if ($fileSidebar) {
		$ID = $fileSidebar;
		$REV = '';
		print p_wiki_xhtml($ID,$REV,false);
	}
	else {
        global $IDX;
        html_index($IDX);
	}
		
	// restore globals
	$ID = $saveID;
	$REV = $saveREV;
}

if (!function_exists('tpl_pagename')) {

	require_once(DOKU_INC.'inc/parserutils.php');

    /**
     * Returns the name of the given page (current one if none given).
     *
     * If useheading is enabled this will use the first headline else
     * the given ID is printed.
     *
     * based on tpl_pagetitle in inc/template.php
     */
    function tpl_pagename($id=null){
      global $conf;
      if(is_null($id)){
        global $ID;
        $id = $ID;
      }
    
      $name = $id;
      if ($conf['useheading']) {
        $title = p_get_first_heading($id);
        if ($title) $name = $title;
      }
      return hsc($name);
    }

}

?>
