<?php
/** @var \task\Task $tasks */
?>
<script>
	$(document).ready(function () {
		let sort = $("#sort :nth-child(<?= $sort ?>)").attr('selected', 'selected');
		let page = $(".pagination > li:eq(<?= $page-1 ?>)").addClass('active');
	});
</script>
<div class="container" style="margin-top: 30px">

	<nav class="navbar pull-right">
		<form action="/" method="get" style="display: inline">
			<select name="sort" id="sort">
				<option value="1" selected>Пользователю возрастанию</option>
				<option value="2">Пользователю убыванию</option>
				<option value="3">Email возрастанию</option>
				<option value="4">Email убыванию</option>
				<option value="5">Статусу возрастанию</option>
				<option value="6">Статусу убыванию</option>
			</select>
			<input type="hidden" name="page" value="<?= $page ?>">
			<button class="btn btn-primary" type="submit">Сортировать</button>
		</form>

		<a class="btn btn-primary" href="/task/add">Добавить</a>
		<?php if ($isAdmin === 0) { ?>
			<a  class="btn btn-primary" href="/user/sign-form">Авторизоваться</a>
		<?php } else { ?>
			<a  class="btn btn-primary" href="/user/sign-out">Выйти</a>
		<?php }?>
	</nav>
	<div class="clearfix"></div>
	<div class="alert alert-success alert-dismissible" style="display: <?= $message ? 'block' : 'none'?>">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
	  	<?= $message ?>
	</div>
	<table class="table">
		<tr>
			<th>Пользователь</th>
			<th>е-mail</th>
			<th>Статус</th>
			<th>Текст задачи</th>
			<th></th>
		</tr>

		<?php foreach ($tasks as $task): ?>
			<tr>
				<td><?= $task->username ?></td>
				<td><?= $task->email ?></td>
				<td>
					<?= $task->status ? 'Выполнена' : 'Не выполнена'?>
					<?php if ($isAdmin): ?>
						<div><span class="label label-success"><?= $task->edit ? ' Отредактировано администратором' : ''?></span></div>
					<?php endif; ?>
				</td>
				<td><?= $task->description ?> </td>
				<td>
					<?php if ($isAdmin): ?>
						<a class="" href="/task/update?id=<?= $task->id ?>">Редактировать</a>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<div  class="text-center" <?= $pageVisible ?>>
		<ul class="pagination">
			  <li><a href="/?page=1&sort=<?= $sort ?>">1</a></li>
			  <li><a href="/?page=2&sort=<?= $sort ?>">2</a></li>
		 </ul>
	</div>
</div>


