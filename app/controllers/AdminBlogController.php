<?php 
  class AdminBlogController extends AdminBaseController {
     /* Blog Posts */
    public function index() {
      $login = Admin::check_login();
      
      if($login) {
        $results = DB::select('select * from users where id = ?', array(1));
        
        
        $posts = Array();
        $pages = Array(
          "next" => null,
          "previous" => null
        );
        
        $limit = 3;
        
        $page = params("page") != null ? intval(params("page")) : 0;
        $start = $page * $limit; // Add in code to display more blog posts
        
        if($db->connected()) {
          $query = sprintf("SELECT SQL_CALC_FOUND_ROWS `id`, `title`, `info` FROM `blog` ORDER BY `id` DESC LIMIT %s, %s",
            $db->escape_string($start),
            $db->escape_string($limit)
          );
          $result = $db->query($query);
          
          if($result != false) {
            while($row = $result->fetch_assoc()) {
              array_push($posts, Array(
                "id" => $row['id'],
                "title" => $row['title'],
                "info" => Parsedown::instance()->parse($row['info'])
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
        set('posts', $posts);
        set('pages', $pages);
        set('active', "blog");
        set('title', "Admin - Blog");
        return render("/admin/blog.php", "admin.layout.php");
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
        
        if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["posted"]) && $db->connected()) {
          $title = $_POST["title"];
          $content = $_POST["content"];
          $posted = $_POST["posted"];
          $info = $content; // Add code that will shorten the content
          
          $query = "";
          
          if($id != null) {
            $query = sprintf("UPDATE `blog` SET `title` = '%s', `info` = '%s', `content` = '%s', `posted` = '%s' WHERE `id` = '%s'",
              $db->escape_string($title),
              $db->escape_string($info),
              $db->escape_string($content),
              $db->escape_string($posted),
              $db->escape_string($id)
            );
          } else {
            $query = sprintf("INSERT INTO `blog` (`title`, `info`, `content`, `added`, `by`) VALUES ('%s', '%s', '%s', '%s', '%s')",
              $db->escape_string($title), // Add in code to escape string
              $db->escape_string($info),
              $db->escape_string($content),
              $db->escape_string($posted),
              $db->escape_string($login["id"])
            );
          }
          
          $result = $db->query($query);
          
          if($result != null) {
            $posted = true;
          }
        }
        
        return redirect_to("/admin/blog", Array("posted" => $posted ? "true" : "false"));
      } else {
        return redirect_to("/admin");
      }
    }
    
    public function edit() {
      $login = Admin::check_login();
      
      if($login != null) {
        $db = new DB();
        $id = params("id");
        
        $post = null;
        
        if($id != null && $id != "new") {
          if($db->connected()) {
            $query = sprintf("SELECT `id`, `title`, `content`, `added` FROM `blog` WHERE `id` = '%s'",
              $db->escape_string($id)
            );
            $result = $db->query($query);
            
            if($result != false) {
              while($row = $result->fetch_assoc()) {
                $date = new DateTime($row['added']);
                
                $post = Array(
                  "id" => $row['id'],
                  "title" => $row['title'],
                  "content" => $row['content'],
                  "added" => $date->format('Y-m-d')
                );
              }
            }
          } 
        } elseif($id == "new") {
          $post = Array(
            "id" => "",
            "title" => "",
            "content" => "",
            "added" => date("Y-m-d")
          );
        }
        
        if($post != null) {
          set('login', $login);
          set('post', $post);
          set('title', "Admin - Edit Post");
          set('active', "blog");
          return render("admin/blog_edit.php", "admin.layout.php");
        } else {
          return redirect_to("/admin/blog", Array("exists" => false));
        }
      } else {
        return redirect_to("/admin");
      }
    }
    
    public function remove() {
      if(Admin::check_login()) {
        $deleted = false;
        $db = new DB();
        $id = params("id");
        
        if($id != null && $db->connected()) {
          $query = sprintf("DELETE FROM `blog` WHERE `id` = '%s'",
           $db->escape_string($id)
          );
          $result = $db->query($query);
          
          if($result != false) {
            $deleted = true;
          }
        }
        
        return redirect_to("/admin/blog", Array("deleted" => $deleted));
      } else {
        return redirect_to("/admin");
      }
    }
  }
?>