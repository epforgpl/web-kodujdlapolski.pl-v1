<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1">

	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

	<script src="<?php bloginfo('template_url'); ?>/js/lib/head.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" media="screen">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/lib/jquery.fancybox/jquery.fancybox.css" media="screen">

	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css">
	<script src="js/ie/html5shiv.js"></script>
	<script src="js/ie/respond.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body>
<div class="upperNav">
  <div class="container">
    <div class="row">
    <div class="eLogo">
      <a target="_blank" href="http://epf.org.pl/">Projekt Fundacji ePaństwo</a>
    </div>
    </div>
  </div>
</div>	<!-- / .upperNav -->

<div class="container container--main">
  <nav class="navbar">
    <div class="navbar-header">
      <a href="/" class="navbar-brand"><img src="<?php bloginfo('template_url'); ?>/images/logo-kodujdlapolski.png" width="167" height="77" alt=""></a>
    </div>
    <div class="navbar-collapse">
    	<?php primary_menu(); ?>
    </div>
  </nav><!-- / .navbar -->