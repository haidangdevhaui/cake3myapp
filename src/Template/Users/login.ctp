<?php $this->start('title') ?>
	Login
<?php $this->end() ?>

<?php $this->start('auth_content') ?>
	<?php echo $this->FLash->render() ?>
	<form action="/auth/login" method="POST" role="form">
		<div class="form-group">
			<label for="">Username</label>
			<input type="text" class="form-control" id="" placeholder="enter your username" name="username">
		</div>
		<div class="form-group">
			<label for="">Password</label>
			<input type="password" class="form-control" id="" placeholder="enter your password" name="password">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
		<a href="/auth/register" class="pull-right">Create your account</a>
	</form>
<?php $this->end() ?>