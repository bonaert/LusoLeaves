<div class="section">
	<div class="container">
		<div class="row">
	   		<div class="col-lg-12">
				<h2>
					<?= lang("productsTitle"); ?>
				</h2>
			
				<?php if (sizeof($products) == 0): ?>
					<p>
						<?= lang("productsNone"); ?>
					</p>
				<?php else: ?>
				<table class="ui celled large column table segment">
					<thead>
						<tr>
							<th><?= lang("productsProduct"); ?></th>
							<th><?= lang("productsImage"); ?></th>
							<th><?= lang("productsTPB"); ?></th>
							<th><?= lang("productsBPC"); ?></th>
							<?php if ($is_admin): ?>
							<th><?= lang("productsPrice"); ?> Fleuriste</th>
							<th><?= lang("productsPrice"); ?> Grossiste</th>
			                <?php elseif ($is_logged_in && $companyType !== 'unknown'): ?>
							<th><?= lang("productsPrice"); ?></th>
							<?php endif; ?>
							<th><?= lang('productIsAvailable'); ?></th>
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
								<a href="<?php echo $product['imageSitePath']; ?>">
									<img src="<?php echo $product['imageSitePath']; ?>" class="productImg">
								</a>
							</td>
							<td><?php echo $product['tpb']; ?></td>
							<td><?php echo $product['bpc']; ?></td>
							<?php if ($is_logged_in && ($is_admin || $companyType === 'Floriste')): ?>
							<td><?php echo $product['prixFloriste']; ?> EUR</td>
							<?php endif; ?>
							<?php if ($is_logged_in && ($is_admin || $companyType === 'Grossiste')): ?>
							<td><?php echo $product['prixGrossiste']; ?> EUR</td>
							<?php endif; ?>
							<td>
								<?php if ($product['isAvailable']): ?>
									<span class="label label-success"><span class="glyphicon glyphicon-ok"></span></span>
								<?php else: ?>
				                    <span class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span>
				                    <br>
									<?php echo $this->lang->line("availableFrom"); ?> <?= $product['availabilityDate'] ?>
								<?php endif; ?>
							</td>
			
							<?php if ($is_admin): ?>
							<td>
								<a href="<?= site_url('products/edit/') . '/' . $product['id'] ?>">
									<span class="glyphicon glyphicon-edit"></span>
								</a>
							</td>
							<?php endif; ?>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<?php endif; ?>
				<div class="well">
					<ul>
						<?php if ($is_logged_in && $companyType !== "unknown"): ?>
						<li><?= lang('priceFOB') ?></li>
						<?php endif; ?>

                        <li><?= lang('boxSize') ?>: 100 x 40 x 20 cm</li>
                        <li><?= lang('lastModified') . $timestamp?>

                        </li>

					</ul>
				</div>
				<?php if ($is_admin): ?>
				<a href="<?= site_url('products/create') ?>" class="btn btn-success">Add a new product</a>
				<?php endif; ?>
				
			</div>
		</div>
	</div>
</div>
