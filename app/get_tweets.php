<?php

try
{
  if(count($argv) < 2 || !$argv[1])
  {
    throw new Exception("You must specify a hashtag, for example:\n php start empire");
  }

  require_once __DIR__ . '/app.php';
  require_once __DIR__ . '/configCheck.php';


  $hashtagArg = $argv[1];

  echo "Requesting tweets...\n";

  $hashTagRequestor = new HashTagRequestor(ACCESS_TOKEN, ACCESS_TOKEN_SECRET, CONSUMER_KEY, CONSUMER_SECRET);

  $hashtag = new Hashtag($hashtagArg);
  $hashtag->save();
  $tweetsCollection = json_decode($hashTagRequestor->buildOauth($hashtag->getHashTag())->request());

  echo "Saving tweets...\n";

  $tweets = [];


  foreach($tweetsCollection->statuses as $tweet)
  {
    $tweetObject = new Tweet($tweet->created_at, $tweet->id_str, $tweet->retweet_count, $tweet->user->id_str, $tweet->text, $hashtag->id);
    $tweetObject->save();
    $tweets[] = $tweetObject;
  }

  echo "Tweets saved...\n";
}
catch(Exception $e)
{
  echo $e->getMessage();
  echo "\nScript terminated...\n";
  die();
}
