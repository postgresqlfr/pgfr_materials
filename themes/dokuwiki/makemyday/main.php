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
</head>

<body>
<?php /*old includehook*/ @include(dirname(__FILE__).'/topheader.html')?>
<div align="center">

<div class="dokuwiki">
  <?php html_msgarea()?>

  <div class="stylehead">

    <div class="header">
	<div class="fl">
	<a href="http://www.postgresql.fr/"><img src="<?php echo DOKU_TPL?>/images/hdr_left.png" alt="PostgreSQL"></a>
	</div>
    	<div class="fr">
    	<img src="<?php echo DOKU_TPL?>/images/hdr_right.png" alt="The world's most advanced open source database" height="80" width="210">
	</div>
	<div class="cb"></div>
    </div>

<div id="nav">
	<div class="fl">
	<img src="<?php echo DOKU_TPL?>/images/nav_lft.png" alt="">
	</div>
	<div class="flp">
<?php tpl_sidebar('nav') ?>
	</div>
	<div class="fr">
	<img src="<?php echo DOKU_TPL?>/images/nav_rgt.png" alt="">
	</div>
	<div class="cb"></div>
</div>

  </div>
  <?php flush()?>

  <?php /*old includehook*/ @include(dirname(__FILE__).'/pageheader.html')?>

  <div class="page content">
  <div class="sponsors" >
<?php tpl_sidebar('sponsors') ?>
  </div>

    <!-- wikipage start -->
    <div class="wikipage">
    <?php tpl_content()?>
    </div>
    <!-- wikipage stop -->
  </div>

  <div class="clearer">&nbsp;</div>

  <?php flush()?>

  <div class="foot">

    <div  id="bar__bottom">
      <div class="bar-left" id="bar__bottomleft">
        &copy; Copyright 2008 <a href="http://www.postgresql.fr" alt="PostgreSQLfr">PostgreSQLFr</a>
      </div>
      <div  id="bar__bottomright">
        <?php tpl_actionlink('edit')?>
        <?php tpl_actionlink('admin')?>
        <?php tpl_actionlink('login')?>
      </div>
      <div class="clearer"></div>
    </div>
   
  </div>

</div>
</div>
<div class="no"><?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug()?></div>
</body>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3921927-6");
pageTracker._initData();
pageTracker._trackPageview();
</script>
</html>
