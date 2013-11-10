<div id="wrapper1">
    <div id="welcome" class="container">

    </div>
</div>
<div id="wrapper3">
    <div id="description" class="container">


        <div class="title">
            <h2>Add Product</h2>
        </div>


        <form class="ui tertiary form segment" method="POST" enctype="multipart/form-data">
            <div style="color:red;">
                <?php echo validation_errors(); ?>
                <br>
            </div>

            <?php echo form_open('products/create'); ?>
            <div class="field">
                <label>Name</label>
                <input type="text" name="name">
            </div>

            <div class="field">
                <label>Image</label>
                <input type="file" name="image">
            </div>

            <div class="field">
                <label>Tiges par Bouquet</label>
                <input type="text" name="tpb">
            </div>

            <div class="field">
                <label>Bouquets par caisse</label>
                <input type="text" name="bpc">
            </div>

            <div class="field">
                <label>Prix Floriste</label>
                <input type="text" name="prixFloriste">
            </div>

            <div class="field">
                <label>Prix Grossiste</label>
                <input type="text" name="prixGrossiste">
            </div>
            <input class="ui green submit button" type="submit" name="submit" value="Save"/>
        </form>
    </div>
</div>
