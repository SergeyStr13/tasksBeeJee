<?php
?>
<div class="sign-in" style="margin-top: 70px">
	<h1 class="text-center">Авторизация</h1>
	<form class="form-horizontal" action="/user/sign-in" method="post" style="margin-bottom: 20px; margin-top: 30px">
		<div class="form-group">
			<label class="control-label col-sm-offset-2 col-sm-2" for="login">Логин</label>
			<div class="col-sm-4">
				<input class="form-control" name="login" type="text" value="" placeholder="Логин" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-offset-2 col-sm-2" for="login">Пароль</label>
			<div class="col-sm-4">
				<input class="form-control" name="password" type="text" value="" placeholder="Пароль" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<button class="btn btn-default btn-block" type="submit">Войти</button>
			</div>
		<div>
	</form>
	<div class="clearfix"></div>
	<div class="alert alert-success alert-dismissible" style="display: <?= $message ? 'block' : 'none'?>; margin-top: 10px">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
	  	<?= $message ?>
	</div>
</div>
