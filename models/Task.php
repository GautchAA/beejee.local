<?php

class Task extends Model
{

  public function getTasks($filter = []){
    $sort = "ORDER BY id DESC";
    if (isset($filter['sort'])) {
      switch ($filter['sort']) {
        case 'name':
          $sort = "ORDER BY name ";
          break;
        case 'name_desc':
          $sort = "ORDER BY name DESC";
          break;
        case 'email':
          $sort = "ORDER BY email";
          break;
        case 'email_desc':
          $sort = "ORDER BY email DESC";
          break;
        case 'status':
          $sort = "ORDER BY status";
          break;
        case 'status_desc':
          $sort = "ORDER BY status DESC";
          break;
      }
    }

    $limit = "";
    if (isset($filter['limit'])) {
      $limit = "LIMIT ";
      if (isset($filter['page'])) {
        $limit .= ($filter['page'] * $filter['limit']).", ";
      }
      $limit .= $filter['limit'];
    }
    $query = "SELECT * FROM tasks WHERE status > 0 $sort $limit";
    return $this->db->getRows($query);
  }

  public function getCountTasks($filter = []){
    return $this->db->getRow("SELECT COUNT(*) as count FROM tasks WHERE status > 0")['count'];
  }

  public function getTask($id){
    return $this->db->getRow("SELECT * FROM tasks WHERE id = $id");
  }

  public function addTask($task){
    return $this->db->insert("tasks", $task);
  }

  public function updateTask($id, $task){
    return $this->db->update("tasks", $task, "id = $id");
  }

  public function deleteTask($id){
    return $this->db->update("tasks", ['status' => 0], "id = $id");
  }

}
