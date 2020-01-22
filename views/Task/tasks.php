<?php
/** @var \task\Task $tasks */
var_dump($sort);
var_dump($page);
?>
<script>
	$(document).ready(function () {
		let sort = $("#sort :nth-child(<?= $sort ?>)").attr('selected', 'selected');
		console.log(sort);

		let page = $(".pagination > li:eq(<?= $page-1 ?>)").addClass('active');
		console.log(page);
	});
</script>
	<div class="container" style="top: 30px">
		<nav class="navbar pull-right">
			<a class="btn btn-primary" href="/task/add">Добавить</a>
			<?php if ($admin === 0) { ?>
				<a  class="btn btn-primary" href="/user/signForm">Авторизоваться</a>
			<?php } else { ?>
			<a  class="btn btn-primary" href="/user/signOut">Выйти</a>
			<?php }?>
		</nav>
	</div>

<div class="container">
	<form action="/" method="get">
		<select name="sort" id="sort">
			<option value="1" selected>User asc</option>
			<option value="2">User desc</option>
			<option value="3">Email asc</option>
			<option value="4">Email desc</option>
			<option value="5">Status asc</option>
			<option value="6">Status desc</option>
		</select>
		<button type="submit">sort</button>
	</form>

	 <ul class="pagination">
		  <li><a href="/?page=1">1</a></li>
		  <li><a href="/?page=2">2</a></li>
	 </ul>

	<table class="table">
		<tr>
			<th>Пользователь</th>
			<th>е-mail</th>
			<th>Статус</th>
			<th>Текста задачи</th>
			<th></th>
		</tr>

		<?php foreach ($tasks as $task): ?>
			<tr>
				<td><?= $task->username ?></td>
				<td><?= $task->email ?></td>
				<?php if ($task->status == 1) {?>
					<td>Выполнена</td>
				<?php } else { ?>
					<td>Не выполнена</td>
				<?php } ?>
				<td><?= $task->description ?></td>
				<td>
					<?php if ($admin): ?>
						<a class="" href="/task/update?id=<?= $task->id ?>" > Редактировать</a>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>


