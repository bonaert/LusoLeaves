<div class="section">
	<div class="container">
		<div class="row">
	   		<div class="col-lg-12">
	   		
	   			<h2>Users</h2>
	   			
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
		                                <span class="glyphicon glyphicon-edit"></span>
		                            </a>
		                        </td>
		                        <td class="ui icon">
		                            <a href="<?= site_url('users/delete/') . '/' . $user['id'] ?>" class="ui icon" style="color:red;">
		                                <span class="glyphicon glyphicon-remove"></span>
		                            </a>
		                        </td>
		                    </tr>
		                <?php endforeach ?>
		
		                </tbody>
		            </table>
		        	<?php endif; ?>

			</div>
		</div>
	</div>
</div>