<?php

class View
{

  public static function render($content_view, $view, $data = [])
  {
    $user = new User();
    include 'views/'.$view;
  }
}
