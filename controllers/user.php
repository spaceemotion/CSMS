<?php
class User {
  
  public function index() {
    $id = params('id');
    $db = new DB();
    
    $login = self::check_login();
    
    if($db->connected() ) {
      
    } else {
      halt(SERVER_ERROR, "Database not connected");
    }
  }
  
  public function login_page() {
    global $config;
    
    set('title', $config['site_name'] . " - Login");
    set('active', "login");
    return render('main/login.php', 'main.layout.php');
  }
  
  public function logout() {
    $db = new DB();
    
    if($db->connected() && isset($_COOKIE["id"])) {
      $query= sprintf("DELETE FROM `sessions` WHERE `key` = '%s'",
        $_COOKIE["user_key"]
      );
      $result = $db->query($query);
      
      if($result != null) {
        // We don't have to care if it removed the session, they are logged out client side
        // But really we should
      }
    }
    
    setcookie("user_key", "", time() - 3600, "/");
    setcookie("user_auth", "", time() - 3600, "/");
    return redirect_to('/');
  }
  
  public function login() {
    $db = new DB();
    $login = false;
    $admin = false;
    
    if(isset($_POST["user"]) && isset($_POST["pass"]) && $db->connected()) {
      $user = $_POST["user"];
      $pass = $_POST["pass"];
      
      $keep = isset($_POST["keep"]) && $_POST["keep"] == "true" ? true : false;
      
      $query = sprintf("SELECT `id`, `admin` FROM `users` WHERE (`name` = '%s' AND `pass` = '%s')",
        $db->escape_string($user),
        $db->escape_string(self::encrypt_password($pass))
      );
      $result = $db->query($query);
      
      if($result != null) {
        while($row = $result->fetch_assoc()) {
          $user_id = $row["id"];
          $admin = ($row_["id"] == 1);
          
          $rand_key = rand();
          $rand_auth = rand();
          
          $session_query = sprintf("INSERT INTO `sessions` (`key`, `auth`, `user`) VALUES ('%s', '%s', '%s')",
            $db->escape_string($rand_key),
            $db->escape_string($rand_auth),
            $db->escape_string($user_id)
          );
          $session_result = $db->query($session_query);
          
          if($session_result != null) {
            setcookie("user_key", $rand_id, $keep ? null : time() + 3600, "/");
            setcookie("user_auth", $rand_key, $keep ? null : time() + 3600, "/");
            $login = true;
          }
        }
      }
    }
    
    return redirect_to($admin ? '/admin' : ($login ? '/' : '/user/login'), $login ? null : Array("login" => "false"));
  }
  
  // Here are some functions that can really be used in a seperate library
  public function check_login() { 
    $db = new DB();
    
    $login = false;
    
    if($db->connected() && isset($_COOKIE["user_key"]) && isset($_COOKIE["user_auth"])) {
      $key = $_COOKIE["user_key"];
      $auth = $_COOKIE["user_auth"];
      
      $query = sprintf("SELECT `user` FROM `sessions` WHERE (`key` = '%s' AND `auth` = '%s')", 
        $db->escape_string($key),
        $db->escape_string($auth)
      );
      $result = $db->query($query);
      
      if($result != null) {
        while($row = $result->fetch_assoc()) {
          $user_id = $row["user"];
          
          $user_query = sprintf("SELECT `name`, `full`, `admin` FROM `users` WHERE `id` = '%s'",
            $db->escape_string($user_id)
          );
          $user_result = $db->query($user_query);
          
          if($user_result != null) {
            // TODO: Add in login check
            while($row = $user_result->fetch_assoc()) {
              
              $login = Array(
                "id" => $user_id,
                "name" => $row["name"],
                "full" => $row["full"],
                "admin" => $row["admin"]
              );
            }
          }
        }
      }
    }
    
    return $login;
  }
  
  // Taken from (http://www.linuxjournal.com/article/9585?page=0,3)
  public function check_email($email) {
    $isValid = true;
    $atIndex = strrpos($email, "@");
    if (is_bool($atIndex) && !$atIndex) {
      $isValid = false;
    } else {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      
      if ($localLen < 1 || $localLen > 64){
        // local part length exceeded
        $isValid = false;
      } else if ($domainLen < 1 || $domainLen > 255) {
        // domain part length exceeded
        $isValid = false;
      } else if ($local[0] == '.' || $local[$localLen-1] == '.') {
        // local part starts or ends with '.'
        $isValid = false;
      } else if (preg_match('/\\.\\./', $local)) {
        // local part has two consecutive dots
        $isValid = false;
      } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
        // character not valid in domain part
        $isValid = false;
      } else if (preg_match('/\\.\\./', $domain)) {
        // domain part has two consecutive dots
        $isValid = false;
      }  else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) {
        // character not valid in local part unless 
        // local part is quoted
        if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))) {
          $isValid = false;
        }
      }
    }
    return $isValid;
  }
  
  public function encrypt_password($pass) {
    return crypt($pass, '$2a$07$22cHaRaCtErS4OnEpLeAsE$');
  }
  
}
?>