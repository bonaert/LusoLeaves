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


