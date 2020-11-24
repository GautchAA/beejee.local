<div class="row align-items-center">
  <div class="col">
    <h1>Задачи</h1>
  </div>
  <?php if($data['countPages']): ?>
  <div class="col-auto sort-block">
      <div class="btn-group mr-2" role="group" aria-label="First group">
        <?php  foreach ($data['sorts'] as $sort): ?>
          <a href="<?= $sort['url'] ?>" role="button" class="btn<?php if($sort['checked']): ?> btn-primary<?php if($sort['checked'] == 2): ?> up<?php endif; ?><?php else: ?> btn-secondary<?php endif; ?>">
            <?= $sort['name'] ?>
          </a>
        <?php endforeach; ?>
      </div>
  </div>
  <?php endif; ?>
</div>

<?php if($data['countPages']): ?>
  <div class="row">
  <?php foreach ($data['tasks'] as $key => $task):?>
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <h5 class="card-title"><?= $task['name'] ?></h5>
              <h6 class="card-subtitle mb-2 text-muted"><?= $task['email'] ?></h6>
              <p class="card-text"><?= $task['body'] ?></p>
              <?php if($user->auth()): ?>
              <a href="task/edit/<?= $task['id'] ?>" class="card-link">Редактировать</a>
              <a href="task/delete/<?= $task['id'] ?>" class="card-link">Удалить</a>
            <?php endif; ?>
            </div>
            <div class="col-4">
              <?php if ($task['status'] == 2): ?><div class="alert alert-info" role="alert"> Выполнено </div><?php endif ?>
              <?php if ($task['change_admin']): ?><div class="alert alert-warning" role="alert"> Изменено администратором! </div><?php endif ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  <?php endforeach ?>
  </div>
<?php else: ?>
  <a class="btn btn-primary" href="task/add" role="button">Создать задачу</a>
<?php endif; ?>

<?php if($data['countPages'] > 1): ?>
<nav aria-label="...">
  <ul class="pagination pagination-lg">
    <?php for ($page = 1; $page <= $data['countPages']; $page++): ?>
      <li class="page-item<?php if($data['currentPage'] == $page): ?> active<?php endif; ?>">
        <a href="<?= $data['urlPage'].$page ?>" class="page-link">
          <?= $page ?>
        </a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>
<?php endif; ?>
