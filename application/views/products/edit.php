<!DOCTYPE html>
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Adequately
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130910

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <title>Luso Leaves - Edit</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link type="text/css" rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.3.4/css/semantic.min.css">
    <link href="<?php echo asset_url() ?>css/default.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset_url() ?>css/main.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div class="icons">
    <a href="<?= base_url() . $this->lang->switch_uri('pt'); ?>">
        <img src="https://cdn1.iconfinder.com/data/icons/flags_gosquared/48/Portugal_flat.png" alt="Portuguese"/>
    </a>

    <a href="<?= base_url() . $this->lang->switch_uri('en'); ?>">
        <img src="https://cdn1.iconfinder.com/data/icons/flags/flags/48/United%20Kingdom%28Great%20Britain%29.png"
             alt="English"/>
    </a>
</div>
<div id="menu">
    <ul>
        <li>
            <a href="<?= site_url('main') ?>" accesskey="1" title="">
                <?php echo $this->lang->line("homepage"); ?>
            </a>
        </li>
        <li>
            <a href="<?= site_url('products') ?>" accesskey="2" title="">
                <?php echo $this->lang->line("products"); ?>
            </a>
        </li>

        <li>
            <a href="<?= site_url('users') ?>" accesskey="2" title="">
                Users
            </a>
        </li>

        <li>
            <a href="<?= site_url('users/logout') ?>" accesskey="3" title="">
                <?php echo $this->lang->line("logout"); ?>
            </a>
        </li>

        <li>
            <a href="<?= site_url('users/register') ?>" accesskey="4" title="">
                <?php echo $this->lang->line("register"); ?>
            </a>
        </li>
    </ul>
</div>
<div id="header-wrapper">
    <div id="header" class="container">
        <img src="<?php echo base_url() ?>/assets/images/logo.png" class="image-centered headerImg">
    </div>
</div>
<div id="wrapper1">
    <div id="welcome" class="container">

    </div>
</div>
<div id="wrapper3">
    <div id="description" class="container">


        <div class="title">
            <h2>Edit Product</h2>
        </div>

        <form class="ui tertiary form segment" method="POST" enctype="multipart/form-data">
            <div style="color:red;">
                <?php echo validation_errors(); ?>
                <br>
            </div>

            <?php echo form_open('products/edit'); ?>


            <div class="field">
                <label>Name</label>
                <input type="text" value="<?php echo $product['name']; ?>" name="name">
            </div>

            <div class="field">
                <label>Image</label>
                <input type="file" name="image"/>
            </div>

            <div class="field">
                <label>Tiges par Bouquet</label>
                <input type="text" value="<?php echo $product['tpb']; ?>" name="tpb">
            </div>

            <div class="field">
                <label>Bouquets par caisse</label>
                <input type="text" value="<?php echo $product['bpc']; ?>" name="bpc">
            </div>

            <div class="field">
                <label>Prix Floriste</label>
                <input type="text" value="<?php echo $product['prixFloriste'] ?>" name="prixFloriste">
            </div>

            <div class="field">
                <label>Prix Grossiste</label>
                <input type="text" value="<?php echo $product['prixGrossiste'] ?>" name="prixGrossiste">
            </div>

            <div class="field">
                <label>Is Available (1: true, 0:false)</label>
                <input type="text" value="<?php echo $product['isAvailable'] ?>" name="isAvailable">
            </div>

            <div class="field">
                <label>Availability date</label>
                <input type="text" value="<?php echo $product['availabilityDate'] ?>" name="availabilityDate">
            </div>

            <input class="ui green submit button" type="submit" name="submit" value="Save"/>
        </form>

        <div class="ui horizontal divider">
            Or
        </div>

        <a href="<?= site_url('products/delete/') . '/' . $product['id'] ?>" class="ui red submit button">
            Delete
        </a>

    </div>
</div>
<div id="copyright">
    <p>Copyright (c) 2013 LusoLeaves.com. All rights reserved.</p>
</div>
</body>
</html>


