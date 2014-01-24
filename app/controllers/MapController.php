<?php
  class MapController extends MainBaseController {
    public function index() {
      global $config;
      
      $db = new DB();
      
      if($db->connected()) {
        $page = params("page") != null ? intval(params("page")) : 0;
        
        $rows = 3;
        $limit = $rows * 2;
        $start = $page * $limit;
        
        // TODO: Accept custom queries
        $query = sprintf("SELECT SQL_CALC_FOUND_ROWS `id`, `name`, `info` FROM `maps` ORDER BY `added` DESC LIMIT %s, %s",
          $db->escape_string($start),
          $db->escape_string($limit)
        );
        $result = $db->query($query);
        
        $maps = Array();
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
            array_push($maps, Array(
              "id" => $row["id"],
              "name" => $row["name"],
              "info" => Parsedown::instance()->parse($row['info'])
            ));
          }
        }
        
        set('title', $config['site_name'] . " - Projects");
        set("maps", $maps);
        set('active', "projects");
        set('pages', $pages);
        return render("main/maps.php", "main.layout.php");
      } else {
        halt(SERVER_ERROR, "Database not connected");
      }
    }
    
    public function id() {
      global $config;
      
      $id = params("id");
      $db = new DB();
      
      if($db->connected()) {
        $query = sprintf("SELECT `name`, `info`, `added`, `by` FROM `maps` WHERE `id` = '%s'", 
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
            
            $map = Array(
              "name" => $row["name"],
              "info" => Parsedown::instance()->parse($row['info']),
              "added" => $date->format('l jS M Y'),
              "by" => $by_name
            );
          }
        }
        
        set('title', $config['site_name'] . ($map["name"] ? $map["name"] : "Unknown Map"));
        set("map", $map);
        set('active', "maps");
        return render("main/map.php", "main.layout.php");
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