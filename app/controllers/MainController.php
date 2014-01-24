<?php
  class MainController extends \BaseController {
    public function index() {
      $this->layout->title = "Catacomb Snatch";
      $this->layout->active = "index";
      $this->layout->login = false;
      $this->layout->content = View::make('main.index');
    }
    
    public function game() {
      global $config;
      
      $this->layout->title = "Catacomb Snatch - Game";
      $this->layout->active =  "game";
      $this->layout->content = View::make('main.game');
    }
    
    public function download() {
      global $config;
      
    }
  }
?>