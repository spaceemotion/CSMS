<?php
  class UsersController extends Admin\BaseController {
    public function index() {
      $login = Admin::check_login();
      
      if($login != false) {
        $db = new DB();
        $page = params("page");
        
        $users = Array();
        $pages = Array(
          "next" => null,
          "previous" => null
        );
        
        $page = params("page") != null ? intval(params("page")) : 0;
         
        $limit = 20;
        $start = $page * $limit;
        
        if($db->connected()) {
          $query = sprintf("SELECT SQL_CALC_FOUND_ROWS `id`, `name`, `full` FROM `users` ORDER BY `id` DESC LIMIT %s, %s",
            $db->escape_string($start),
            $db->escape_string($limit)
          );
          $result = $db->query($query);
          
          if($result != null) {
            while($row = $result->fetch_assoc()) {
              array_push($users, Array(
                "id" => $row["id"],
                "name" => $row["name"],
                "full" => $row["full"]
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
        
        set("users", $users);
        set("login", $login);
        set("pages", $pages);
        set('active', "users");
        set("title", "Admin - Users");
        return render("admin/users.php", "admin.layout.php");
      } else {
        return redirect_to("/admin");
      }
    }
    
    public function create() {
      $login = Admin::check_login();
      
      if($login != null) {
        $created = false;
        $db = new DB();
        
        if(isset($_POST['user']) && isset($_POST['full']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass_confirm']) && $db->connected()) {
          $user = $_POST['user'];
          $full = $_POST['full'];
          $email = $_POST['email'];
          $pass = $_POST['pass'];
          $pass_confirm = $_POST['pass_confirm'];
          
          if($pass == $pass_confirm && strlen($pass) > 0 && Admin::check_email($email)) {
            $check_query = sprintf("SELECT `id` FROM `users` WHERE LOWER(`name`) = '%s' OR `email` = '%s'",
              $db->escape_string(strtolower($user)),
              $db->escape_string($email)
            );
            $check_result = $db->query($check_query);
            
            if($check_result != null) {
              if($check_result->num_rows == 0) {
                $insert_query = sprintf("INSERT INTO `users` (`name`, `full`, `email`, `pass`, `admin`) VALUES ('%s', '%s', '%s', '%s', 0)",
                  $db->escape_string($user),
                  $db->escape_string($full),
                  $db->escape_string($email),
                  $db->escape_string(Admin::encrypt_password($pass))
                );
                $insert_result = $db->query($insert_query);
                
                if($insert_result != false) {
                  $created = true;
                }
              }
            }
          }
        }
        
        return redirect_to("/admin/users", Array("created" => $created ? "true" : "false"));
      } else {
        return redirect_to("/admin");
      }
    }
    
    public function create_page() {
      $login = Admin::check_login();
      
      if($login != null) {
        set('title', "Admin - New User");
        set('login', $login);
        set('active', "users");
        return render("admin/user_new.php", "admin.layout.php");
      } else {
        return redirect_to("/admin");
      }
    }
    
    public function update() {
      $login = Admin::check_login();
      $db = new DB();
      
      $updates = Array();
      $updated = false;
      
      if(isset($_POST['name']) && isset($_POST['full']) && isset($_POST['email']) && $db->connected()) {
        $names = $_POST['name'];
        $fulls = $_POST['full'];
        $emails = $_POST['email'];
        $passes = isset($_POST['pass']) ? $_POST['pass'] : Array();
        $pass_confirm = isset($_POST['pass_confirm']) ? $_POST['pass_confirm']: Array();
        
        $users = Array();
        
        // Work through each peice of information
        // foreach($names as $key => $name) {
        //   array_push($users, Array(
        //     "id" => $key,
        //     "name" => $name,
        //     "email" => null,
        //     "pass" => null,
        //     "confirm" => null
        //   ));
        // }
        
        
        if(sizeof($names) == sizeof($fulls)) {
          foreach($names as $key => $name) {
            $full = $fulls[$key];
            
            $query = sprintf("UPDATE `users` SET `name` = '%s', `full` = '%s' WHERE `id` = '%s'",
              $db->escape_string($name),
              $db->escape_string($full),
              $db->escape_string($key)
            );
            $result = $db->query($query);
            
            if($result != null) {
              array_push($updates, true);
            } else {
              array_push($updates, false);
            }
          }
        }
      }
      
      // Check that the users have been updated
      $update_work = 0;
      foreach($updates as $update) {
        if($update == true) 
          $update_work++;
      }
      
      if($update_work == sizeof($updates) && sizeof($updates) > 0)
        $updated = true;
      
      return redirect_to("/admin/users", Array("updated" => $updated ? "true": "false"));
    }
    
    public function edit() {
      $login = Admin::check_login();
      
      if($login != null) {
        $db = new DB();
        
        if(isset($_POST["user"]) && $db->connected()) {
          $users = Array();
          
          foreach($_POST["user"] as $user) {
            $query = sprintf("SELECT `name`, `full`, `email` FROM `users` WHERE `id` = '%s'",
              $db->escape_string($user)
            );
            $result = $db->query($query);
            
            if($result != null) {
              while($row = $result->fetch_assoc()) {
                array_push($users, Array(
                  "id" => $user,
                  "name" => $row["name"],
                  "full" => $row["full"],
                  "email" => $row["email"]
                ));
              }
              
              $result->free();
            }
          }
          
          set('title', "Admin - Edit Users");
          set('login', $login);
          set('users', $users);
          set('active', "users");
          return render("admin/user_edit.php", "admin.layout.php");
        } else {
          return redirect_to("/admin/users/new");
        }
      } else {
        return redirect_to("/admin", Array("login" => "false"));  
      }
    }
    
    public function remove() {
      $login = Admin::check_login();
      
      if($login != null) {
        $db = new DB();
        $deleted = false;
        
        if(isset($_POST['user']) && $db->connected()) {
          $user_post = $_POST['user'];
          
          foreach($user_post as $user_one) {
            $user = is_numeric($user_one) ? intval($user_one) : false;
            
            if($user != false) {
              $check_result = $db->query("SELECT COUNT(*) AS `user_count` FROM `users`");
              
              if($check_result != null) {
                while($check_row = $check_result->fetch_assoc()) {
                  if(intval($row["user_count"]) > 1) {
                    $query = sprintf("DELETE FROM `users` WHERE `id` = '%s'",
                      $db->escape_string($user)
                    );
                    $result = $db->query($query);
                    
                    if($result != null) {
                      $deleted = true;
                      //$result->free();
                    }
                  }
                }
              }
            }
          }
        }
        
        return redirect_to("/admin/users", Array("deleted" => $deleted ? "true": "false"));
      } else {
        return redirect_to("/admin");
      }
    }
  }
?>