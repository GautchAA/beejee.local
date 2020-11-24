<?php

class TaskController
{

  public static function add(){
    $data = [];
    $data['error'] = [];
    $data['method'] = "get";

    $name = '';
    $email = '';
    $body = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $data['method'] = "post";
        $task = new Task();

        if (isset($_POST['task-name']) && $_POST['task-name'] !== "") {
          $name = htmlspecialchars($_POST['task-name'], ENT_QUOTES, 'UTF-8');
        }
        else{
          $data['error'][] = "name_empty";
        }

        if (isset($_POST['task-email']) && $_POST['task-email'] !== "") {
          $email = htmlspecialchars($_POST['task-email'], ENT_QUOTES, 'UTF-8');
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $data['error'][] = "email_no_valid";
            $email = "";
          }
        }
        else{
          $data['error'][] = "email_empty";
        }

        if (isset($_POST['task-body']) && $_POST['task-body'] !== "") {
          $body = htmlspecialchars($_POST['task-body'], ENT_QUOTES, 'UTF-8');
        }

        if (!count($data['error']) && !$task->addTask(['name' => $name, 'email' => $email, 'body' => $body])) {
          $data['error'][] = "no_add";
        }
        elseif(!count($data['error'])){
          $name = "";
          $body = "";
          $email = "";
        }
    }
    $data['name'] = $name;
    $data['body'] = $body;
    $data['email'] = $email;


    View::render('task_add_view.php', 'template_view.php', $data);
  }

    public static function edit($id){
      $user = new User();
      if (!$user->auth()) {
        return header('Location: /admin/login');
      }

      $data = [];
      $data['error'] = [];
      $data['method'] = "get";

      $task = new Task();
      $taskRender = $task->getTask($id);

      if($_SERVER['REQUEST_METHOD'] === 'POST')
      {
          $change_admin = 0;

          $data['method'] = "post";

          if (isset($_POST['task-name']) && $_POST['task-name'] !== "") {
            $taskRender['name'] = htmlspecialchars($_POST['task-name'], ENT_QUOTES, 'UTF-8');
          }
          else{
            $data['error'][] = "name_empty";
          }
          if (isset($_POST['task-email']) && $_POST['task-email'] !== "") {
            $taskRender['email'] = htmlspecialchars($_POST['task-email'], ENT_QUOTES, 'UTF-8');
            if (!filter_var($taskRender['email'], FILTER_VALIDATE_EMAIL)){
              $data['error'][] = "email_no_valid";
            }
          }
          else{
            $data['error'][] = "email_empty";
          }
          $body = "";
          if (isset($_POST['task-body']) && $_POST['task-body'] !== "") {
            $body = htmlspecialchars($_POST['task-body'], ENT_QUOTES, 'UTF-8');
          }
          if ($body !== $taskRender['body']) {
            $taskRender['change_admin'] = 1;
          }
          $taskRender['body'] = $body;

          $taskRender['status'] = isset($_POST['task-status']) ? 2: 1;

          if (!count($data['error']) && !$task->updateTask($id, $taskRender)) {
            $data['error'][] = "no_add";
          }
      }

      $data['task'] = $taskRender;
      View::render('task_edit_view.php', 'template_view.php', $data);
    }

  public static function delete($id){
    $user = new User();
    if (!$user->auth()) {
      return header('Location: /admin/login');
    }
    $task = new Task();
    $task->deleteTask($id);
    View::render('task_delete_view.php', 'template_view.php');
  }

}
