<?php
?>
<script>
	$(document).ready( function () {
		let email = $('#email');
		email.blur(function() {
			let pattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if( !pattern.test(email.val()) ) {
				alert('Некорректный e-mail');
				email.focus();
			}
		});
		let status = $("#status :nth-child(<?= $task->status+1 ?>)").attr('selected', 'selected');
	});
</script>
<h1 class="text-center" style="margin-top: 70px"><?= $pageTitle ?></h1>
<form class="form-horizontal" action="<?= $action ?>" method="post" style="margin-top: 40px">
	<div class="form-group">
		<label class="control-label col-sm-offset-2 col-sm-2" for="username">Имя пользователя</label>
		<div class="col-sm-4">
			<input class="form-control" name="username" type="text"  value="<?= $task->username ?? '' ?>" placeholder="Имя пользователя" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-offset-2 col-sm-2" for="email">Email</label>
		<div class="col-sm-4">
			<input class="form-control" name="email" id="email" type="text" value="<?= $task->email ?? '' ?>" placeholder="Email" required>
		</div>
	</div>
	<div class="form-group">
			<label class="control-label col-sm-offset-2 col-sm-2" for="description">Текста задачи</label>
			<div class="col-sm-4">
				<textarea class="form-control" name="description" placeholder="Текста задачи" required><?= $task->description ?? '' ?></textarea>
			</div>
	</div>
	<?php if ($isAdmin): ?>
		<div class="form-group">
			<label class="control-label col-sm-offset-2 col-sm-2" for="status">Статус</label>
			<div class="col-sm-4">
				<select class="form-control" name="status" id="status"  placeholder="Статус">
					<option value="0">Не выполнена</option>
					<option value="1">Выполнена</option>
				</select>
			</div>
		</div>
	<?php endif; ?>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-4">
			<button class="btn btn-default btn-block" type="submit">Сохранить</button>
			<a  href="/" class="btn btn-default btn-block">Отмена</a>
		</div>
	</div>
</form>
