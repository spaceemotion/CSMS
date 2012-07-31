<?php

	require './server/MasterServer.php';
	
	$server = new MasterServer();
	while( $server->isRunning() )
		$server->listen();

	unset($server);

?>
