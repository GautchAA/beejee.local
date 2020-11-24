<h1>Создать задачу</h1>
<?php if($data['method'] == "post" && !count($data['error'])): ?>
  <div class="alert alert-success" role="alert"> Новая задача добавлена </div>
<?php endif; ?>
<?php if(in_array('no_add', $data['error'])): ?>
  <div class="alert alert-danger" role="alert"> Ошибка добавления, свяжитесь с администратором!</div>
<?php endif; ?>

<form method="post">
  <div class="form-group">
    <label for="task-name">Имя:</label>
    <input type="text" class="form-control" id="task-name" name="task-name" aria-describedby="nameHelp" placeholder="Введите имя" value="<?= $data['name'] ?>">
  </div>
  <?php if(in_array('name_empty', $data['error'])): ?>
    <div class="alert alert-danger" role="alert"> Необходимо ввести имя!</div>
  <?php endif; ?>
  <div class="form-group">
    <label for="task-email">Email:</label>
    <input type="email" class="form-control" id="task-email" name="task-email" aria-describedby="emailHelp" placeholder="Введите email" value="<?= $data['email'] ?>">
  </div>
  <?php if(in_array('email_empty', $data['error'])): ?>
    <div class="alert alert-danger" role="alert"> Необходимо ввести email!</div>
  <?php endif; ?>
  <?php if(in_array('email_no_valid', $data['error'])): ?>
    <div class="alert alert-danger" role="alert"> Некорректный email!</div>
  <?php endif; ?>
  <div class="form-group">
    <label for="task-body">Задача:</label>
    <textarea class="form-control" id="task-body" name="task-body" rows="3" ><?= $data['body'] ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Создать</button>
</form>
