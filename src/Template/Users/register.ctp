<?php $this->start('title') ?>
	Register
<?php $this->end() ?>

<?php $this->start('auth_content') ?>

	<?= $this->Form->create(null, ['url' => '/auth/register', 'type' => 'post']) ?>
		<div class="form-group">
			<?= $this->Form->control('username', ['type' => 'text', 'class' => 'form-control']) ?>
		</div>
		<div class="form-group">
			<?= $this->Form->control('role', ['type' => 'text', 'class' => 'form-control']) ?>
			<?= $this->Form->error('role'); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->control('password', ['type' => 'password', 'class' => 'form-control']) ?>
			<?= $this->Form->error('password'); ?>
		</div>
		<pre>
			<?php print_r($errors); ?>
		</pre>
		<?= $this->FLash->render() ?>
		<?= $this->Form->submit('Submit', ['formnovalidate' => true, 'class' => 'btn btn-primary']); ?>
		<a href="/auth/login" class="pull-right">Login</a>
	<?= $this->Form->end(); ?>

<?php $this->end() ?>