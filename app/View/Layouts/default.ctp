<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        <?php echo __('R2R:'); ?>
        <?php echo $title_for_layout; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <?php echo $this->Html->css('bootstrap.min'); ?>
    <style>
    body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
    }
    </style>
    <?php echo $this->Html->css('bootstrap-responsive.min'); ?>
    <?php echo $this->Html->css('datepicker'); ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <!--
    <link rel="shortcut icon" href="/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
    -->
    <?php
    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>
    <?php echo $this->Html->css('style'); ?>
</head>

<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="<?php echo $baseUrl; ?>"><?php echo __('R2R'); ?></a>
                <?php echo $this->element('nav'); ?>
            </div>
        </div>
    </div>

    <div class="container">

        <?php echo $this->Session->flash(); ?>

        <?php echo $this->fetch('content'); ?>

    </div> <!-- /container -->

    <?php echo $this->element('modal'); ?>

    <div id="footer">
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $this->Html->url('/'); ?>ckeditor/ckeditor.js"></script>
    <?php echo $this->Html->script('jquery.min'); ?>
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->Html->script('bootstrap-datepicker'); ?>
    <?php echo $this->Html->script('bootstrap-datepicker.ja'); ?>
    <?php echo $this->Html->script('script'); ?>
    <?php echo $this->fetch('script'); ?>

</body>
</html>
