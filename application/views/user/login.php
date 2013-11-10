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
