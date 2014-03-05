<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Woqee<?php echo isset($title) ? ' - ' . $title : '' ; ?></title>

    <script type="text/javascript" src="/assets/js/jquery.js"></script>

    <script type="text/javascript" src="/assets/js/main.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/main.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

  </head>

  <body>

    <div id="header">
        <div class="header_cont">
            <?php echo form_open( '/search/', array('class' => 'form-signin') ) ; ?>
                <input name="search" type="text" class="quick_search" placeholder="Quick Search" required>
            <?php echo form_close() ; ?>


            <!-- <img src="/assets/images/logo_login.png" /> -->
            <img src="/assets/images/emblem.png" />

            <div id="nav-menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/account/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="content_cont">