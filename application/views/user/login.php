<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Luso Leaves - Login</title>
    <link type="text/css" rel="stylesheet" href="<?php echo asset_url() ?>/css/form.css">
    <link type="text/css" rel="stylesheet" href="<?php echo asset_url() ?>/css/default.css">

    <script src="<?php echo asset_url() ?>/js/sha512.js"></script>
    <script src="<?php echo asset_url() ?>/js/forms.js"></script>
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
            <a href="<?= site_url('users/login') ?>" accesskey="3" title="">
                <?php echo $this->lang->line("login"); ?>
            </a>
        </li>


        <li>
            <a href="<?= site_url('users/register') ?>" accesskey="4" title="">
                <?php echo $this->lang->line("register"); ?>
            </a>
        </li>
    </ul>
</div>

<div class="login">
    <h1>Login</h1>

    <div style="color:red;">
        <?php echo validation_errors(); ?>
        <br>
    </div>

    <?php echo form_open('users/login'); ?>

    <form action="" method="post" name="form">
        <p>
            <input type="text" name="email" required="true" value="" placeholder="Email"/>
        </p>

        <p>
            <input type="password" name="password" required="true" value="" placeholder="Password"/>
        </p>

        <p class="submit">
            <input type="submit" name="commit" value="Login" onclick="formhash(this.form, this.form.password);"/>
        </p>
    </form>
</div>

</body>
</html>
