<?php

class BaseController extends Controller {

  /**
   * The main layout for controllers extending
   */
  protected $layout = 'layouts.main';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
  
  /**
   * Check if a user is logged in
   *
   * @return array
   * @author Luke Fisher
   **/
  public function checkLogin() {
    $login = false;
    
    if(isset($_COOKIE["user_key"]) && isset($_COOKIE["user_auth"])) {
      $key = $_COOKIE["user_key"];
      $auth = $_COOKIE["user_auth"];
      
      $result = DB::select("SELECT `user` FROM `sessions` WHERE (`key` = '?' AND `auth` = '?')", array($key, $auth));
      
      if($result != null) {
        while($row = $result->fetch_assoc()) {
          $user_id = $row["user"];
          
          $user_result = DB::select("SELECT `name`, `full`, `admin` FROM `users` WHERE `id` = '?'", array($user_id));
          
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

}