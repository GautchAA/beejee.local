<?php

class User extends Model
{

  public function login($name, $password){
    if ($user = $this->db->getRow("SELECT * FROM users WHERE name = '$name' AND password = '". MD5($password)."'")){
      $_SESSION['id'] = $user['id'];
      header('Location: /');
    }
    return false;
  }

  public function logout(){
    unset($_SESSION['id']);
    header('Location: /');
  }

  public function auth(){
    return isset($_SESSION['id']);
  }

}
