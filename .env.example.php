<?php
  $variables = [
      'APP_NAME' => 'Framework',
      'DB_HOST' => 'localhost',
      'DB_USERNAME' => 'root',
      'DB_PASSWORD' => '',
      'DB_NAME' => 'webshop_example'
  ];

  foreach ($variables as $key => $value) {
      putenv("$key=$value");
  }
