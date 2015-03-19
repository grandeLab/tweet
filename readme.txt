Configure

In the folder app/config are the mandatory config files for the database(db_config.php) and the twitter account(twitter_config.php)

By running the file configure.php located in the root of the repo you will be asked for every mandatory parameter for the app:
php configure.php

Run the app

Once configured, to collect the tweets with hashtag empire for example just run:
php start.php empire

In the folder www is the index.php file which will show you the collected tweets in a simple html structure.

I've already added all the dependencies with composer and added to the repo so you don't have to run composer, as well as compiled the sass.
