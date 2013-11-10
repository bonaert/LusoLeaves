<div id="wrapper1">
    <div class="container" id="welcome"></div>
</div>

<div id="wrapper3">
    <div id="description" class="container">


        <div class="title">
            <h2>
                Users
            </h2>
        </div>


        <?php if (sizeof($users) == 0): ?>
            <p>
                No users.
            </p>
        <?php else: ?>
            <table class="ui celled large column table segment">
                <thead>
                <tr>
                    <th>
                        User Name
                    </th>

                    <th>
                        Company Name
                    </th>
                    <th>
                        User ID
                    </th>
                    <th>
                        Company Type
                    </th>
                    <th>
                        VAT Number
                    </th>
                    <th>
                        Edit
                    </th>

                    <th>
                        Delete
                    </th>
                </tr>
                </thead>
                <tbody>


                <?php foreach ($users as $user) : ?>
                    <tr class="productRow">
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['companyName'] ?></td>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['companyType']; ?></td>
                        <td><?php echo $user['contribuinteNumber']; ?></td>
                        <td>
                            <a href="<?= site_url('users/edit/') . '/' . $user['id'] ?>">
                                <img class="productImg"
                                     src="https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/new-24-32.png"/>
                            </a>
                        </td>
                        <td class="ui icon">
                            <a href="<?= site_url('users/delete/') . '/' . $user['id'] ?>" class="ui icon" style="color:red;">
                                <i class="ui large remove icon"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>

                </tbody>
            </table>
        <?php endif; ?>

    </div>
</div>
