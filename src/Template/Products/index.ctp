<?php $this->start('product_content') ?>
	<a href="/products/create" class="btn btn-success">create</a><br><br>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($products as $p){ ?>
			<tr>
				<td><?php echo $p->id ?></td>
				<td><img src="<?php echo $p->image ?>" alt="" width="50" height="50"></td>
				<td><?php echo $p->name ?></td>
				<td>
					<div class="btn-group btn-group-sm">
						<a href="/products/edit/<?php echo $p->id ?>" class="btn btn-warning">edit</a>
						<a href="/products/delete/<?php echo $p->id ?>" class="btn btn-danger">delete</a>
					</div>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<ul class="pagination">
		<?= $this->Paginator->numbers() ?>
		<?= $this->Paginator->prev('« Previous') ?>
		<?= $this->Paginator->next('Next »') ?>
		<?php //$this->Paginator->counter() ?>
	</ul>
<?php $this->end() ?>