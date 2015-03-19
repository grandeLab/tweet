<?php

require_once __DIR__ . '/config/config.php';

if(!defined('DB_HOST'))
{
  throw new Exception('Your DB_HOST is not configured');
}

if(!defined('DB_NAME'))
{
  throw new Exception('Your DB_NAME is not configured');
}

if(!defined('DB_USERNAME'))
{
  throw new Exception('Your DB_USERNAME is not configured');
}

if(!defined('DB_PASSWORD'))
{
  throw new Exception('Your DB_PASSWORD is not configured');
}

if(!defined('CONSUMER_KEY'))
{
  throw new Exception('Your CONSUMER_KEY is not configured');
}

if(!defined('CONSUMER_SECRET'))
{
  throw new Exception('Your CONSUMER_SECRET is not configured');
}

if(!defined('ACCESS_TOKEN'))
{
  throw new Exception('Your ACCESS_TOKEN is not configured');
}

if(!defined('ACCESS_TOKEN_SECRET'))
{
  throw new Exception('Your ACCESS_TOKEN_SECRET is not configured');
}
