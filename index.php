<?php

	// Defines
	define(APATH, __DIR__);


	// Requires
	require APATH.'server/MasterServer.php';


	$server = new MasterServer();
	while( $server->isRunning() )
		$server->listen();

	unset($server);

?>
