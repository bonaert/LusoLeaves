<?php
$_external_css[] = '';
$_internal_css[] = '';
$_internal_js[] = '';
$_external_js[] = '';
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">

    <title>Luso Leaves</title>

    <meta name="keywords" content=""/>
    <meta name="description" content=""/>

    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>favicon.png"/>

    <?php echo format_external_css($_external_css); ?>
    <?php echo format_internal_css($_internal_css); ?>
    <link href="<?php echo asset_url(); ?>css/default.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?php echo asset_url(); ?>css/main.css" rel="stylesheet" type="text/css" media="screen"/>

    <?php echo format_external_js($_external_js) ?>
    <?php echo format_internal_js($_internal_js) ?>
</head>
<body>

<!-- Flags -->
<div class="icons">
    <a href="<?= base_url() . $this->lang->switch_uri('pt'); ?>">
        <img src="https://cdn1.iconfinder.com/data/icons/flags_gosquared/48/Portugal_flat.png" alt="Portuguese"/>
    </a>

    <a href="<?= base_url() . $this->lang->switch_uri('en'); ?>">
        <img src="https://cdn1.iconfinder.com/data/icons/flags/flags/48/United%20Kingdom%28Great%20Britain%29.png"
             alt="English"/>
    </a>
</div>

<!-- Menu -->
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

        <?php if ($is_admin): ?>
            <li>
                <a href="<?= site_url('users') ?>" accesskey="2" title="">
                    Users
                </a>
            </li>
        <?php endif; ?>

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

<!-- Header -->
<div id="header-wrapper">
    <div id="header" class="container">
        <img src="<?php echo base_url() ?>/assets/images/logo.png" class="image-centered headerImg">
    </div>
</div>

<?php echo $this->load->view($content_view); ?>

<div id="copyright">
    <p>Copyright (c) 2013 LusoLeaves.com. All rights reserved.</p>
</div>
</body>
</html>
