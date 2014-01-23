<?php
  class Map {
    public function index() {
      $db = new DB();
      
      if($db->connected()) {
        $page = params("page") != null ? intval(params("page")) : 0;
        
        $rows = 3;
        $limit = $rows * 3;
        $start = $page * $limit;
        
        $query = sprintf("SELECT SQL_CALC_FOUND_ROWS `id`, `name`, `info` FROM `projects` ORDER BY `added` DESC LIMIT %s, %s",
          $db->escape_string($start),
          $db->escape_string($limit)
        );
        $result = $db->query($query);
        
        $projects = Array();
        $pages = Array(
          "previous" => null,
          "next" => null
        );
        
        if($result != false) {
          // Calculate how many more posts there are
          $rem_result = $db->query("SELECT FOUND_ROWS() AS `rem`");
          
          if($rem_result != false) {
            while($rem_row = $rem_result->fetch_assoc()) {
              $rem = intval($rem_row["rem"]);
              
              if($rem > 0 && $page > 0) {
                $pages["previous"] = $page - 1;
              }
              
              if($rem > ($start + $limit)) {
                $pages["next"] = $page + 1;
              }
            }
          }
          
          while($row = $result->fetch_assoc()) {
            array_push($projects, Array(
              "id" => $row["id"],
              "name" => $row["name"],
              "info" => Parsedown::instance()->parse($row['info'])
            ));
          }
        }
        
        set('title', "beCyCle - Projects");
        set("projects", $projects);
        set('active', "projects");
        set('pages', $pages);
        return render("main/projects.php", "main.layout.php");
      } else {
        halt(SERVER_ERROR, "Database not connected");
      }
    }
    
    public function id() {
      $id = params("id");
      $db = new DB();
      
      if($db->connected()) {
        $query = sprintf("SELECT `name`, `info`, `added`, `by` FROM `projects` WHERE `id` = '%s'", 
          $db->escape_string($id)
        );
        $result = $db->query($query);
        
        $project = null;
        
        if($result != false) {
          while($row = $result->fetch_assoc()) {
            $date = new DateTime($row["added"]);
            $by_name = "Deleted User";
            
            $user_query = sprintf("SELECT `full` FROM `users` WHERE `id` = '%s'",
              $db->escape_string($row["by"])
            );
            $user_result = $db->query($user_query);
            
            if($user_result != null) {
              while($user_row = $user_result->fetch_assoc()) {
                $by_name = $user_row["full"];
              }
            }
            
            $project = Array(
              "name" => $row["name"],
              "info" => Parsedown::instance()->parse($row['info']),
              "added" => $date->format('l jS M Y'),
              "by" => $by_name
            );
          }
        }
        
        set('title', "beCyCle - " . ($project["name"] ? $project["name"] : "Unknown Page"));
        set("project", $project);
        set('active', "projects");
        return render("main/project.php", "main.layout.php");
      } else {
        halt(SERVER_ERROR, "Database not connected");
      }
    }
    
    /* API Functions */
    public function API_update() {
      
    }
    
    public function API_list() {
      
    }
    
    public function API_get() {
      
    }
  }
?>