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

                    <?php if ($is_admin): ?>
                        <th>
                            <?= lang("productsPrice"); ?> Floriste
                        </th>

                        <th>
                            <?= lang("productsPrice"); ?> Grossiste
                        </th>
                    <?php elseif ($is_logged_in && $companyType !== 'unknown'): ?>
                        <th>
                            <?= lang("productsPrice"); ?>
                        </th>
                    <?php endif; ?>

                    <th>
                        <?= lang('productIsAvailable'); ?>
                    </th>

                    <?php if ($is_admin): ?>
                        <th>Edit</th>
                    <?php endif; ?>
                </tr>

                </thead>
                <tbody>


                <?php foreach ($products as $product) : ?>
                    <tr class="productRow">
                        <td><?php echo $product['name']; ?></td>
                        <td>
                            <a href="<?php echo $product['imageSitePath']; ?>">
                                <img src="<?php echo $product['imageSitePath']; ?>"
                                     class="productImg">
                            </a>
                        </td>
                        <td><?php echo $product['tpb']; ?></td>
                        <td><?php echo $product['bpc']; ?></td>
                        <?php if ($is_logged_in && ($is_admin || $companyType == 'Floriste')): ?>
                            <td><?php echo $product['prixFloriste']; ?> €</td>
                        <?php endif; ?>

                        <?php if ($is_logged_in && ($is_admin || $companyType == 'Grossiste')): ?>
                            <td><?php echo $product['prixGrossiste']; ?></td>
                        <?php endif; ?>
                        <td>
                            <?php if ($product['isAvailable']): ?>
                                <img
                                    src="http://icons.iconarchive.com/icons/deleket/scrap/48/Aqua-Ball-Green-icon.png"
                                    alt="Product available"/>
                            <?php else: ?>
                                <img
                                    src="http://icons.iconarchive.com/icons/deleket/scrap/48/Aqua-Ball-Red-icon.png"
                                    alt="Product Not available"/><br>
                                <?php echo $this->lang->line("availableFrom"); ?> <?= $product['availabilityDate'] ?>
                            <?php endif; ?>
                        </td>

                        <?php if ($is_admin): ?>
                            <td>
                                <a href="<?= site_url('products/edit/') . '/' . $product['id'] ?>">
                                    <img class="productImg"
                                         src="https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/new-24-32.png"/>
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach ?>

                </tbody>
            </table>
        <?php endif; ?>

        <?php if ($is_logged_in && $companyType !== "unknown"): ?>
            * <?= lang('priceFOB') ?>
            <br>
        <?php endif; ?>
        * <?= lang('boxSize') ?> : 100 x 40 x 20 cm
        <br><br>

        <?php if ($is_admin): ?>
            <a href="<?= site_url('products/create') ?>" class="ui green button">Add a new product</a>
        <?php endif; ?>

    </div>
</div>
