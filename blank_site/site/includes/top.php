<!doctype html>
<!--[if lt IE 9]><html class="ie"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>

<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="">
<meta name="keywords" content="">

<meta property="og:site_name" content="" />
<meta property="og:url" content="<?php echo (isset($og_url)?$og_url:'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>" />
<meta property="og:title" content="<?php echo (isset($og_title)?$og_title:''); ?>" />
<meta property="og:description" content="<?php echo (isset($og_description)?$og_description:''); ?>" />
<meta property="og:image" content="<?php echo (isset($og_image)?'http://'.$_SERVER['HTTP_HOST'].$og_image:'http://'.$_SERVER['HTTP_HOST'].'/img/share.jpg'); ?>" />
<meta property="og:type" content="website" />

<meta name="twitter:card" content="summary">
<meta name="twitter:creator" content="">
<meta name="twitter:title" content="<?php echo (isset($og_title)?$og_title:''); ?>">
<meta name="twitter:description" content="<?php echo (isset($og_description)?$og_description:''); ?>">
<meta name="twitter:image" content="<?php echo (isset($og_image)?'http://'.$_SERVER['HTTP_HOST'].$og_image:'http://'.$_SERVER['HTTP_HOST'].'/img/share.jpg'); ?>">

<base href="/">

<link rel="stylesheet" href="/css/fonts.css" />
<link rel="stylesheet" href="/css/normalize.css" />
<link rel="stylesheet" href="/css/main.css" />

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', '', 'auto');
ga('send', 'pageview');
</script>

</head>
<body lang="en" class="<?php $TFW->printBodyClasses(); ?>">

<?php //echo'<pre>GET: '.print_r($_GET,true).'</pre>'; ?>
<?php //echo'<pre>POST: '.print_r($_POST,true).'</pre>'; ?>
<?php //echo'<pre>SERVER: '.print_r($_SERVER,true).'</pre>'; ?>
<?php //echo'<pre>COOKIE: '.print_r($_COOKIE,true).'</pre>'; ?>
<?php //echo'<pre>SESSION: '.print_r($_SESSION,true).'</pre>'; ?>
