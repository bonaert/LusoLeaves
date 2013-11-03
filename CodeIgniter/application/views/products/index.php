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
    <title>Luso Leaves - Products</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.3.4/css/semantic.min.css">
    <link href="<?php echo asset_url() ?>css/default.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset_url() ?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset_url() ?>css/table.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset_url() ?>css/product.css" rel="stylesheet" type="text/css"/>

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
<div id="header-wrapper">
    <div id="header" class="container">
        <img src="/images/logo.png" class="image-centered headerImg">
    </div>
</div>

<div id="wrapper1">
    <div class="container" id="welcome"></div>
</div>

<div id="wrapper3">
    <div id="description" class="container">


        <div class="title">
            <h2>
                <?= lang("productsTitle"); ?>
            </h2>
        </div>


        <?php if (sizeof($products) == 0): ?>
            <p>
                <?= lang("productsNone"); ?>
            </p>
        <?php else: ?>
            <table class="ui celled large column table segment">
                <thead>
                <tr>
                    <th>
                        <?= lang("productsProduct"); ?>
                    </th>
                    <th>
                        <?= lang("productsImage"); ?>
                    </th>
                    <th>
                        <?= lang("productsTPB"); ?>
                    </th>
                    <th>
                        <?= lang("productsBPC"); ?>
                    </th>

                    <?php if ($is_logged_in): ?>
                        <th>
                            <?= lang("productsPrice"); ?>
                        </th>
                    <?php endif; ?>

                    <?php if ($is_admin): ?>
                        <th>Edit</th>
                    <?php endif; ?>
                </tr>

                </thead>
                <tbody>


                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td>
                            <a href="<?php echo $product['image']; ?>">
                                <img src="<?php echo $product['image']; ?>"
                                     class="productImg">
                            </a>
                        </td>
                        <td><?php echo $product['tpb']; ?></td>
                        <td><?php echo $product['bpc']; ?></td>
                        <?php if ($is_logged_in && $companyType == 'Floriste'): ?>
                            <td><?php echo $product['prixFloriste']; ?> €</td>
                        <?php elseif ($is_logged_in && $companyType == 'Grossiste'): ?>
                            <td><?php echo $product['prixGrossiste']; ?></td>
                        <?php endif; ?>

                        <?php if ($is_admin): ?>
                            <td>
                                <a href="edit.php?id=<?php echo $product['id'] ?>">
                                    <img
                                        src="https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/new-24-32.png"/>
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach ?>

                </tbody>
            </table>
        <?php endif; ?>

        * <?= lang('priceFOB') ?>
        <br>

        <?php if ($is_admin): ?>
            <a href="add.php" class="ui green button">Add a new product</a>
        <?php endif; ?>


    </div>
</div>
<div id="copyright">
    <p>Copyright (c) 2013 LusoLeaves.com. All rights reserved.</p>
</div>
</body>