<?php
  class WebMainController extends WebBaseController {
    public function index() {
      global $config;
      
      set('title', $config['site_name']);
      set('active', "index");
      return render("main/index.php", "main.layout.php");
    }
    
    public function game() {
      global $config;
      
      set('title', $config['site_name'] . " - Game");
      set('active', "game");
      return render("main/game.php", "main.layout.php");
    }
    
    public function download() {
      global $config;
      
    }
  }
?>