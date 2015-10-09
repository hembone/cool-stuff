<?php include('utils.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>FCB Email Template Builder</title>
		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="css/bootstrap-theme.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script src="js/jquery-1.11.1.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
	    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	      <div class="container-fluid">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="#">FCB Email Template Builder</a>
	        </div>
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="#" class="preview-anchor"><input type="checkbox" id="preview-trigger"/> Module Previews</a></li>
	            <li class="dropdown">
	            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Template (<span class="template-text"></span>)<span class="caret"></a>
	            	<ul class="dropdown-menu" role="menu" id="template-dropdown">
					</ul>
	            </li>
	            <li class="dropdown">
	            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">View (<span class="view-text">Desktop</span>)<span class="caret"></a>
	            	<ul class="dropdown-menu" role="menu" id="view-dropdown">
	            		<li class="active"><a href="#" data-size="100%">Desktop</a></li>
	            		<li><a href="#" data-size="480">Tablet</a></li>
	            		<li><a href="#" data-size="320">Mobile</a></li>
					</ul>
	            </li>
	            <li><a href="#" class="template-reset">Reset</a></li>
	            <li><a href="#" class="template-export">Export</a></li>
	          </ul>
	        </div>
	      </div>
	    </div>

	    <div class="container-fluid">
	      <div class="row">
	        <div class="col-sm-3 col-md-2 sidebar right-border">
	          <ul class="nav nav-sidebar" id="group-list">
	          </ul>
	        </div>
	        <div class="col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2 main">
	        	<iframe id="template-preview" width="100%" height="100%" frameborder="0"></iframe>
				<div class="overlay"></div>
	        	<iframe id="module-preview" width="700" height="" frameborder="0"></iframe>
	        	<!-- settings pane -->
	        </div>
	        <div class="col-sm-3 col-sm-offset-9 col-md-2 col-md-offset-10 sidebar left-border">
	          <ul class="nav nav-sidebar" id="selected-modules">
	          </ul>
	        </div>
	      </div>
	    </div>
	</body>
</html>