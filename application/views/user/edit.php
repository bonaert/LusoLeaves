<div id="wrapper1">
    <div id="welcome" class="container">

    </div>
</div>
<div id="wrapper3">
    <div id="description" class="container">


        <div class="title">
            <h2>Edit User</h2>
        </div>

        <p>Name: <?php echo $user['name']; ?></p>

        <p>ID : <?php echo $user['id']; ?></p>

        <p>Company Name: <?php echo $user['companyName']; ?></p>

        <p>VAT Number: <?php echo $user['contribuinteNumber']; ?></p>

        <p>Phone Number: <?php echo $user['phoneNumber']; ?></p>

        <p>Address: <?php echo $user['address']; ?></p>

        <p>Email: <?php echo $user['email'] ?></p>

        <form class="ui tertiary form segment" method="POST" enctype="multipart/form-data">
            <div style="color:red;">
                <?php echo validation_errors(); ?>
                <br>
            </div>

            <?php echo form_open('users/edit'); ?>

            <div class="ui field">
                <select name="companyType" style="width: 300px;">
                    <option value="Select company type" disabled selected>Select company type</option>
                    <option value="Floriste">Floriste</option>
                    <option value="Grossiste">Grossiste</option>
                    <option value="unknown">Unknown</option>
                </select>
            </div>

            <input class="ui green submit button" type="submit" name="submit" value="Save"/>
        </form>

    </div>
</div>