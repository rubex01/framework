<?php
  $variables = [
      //Application name
      'APP_NAME' => 'Framework',

      //Default MySQL database credentials
      'DB_HOST' => 'localhost',
      'DB_USERNAME' => 'root',
      'DB_PASSWORD' => '',
      'DB_NAME' => 'example',
      
  ];

  foreach ($variables as $key => $value) {
      putenv("$key=$value");
  }
