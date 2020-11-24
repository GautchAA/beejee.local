<?php

class MainController
{

  public static function index(){

    $task = new Task();

    $data = [];
    $filter = [];

    $filter['limit'] = 3;

    if (isset($_GET['sort'])) {
      $filter['sort'] = $_GET['sort'];
    }

    $countTasks = $task->getCountTasks($filter);
    $countPages = 0;
    $currentPage = 1;
    $urlPage = "/?page=";

    if ($countTasks) {
      $countPages = (int)(($countTasks + 2) / 3);
      if (isset($_GET['page']) && $_GET['page'] > 0) {
        $currentPage = $_GET['page'] > $countPages ? $countPages : $_GET['page'];
        $filter['page'] = $currentPage - 1;
      }
    }
    if (isset($_GET['sort'])) {
      $urlPage = "/?sort=".$_GET['sort']."&page=";
    }

    $data['countPages'] = $countPages;
    $data['currentPage'] = $currentPage;
    $data['urlPage'] = $urlPage;

    $tasks = $task->getTasks($filter);
    $data['tasks'] = $tasks;

    $sorts = [];
    $sorts[] = ['name' => "По имени", 'url' => 'name', 'checked' => 0];
    $sorts[] = ['name' => "По email", 'url' => 'email', 'checked' => 0];
    $sorts[] = ['name' => "По статусу", 'url' => 'status', 'checked' => 0];
    if (isset($_GET['sort'])) {
      foreach ($sorts as $keySort => $sort) {
        if ($sort['url'] === $_GET['sort']) {
          $sorts[$keySort]['url'] = $sort['url']."_desc";
          $sorts[$keySort]['checked'] = 1;
        }
        elseif ($sort['url']."_desc" === $_GET['sort']) {
          $sorts[$keySort]['url'] = "";
          $sorts[$keySort]['checked'] = 2;
        }
      }
    }
    foreach ($sorts as $keySort => $sort) {
      if ($sort['url']) {
        $sorts[$keySort]['url'] = "/?sort=".$sort['url'].($currentPage > 1?("&page=".$currentPage):"");
      }
      elseif($currentPage > 2){
        $sorts[$keySort]['url'] = "/?page=".$currentPage;
      }
      else{
        $sorts[$keySort]['url'] = "/";
      }
    }
    $data['sorts'] = $sorts;

    View::render('main_view.php', 'template_view.php', $data);
  }

  public static function page_404(){
      View::render('404_view.php', 'template_view.php', $data);
  }

}
