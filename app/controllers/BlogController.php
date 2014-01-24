<?php
  class BlogController extends \BaseController {
    public function index() {
      global $config;
      
      $db = new DB();
      $page = params("page") != null ? intval(params("page")) : 0;
      
      $limit = 3;
      $start = $page * $limit; 
      
      $posts = Array();
      $pages = Array(
        "previous" => null,
        "next" => null
      );
      
      if($db->connected()) {
        $query = sprintf("SELECT SQL_CALC_FOUND_ROWS `id`, `title`, `content`, `added`, `by` FROM `blog` ORDER BY `added` DESC LIMIT %s, %s",
          $db->escape_string($start),
          $db->escape_string($limit)
        );
        $result = $db->query($query);
        
        if($result != null) {
          // Calculate how many more posts there are
          $rem_result = $db->query("SELECT FOUND_ROWS() AS `rem`");
          
          if($rem_result != null) {
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
            $date = new DateTime($row["added"]);
            $by_name = "Deleted User";
            
            // Find out the user's full name
            $user_query = sprintf("SELECT `full` FROM `users` WHERE `id` = '%s'",
              $db->escape_string($row["by"])
            );
            $user_result = $db->query($user_query);
            
            if($user_result != null) {
              while($user_row = $user_result->fetch_assoc()) {
                $by_name = $user_row["full"];
              }
            }
            
            array_push($posts, Array(
              "id" => $row["id"],
              "title" => $row["title"],
              "content" => Parsedown::instance()->parse($row['content']),
              "added" => $date->format('l jS M Y'),
              "by" => $by_name
            ));
          }
        }
      }
      
      set('posts', $posts);
      set('pages', $pages);
      set('title', $config['site_name'] . " - Blog");
      set('active', "blog");
      return render("main/blog.php", "main.layout.php");
    }
    
    public function article() {
      global $config;
      
      $db = new DB();
      $id = params("id");
      
      $post = null;
      
      if($db->connected() && $id != null) {
        $query = sprintf("SELECT `title`, `content`, `added`, `by` FROM `blog` WHERE `id` = '%s'",
          $db->escape_string($id)
        );
        $result = $db->query($query);
        
        if($result != null) {
          while($row = $result->fetch_assoc()) {
            $date = new DateTime($row["added"]);
            $by_name = "Deleted User";
            
            // Find out the user's full name
            $user_query = sprintf("SELECT `full` FROM `users` WHERE `id` = '%s'",
              $db->escape_string($row["by"])
            );
            $user_result = $db->query($user_query);
            
            if($user_result != null) {
              while($user_row = $user_result->fetch_assoc()) {
                $by_name = $user_row["full"];
              }
            }
            
            $post = Array(
              "title" => $row["title"],
              "content" => Parsedown::instance()->parse($row['content']),
              "added" => $date->format('l jS M Y'),
              "by" => $by_name
            );
          }
        }
      }
      
      set("post", $post);
      set("title", $config['site_name'] . " - " . ($post["title"] ? $post["title"] : "Unknown Page"));
      set('active', "blog");
      return render("main/article.php", "main.layout.php");
    }
  }

?>