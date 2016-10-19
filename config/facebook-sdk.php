<?php

return [

	'facebook_config' => [
        'app_id' => env('FACEBOOK_APP_ID'),
        'app_secret' => env('FACEBOOK_APP_SECRET'),
        'default_graph_version' =>  'v2.8',
        'persistent_data_handler'=> 'session'
	]
	
];