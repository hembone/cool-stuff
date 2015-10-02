<!doctype html>
<!--[if lt IE 9]><html class="ie"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo (isset($this->title)?'Horizon | '.$this->title:'Horizon'); ?></title>

<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="">
<meta name="keywords" content="">

<base href="/">

<link rel="stylesheet" href="/css/normalize.css" />
<link rel="stylesheet" href="/css/main.css" />

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script>
// (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
// (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
// m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
// })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
// ga('create', 'UA_code_here', 'auto');
// ga('send', 'pageview');
</script>

</head>

<?php
require('templates/modules/header.php');
require('templates/modules/navigation.php');
?>
<body lang="en" class="<?php $this->printBodyClasses(); ?>">

<?php //echo'<pre>GET: '.print_r($_GET,true).'</pre>'; ?>
<?php //echo'<pre>POST: '.print_r($_POST,true).'</pre>'; ?>
<?php //echo'<pre>SERVER: '.print_r($_SERVER,true).'</pre>'; ?>
<?php //echo'<pre>COOKIE: '.print_r($_COOKIE,true).'</pre>'; ?>
<?php //echo'<pre>SESSION: '.print_r($_SESSION,true).'</pre>'; ?>

<?php $this->printContent(); ?>

<?php
require('templates/modules/footer.php');
require('includes/scripts.php');
?>
</body>
</html>
