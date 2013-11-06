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
    <title>Luso Leaves</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <!--<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet"/>-->
    <link href="<?php echo asset_url() ?>css/default.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo asset_url() ?>css/main.css" rel="stylesheet" type="text/css" media="all"/>

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr8NrowWwR9foQuKE4s2jJlopGP0UbHgY&sensor=false">
    </script>
    <script type="text/javascript">
        function initialize() {
            var myLatlng = new google.maps.LatLng(37.3666, -8.78535);
            var mapOptions = {
                zoom: 17,
                center: new google.maps.LatLng(37.3666, -8.78535),
                mapTypeId: google.maps.MapTypeId.SATELLITE
            };

            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'Luso Leaves'
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

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
<div id="header-wrapper">
    <div id="header" class="container">
        <img src="<?php echo base_url() ?>/assets/images/logo.png" class="image-centered headerImg">
    </div>
</div>
<div id="wrapper1">
    <div id="welcome" class="container">

        <div class="title">
            <h2>Luso Leaves</h2>
        </div>
        <div class="content">
            <p>
                <?php echo $this->lang->line("companyDescription1"); ?>
            </p>

            <p>
                <?php echo $this->lang->line("companyDescription2"); ?>
            </p>

            <p>
                <?php echo $this->lang->line("companyDescription3"); ?>
            </p>

        </div>
    </div>
</div>
<div id="wrapper3">
    <div id="description" class="container">
        <div class="title">
            <h2><?php echo $this->lang->line('findUsTitle'); ?></h2>
        </div>

        <div class="content">
            <pre>
            <strong><?php echo $this->lang->line("findUsName"); ?></strong>: Gerik Bonaert - Folhagens Decorativas do Algarve Unip. Lda

            <strong><?php echo $this->lang->line("findUsAddress"); ?></strong>:  Estufa das Carapuças, Rogil, Aljezur, PORTUGAL

            <strong><?php echo $this->lang->line("findUsPostalCode"); ?></strong>: Caixa Postal 363-L, 8670-440, Rogil, Aljezur, PORTUGAL

            <strong>Email</strong>: <a href="mailto:lusoleaves@sapo.pt">lusoleaves@sapo.pt</a>

            <strong><?php echo $this->lang->line("findUsPhoneNumber"); ?></strong>: (00351) 925 303 403

            <strong><?php echo $this->lang->line("findUsCoordinates"); ?></strong>: 37.3666, -8.78535
            </pre>
        </div>

        <!-- map goes here-->
        <div id="map-canvas" class="map"></div>

    </div>
</div>
<div id="copyright">
    <p>Copyright (c) 2013 LusoLeaves.com. All rights reserved.</p>
</div>
</body>
</html>
