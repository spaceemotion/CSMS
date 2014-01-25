<?php namespace Admin;

class AdminController extends BaseController {

  public function index() {
    $db = new DB();
    $login = User::check_login();
    $stats = null;
    $error = false;

    if($login != false && $db->connected() && $login['admin'] == true) {
      $result = $db->query("SELECT COUNT(*) AS `count` FROM `blog` WHERE `added` > DATE_SUB(NOW(), INTERVAL 7 DAY)");
      $posts = 0;

      // Include other stats from the site

      if($result != false) {
        while($row = $result->fetch_assoc()) {
          $posts = $row["count"];
        }
      }

      $stats = Array(
        "posts" => $posts
      );
    } else if(isset($_GET['login'])) {
      if($_GET['login'] == "false") {
        $error = true;
      }
    }

    set("login", $login);
    set("stats", $stats);
    set("error", $error);
    set("title", "Admin");
    set('active', "index");
    return render($login ? "admin/index.php" : "admin/login.php", "admin.layout.php");
  }

}