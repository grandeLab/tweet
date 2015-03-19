<?php
  require_once __DIR__ . '/../app/app.php';
  $tweet = new Tweet();
  $tweetsCollection = $tweet->queryAll();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Latest tweets</title>
  <link type="text/css" rel="stylesheet" href="css/main.css"/>
</head>
<body>
  <section class="main-container">
    <?php
    foreach($tweetsCollection as $tweet)
    {
    ?>
      <article class="tweet-container">
        <header class="tweet-header">
          Tweet <?= $tweet['id_str'] ?> written by user <?= $tweet['user'] ?> at <?= $tweet['created_at'] ?>
        </header>
        <p class="tweet-body">
          <?= $tweet['text'] ?>
        </p>
        <footer class="tweet-footer">
          Retweeted <?= $twitter['retweet_count'] ? $twitter['retweet_count'] : 0 ?> times
        </footer>
      </article>
    <?php
    }
    ?>
  </section
</body>
</html>
