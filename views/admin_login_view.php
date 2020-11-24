<h1>Авторизация</h1>
<form method="post">
  <div class="form-group">
    <label for="user-name">Имя пользователя:</label>
    <input type="text" class="form-control" id="user-name" name="user-name" aria-describedby="emailHelp" placeholder="Имя" value="<?= $data['name'] ?>">
  </div>
  <?php if(in_array('name_empty', $data['error'])): ?>
    <div class="alert alert-danger" role="alert"> Необходимо ввести имя пользователя!</div>
  <?php endif; ?>
  <div class="form-group">
    <label for="user-password">Пароль:</label>
    <input type="password" class="form-control" id="user-password" name="user-password" placeholder="Пароль">
  </div>

  <?php if(in_array('password_empty', $data['error'])): ?>
    <div class="alert alert-danger" role="alert"> Необходимо ввести пароль!</div>
  <?php endif; ?>
  <?php if(in_array('no_login', $data['error'])): ?>
    <div class="alert alert-danger" role="alert"> Имя пользователя или пароль неверны!</div>
  <?php endif; ?>

  <button type="submit" class="btn btn-primary">Авторизоваться</button>
</form>
