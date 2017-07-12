<?php 
use Cake\Routing\Router;
?>

<?php $this->start('product_content') ?>
	<?= $this->Form->create($product, ['type' => 'post', 'url' => isset($id) ? '/products/edit/'.$id : '/products/create']) ?>
		<div class="form-group">
			<?= $this->Form->control('name', ['class' => 'form-control']) ?>
		</div>
		<div class="form-group">
			<?= $this->Form->select('category_id', $categories, ['empty' => '---Chose category---', 'class' => 'form-control']) ?>
		</div>
		<div class="form-group">
			<?= $this->Form->control('file', ['type' => 'file']) ?>
			<?= $this->Form->hidden('image') ?>
			<img src="" alt="" width="100" height="100" id="imageView">
		</div>
		<?= $this->Form->submit('Submit', ['class' => 'btn btn-primary']) ?>
	<?= $this->Form->end() ?>
	
<script>
	$('#file').change(function(){
		var form = new FormData;
		form.append('image', $(this)[0].files[0]);
		$.ajax({
			type: 'POST',
			url: "<?php echo Router::url('products/upload') ?>",
			data: form,
			dataType: 'JSON',
			cache: false,
	        contentType: false,
	        processData: false,
	        success: function(res){
				if(!res.error){
					$('[name=image]').val(res.path);
					$('#imageView').attr('src', "<?php echo Router::url('/') ?>" + res.path);
				}else{
					console.log('Error');
				}
	        }
		});
	});
</script>
<?php $this->end() ?>