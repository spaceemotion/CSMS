<?php 
  class AdminServersController extends AdminBaseController {
     /* Blog Posts */
    public function index() {
      $login = Admin::check_login();
      
      if($login != false) {
        $db = new DB();
        $projects = Array();
        $pages = Array(
          "next" => null,
          "previous" => null
        );
        
        $page = params("page") != null ? intval(params("page")) : 0;
         
        $limit = 3;
        $start = $page * $limit;
        
        if($db->connected()) {
          $query = sprintf("SELECT SQL_CALC_FOUND_ROWS `id`, `name`, `info` FROM `projects` ORDER BY `added` DESC LIMIT %s, %s",
            $db->escape_string($start),
            $db->escape_string($limit)
          );
          $result = $db->query($query);
          
          if($result != false) {
            while($row = $result->fetch_assoc()) {
              array_push($projects, Array(
                "id" => $row['id'],
                "name" => $row['name'],
                "info" => $row['info']
              ));
            }
            
            $rem_result = $db->query("SELECT FOUND_ROWS() AS `rem`");
            
            if($rem_result != false) {
              while($rem_row = $rem_result->fetch_assoc()) {
                $rem = intval($rem_row["rem"]);
                // Make it more intelligent by asking for more info in query
                
                if($rem > 0 && $page > 0) {
                  $pages["previous"] = $page - 1;
                }
                
                if($rem > ($start + $limit)) {
                  $pages["next"] = $page + 1;
                }
              }
            }
          }
        }
        
        set('login', $login);
        set('projects', $projects);
        set('pages', $pages);
        set('title', "Admin - Projects");
        set('active', "projects");
        return render("/admin/projects.php", "admin.layout.php");
      } else {
        return redirect_to("/admin");
      }
    }
    
    public function post() {
      $login = Admin::check_login();
      
      if($login != false) {
        $db = new DB();
        $id = params("id");
        
        $posted = false;
        
        if(isset($_POST["name"]) && isset($_POST["content"]) && isset($_POST["added"]) && $db->connected()) {
          $name = $_POST["name"];
          $content = $_POST["content"];
          $added = $_POST["added"];
          $info = $content; // Add code that will shorten the content
          
          $query = "";
          
          if($id != null) {
            $query = sprintf("UPDATE `projects` SET `name` = '%s', `info` = '%s', `content` = '%s', `added` = '%s' WHERE `id` = '%s'",
              $db->escape_string($name),
              $db->escape_string($info),
              $db->escape_string($content),
              $db->escape_string($added),
              $db->escape_string($id)
            );
          } else {
            $query = sprintf("INSERT INTO `projects` (`name`, `info`, `content`, `added`, `by`) VALUES ('%s', '%s', '%s', '%s', '%s')",
              $db->escape_string($name),
              $db->escape_string($info),
              $db->escape_string($content),
              $db->escape_string($added),
              $db->escape_string($login["id"])
            );
          }
          
          $result = $db->query($query);
          
          if($result != false) {
            $posted = true;
          }
        }
        
        return redirect_to("/admin/projects", Array("posted" => $posted ? "true" : "false"));
      } else {
        return redirect_to("/admin");
      }
    }
    
    public function edit() {
      $login = Admin::check_login();
      
      if($login != false) {
        $db = new DB();
        $id = params("id");
        
        $project = null;
        
        if($id != null && $id != "new") {
          if($db->connected()) {
            $query = sprintf("SELECT `id`, `name`, `info`, `added` FROM `projects` WHERE `id` = '%s'",
              $db->escape_string($id)
            );
            $result = $db->query($query);
            
            if($result != false) {
              while($row = $result->fetch_assoc()) {
                $date = new DateTime($row["added"]);
                
                $project = Array(
                  "id" => $row['id'],
                  "name" => $row['name'],
                  "info" => $row['info'],
                  "added" => $date->format('Y-m-d')
                );
              }
            }
          }
        } elseif($id == "new") {
          $project = Array(
            "id" => "",
            "name" => "",
            "info" => "",
            "added" => date('Y-m-d')
          );
        }
        
        if($project != null) {
          set('login', $login);
          set('project', $project);
          set('active', "projects");
          set('title', "Admin - Edit Projects");
          return render("admin/projects_edit.php", "admin.layout.php");
        } else {
          return redirect_to("/admin/projects", Array("exists" => false));
        }
      } else {
        return redirect_to("/admin");
      }
    }
    
    public function remove() {
      $login = Admin::check_login();
      
      if($login != false) {
        $deleted = false;
        $db = new DB();
        $id = params("id");
        
        if($id != null && $db->connected()) {
          $query = sprintf("DELETE FROM `projects` WHERE `id` = '%s'",
            $db->escape_string($id)
          );
          $result = $db->query($query);
          
          if($result != false) {
            $deleted = true;
          }
        }
        
        return redirect_to("/admin/projects", Array("deleted" => $deleted));
      } else {
        return redirect_to("/admin");
      }
    }
  }
?>