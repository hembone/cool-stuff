<div class="container-fluid">
<ul class="nav nav-pills main-nav">
    <li class="<?php echo (empty($_GET['page'])?'active':''); ?>"><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li class="dropdown <?php echo ((isset($_GET['page'])&&$_GET['page']=='email-builder')||(isset($_GET['page'])&&$_GET['page']=='email-manage')?'active':''); ?>">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-puzzle-piece"></i> Email Builder <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="<?php echo (isset($_GET['page'])&&$_GET['page']=='email-builder'?'active':''); ?>"><a href="/email-builder"><i class="fa fa-puzzle-piece"></i> Build</a></li>
            <li class="<?php echo (isset($_GET['page'])&&$_GET['page']=='email-manage'?'active':''); ?>"><a href="/email-manage"><i class="fa fa-cog"></i> Manage</a></li>
        </ul>
    </li>
    <li class="<?php echo (isset($_GET['page'])&&$_GET['page']=='banner-tester'?'active':''); ?>"><a href="/banner-tester"><i class="fa fa-bug"></i> Banner Tester</a></li>
    <!-- <li class="<?php //echo (isset($_GET['page'])&&$_GET['page']=='social-ranking'?'active':''); ?>"><a href="/social-ranking"><i class="fa fa-line-chart"></i> Social Ranking</a></li> -->
</ul>
</div>
