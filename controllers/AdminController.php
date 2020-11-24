<?php

class AdminController
{

  public static function logout(){
    $user = new User();
    $user->logout();
  }

  public static function login(){
    $user = new User();
    $data = [];
    $data['error'] = [];

    $name = '';
    $password = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($_POST['user-name']) && $_POST['user-name'] !== "") {
          $name = htmlspecialchars($_POST['user-name'], ENT_QUOTES, 'UTF-8');
        }
        else{
          $data['error'][] = "name_empty";
        }

        if (isset($_POST['user-password']) && $_POST['user-password'] !== "") {
          $password = htmlspecialchars($_POST['user-password'], ENT_QUOTES, 'UTF-8');
        }
        else{
          $data['error'][] = "password_empty";
        }

        if (!count($data['error']) && !$user->login($name, $password)) {
          $data['error'][] = "no_login";
        }
    }
    $data['name'] = $name;
    View::render('admin_login_view.php', 'template_view.php', $data);
  }

}
