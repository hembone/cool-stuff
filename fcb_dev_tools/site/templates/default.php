<!doctype html>
<!--[if lt IE 9]><html class="ie"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo (isset($this->title)?'FCB DEV TOOLS | '.$this->title:'FCB DEV TOOLS'); ?></title>

<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="">
<meta name="keywords" content="">

<base href="/">

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/main.css" />

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

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
