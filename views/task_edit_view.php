<h1>Редактирование задачи</h1>
<?php if($data['method'] == "post" && !count($data['error'])): ?>
  <div class="alert alert-success" role="alert"> Задача изменена.</div>
<?php endif; ?>
<?php if(in_array('no_add', $data['error'])): ?>
  <div class="alert alert-danger" role="alert"> Ошибка изменения, свяжитесь с администратором!</div>
<?php endif; ?>
<form method="post">
  <div class="form-group">
    <label for="task-name">Имя:</label>
    <input type="text" class="form-control" id="task-name" name="task-name" aria-describedby="nameHelp" placeholder="Введите имя" value="<?= $data['task']['name'] ?>">
  </div>
  <?php if(in_array('name_empty', $data['error'])): ?>
    <div class="alert alert-danger" role="alert"> Необходимо ввести имя!</div>
  <?php endif; ?>
  <div class="form-group">
    <label for="task-email">Email:</label>
    <input type="email" class="form-control" id="task-email" name="task-email" aria-describedby="emailHelp" placeholder="Введите email" value="<?= $data['task']['email'] ?>">
  </div>
  <?php if(in_array('email_empty', $data['error'])): ?>
    <div class="alert alert-danger" role="alert"> Необходимо ввести email!</div>
  <?php endif; ?>
  <?php if(in_array('email_no_valid', $data['error'])): ?>
    <div class="alert alert-danger" role="alert"> Некорректный email!</div>
  <?php endif; ?>
  <div class="form-group">
    <label for="task-body">Задача:</label>
    <textarea class="form-control" id="task-body" name="task-body" rows="3" ><?= $data['task']['body'] ?></textarea>
  </div>

  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="task-status" name="task-status" <?php if($data['task']['status'] == 2): ?>checked<?php endif ?>>
    <label class="form-check-label" for="task-status">Выполнена</label>
  </div>
  <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
