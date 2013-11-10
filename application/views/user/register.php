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
            <input type="text" name="phoneNumber" required="true"
                   placeholder="<?= lang("registerPhoneNumber"); ?>">
        </p>

        <p>
            <input type="text" name="contribuinteNumber" required="true"
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

