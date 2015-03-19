<?php

require_once __DIR__ . '/app/config/db_config.php';

function promptUser($value) {
  return 'Tell me your ' . $value .' [' . (defined($value) ? constant($value) : '') .'] ';
}

function dbConfigTemplate($dbHost, $dbUsername, $dbPassword)
{
  $dbConfig = "<?php\n";
  $dbConfig .= "if(!defined('DB_HOST')) define('DB_HOST', '$dbHost');\n";
  $dbConfig .= "if(!defined('DB_NAME')) define('DB_NAME', 'tweet');\n";
  $dbConfig .= "if(!defined('DB_USERNAME')) define('DB_USERNAME', '$dbUsername');\n";
  $dbConfig .= "if(!defined('DB_PASSWORD')) define('DB_PASSWORD', '$dbPassword');";
  return $dbConfig;
}

try
{

  $dbHost = readline(promptUser('DB_HOST'));
  $dbUsername = readline(promptUser('DB_USERNAME'));
  $dbPassword = readline(promptUser('DB_PASSWORD'));

  $dbHost = $dbHost ? $dbHost : constant('DB_HOST');
  $dbUsername = $dbUsername ? $dbUsername : constant('DB_USERNAME');
  $dbPassword = $dbPassword ? $dbPassword : constant('DB_PASSWORD');

  $fh = fopen(__DIR__ . '/app/config/db_config.php', 'w+');
  fwrite($fh, dbConfigTemplate($dbHost, $dbUsername, $dbPassword));
  fclose($fh);

  echo "You have succesfully configure the app :)\n";
  echo "Now to check for tweets with the hashtag empire for example, run in your terminal:\n";
  echo "php start.php empire\n";
}
catch(Exception $e)
{
  echo $e->getMessage();
  echo "\nScript terminated...\n";
  die();
}
