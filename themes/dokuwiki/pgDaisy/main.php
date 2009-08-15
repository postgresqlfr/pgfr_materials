<?php

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
require_once(dirname(__FILE__).'/tplfn_sidebar.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>
    <?php tpl_pagetitle()?>
    [<?php echo strip_tags($conf['title'])?>]
  </title>

  <?php tpl_metaheaders()?>

  <link rel="shortcut icon" href="<?php echo DOKU_TPL?>images/favicon.ico" />

  <?php /*old includehook*/ @include(dirname(__FILE__).'/meta.html')?>

<?php
if (file_exists(DOKU_PLUGIN.'googleanalytics/code.php')) include_once(DOKU_PLUGIN.'googleanalytics/code.php');
if (function_exists('ga_google_analytics_code')) ga_google_analytics_code();
?>
</head>

<body>
<?php /*old includehook*/ @include(dirname(__FILE__).'/topheader.html')?>
<div class="dokuwiki">
  <?php html_msgarea()?>


<div class="header">

  <div id="top"><div id="pgHeader">
    <span id="pgHeaderLogoLeft">
      <a href="/" title="European PGDay"><img src="<?php echo DOKU_TPL?>images/hdr_left.png" width="230" height="80" alt="PostgreSQL" /></a>
    </span>
    <span id="pgHeaderLogoRight">
      <a href="/" title="European PGDay, 6-7 nov 2009"><img src="<?php echo DOKU_TPL?>images/hdr_right.png" width="210" height="80"  /></a>
    </span>
  </div></div>
</div><!-- end of header -->

  <div id="nav">
        <div class="flp">
<?php tpl_sidebar('nav') ?>
        </div>
	<div class="lang">
<?php
$translation = &plugin_load('syntax','translation');
echo $translation->_showTranslations();
?>
	</div>
        <div class="cb"></div>
  </div>

<!-- end of nav -->

 <?php flush()?>

<div class="colmask threecol">
	<div class="colmid">
	<div class="colleft">
	<div class="col1">
	<!-- Column 1 start -->
	  <div class="page">
    		<!-- wikipage start -->
    		<?php tpl_content()?>
    		<!-- wikipage stop -->
  	  </div>			
        <!-- Column 1 end -->
	</div>
	<div class="col2">
	<!-- Column 2 start -->
	<?php tpl_sidebar('boxes') ?>
	<!-- Column 2 end -->
	</div>
	<div class="col3">
	<!-- Column 3 start -->
	<?php tpl_sidebar('partners') ?>
	<!-- Column 3 end -->
	</div>
	</div>
	</div>
</div>

 <div class="clearer">&nbsp;</div>

 <?php flush()?>

<div class="footer">

    <div  id="bar__bottom">
      <div class="bar-left" id="bar__bottomleft">
        &copy; Copyright 2009 <a href="http://www.postgresql.eu" alt="PostgreSQL Europe">PostgreSQL Europe</a>
      </div>
      <div  id="bar__bottomright">
        <?php tpl_actionlink('edit')?>
        <?php tpl_actionlink('admin')?>
        <?php tpl_actionlink('login')?>
      </div>
      <div class="clearer"></div>
    </div>

</div>
<!-- footer -->

</div>

<div class="no"><?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug()?></div>
</body>
</html>
