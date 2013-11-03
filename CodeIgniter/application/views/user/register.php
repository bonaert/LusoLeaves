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
    <title>Luso Leaves - Register</title>
    <link type="text/css" rel="stylesheet" href="<?php echo asset_url() ?>/css/form.css">

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

        <?php if ($is_logged_in): ?>
            <li>
                <a href="<?= site_url('users/logout') ?>" accesskey="3" title="">
                    <?php echo $this->lang->line("logout"); ?>
                </a>
            </li>
        <?php else: ?>
            <li>
                <a href="<?= site_url('users/login') ?>" accesskey="3" title="">
                    <?php echo $this->lang->line("login"); ?>
                </a>
            </li>
        <?php endif; ?>


        <li>
            <a href="<?= site_url('users/register') ?>" accesskey="4" title="">
                <?php echo $this->lang->line("register"); ?>
            </a>
        </li>
    </ul>
</div>

<div class="login">
    <h1>
        <?= lang('register') ?>
    </h1>

    <div style="color:red;">
        <?php echo validation_errors(); ?>
        <br>
    </div>

    <?php echo form_open('users/register'); ?>

    <form action="" method="post" name="form">

        <p>
            <input type="text" name="companyName" required="true"
                   placeholder="<?= lang("registerCompanyName"); ?>">
        </p>

        <p>
            <input type="text" name="name" required="true"
                   placeholder="<?= lang("registerName"); ?>">
        </p>


        <p>
            <input type="number" name="phoneNumber" required="true"
                   placeholder="<?= lang("registerPhoneNumber"); ?>">
        </p>

        <p>
            <input type="number" name="contribuinteNumber" required="true"
                   placeholder="<?= lang("registerContribuinteNumber"); ?>">
        </p>

        <p>
            <input type="text" name="address" required="true"
                   placeholder="<?= lang("registerAddress"); ?>">
        </p>

        <p>
            <input type="text" name="email" required="true" placeholder="Email">
        </p>


        <p>
            <input type="password" name="password" required="true" placeholder="Password">
        </p>

        <p class="submit">
            <input type="submit" name="commit" value="Register" onclick="formhash(this.form, this.form.password);">
        </p>
    </form>
</div>

</body>
</html>

