<?php ?>
<h1>Добавление </h1>
<form class="" action="<?= $action ?>" method="post">
	<input name="username" type="text"  value="<?= $task->username ?? '' ?>" placeholder="Имя пользователя" required>
	<input name="email" type="text" value="<?= $task->email ?? '' ?>" placeholder="Email" required>
	<textarea name="description" placeholder="Описание" required><?= $task->description ?? '' ?></textarea>
	<?php if ($admin): ?>
		<input name="status" type="text" value="<?= $task->status ?? 0 ?>"placeholder="Статус">
	<?php endif; ?>
	<button type="submit">Сохранить</button>
</form>