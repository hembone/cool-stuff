<!doctype html>
<head>
    <meta charset="utf-8">
    <title><?php echo (isset($this->title)?'New Website | '.$this->title:'New Website'); ?></title>

    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <base href="/">

    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php $this->printStyles(true); ?>
    <link rel="stylesheet" href="/css/main.css" />
    <?php $this->printStyles(); ?>

</head>

<?php require('templates/modules/header.php'); ?>
<?php require('templates/modules/navigation.php'); ?>

<body lang="en" class="<?php $this->printBodyClasses(); ?>">

<?php //echo'<pre>GET: '.print_r($_GET,true).'</pre>'; ?>
<?php //echo'<pre>POST: '.print_r($_POST,true).'</pre>'; ?>
<?php //echo'<pre>SERVER: '.print_r($_SERVER,true).'</pre>'; ?>
<?php //echo'<pre>COOKIE: '.print_r($_COOKIE,true).'</pre>'; ?>
<?php //echo'<pre>SESSION: '.print_r($_SESSION,true).'</pre>'; ?>

<?php $this->printContent(); ?>

<?php require('templates/modules/footer.php'); ?>

<script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php $this->printScripts(true); ?>
<script>
    var API_KEY = "<?php echo API_KEY; ?>";
</script>
<script src="/js/main.js"></script>
<?php $this->printScripts(); ?>

</body>
</html>
