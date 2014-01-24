<?php
class WebServerController extends WebBaseController {
  
  public function index() {
    global $config;
    
    $db = new DB();
    $collecion = $db->getCollection('server');
    
    $collection->select
    
    // Sort out results
    $servers = Array();
    
    set('title', $config['site_name'] . ' - Servers');
    set('active', "servers");
    set('servers', $servers);
    return render('main/servers.php', 'main.layout.php');
  }
  
}
?>