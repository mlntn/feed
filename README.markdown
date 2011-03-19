RSS feed parser with aggregator
===============================

Example usage
-------------

`$aggregator = new AggregatorFeed();`
`$lifestream = $aggregator`
`	->addFeed(new FacebookFeed(FACEBOOK_USER_ID, FACEBOOK_SECRET_KEY, FACEBOOK_USER_NAME))`
`	->addFeed(new TwitterFeed(TWITTER_USER_NAME))`
`	->get(8);`

OR

`$twitter = new TwitterFeed('username');`
`$tweets = $twitter->get();`