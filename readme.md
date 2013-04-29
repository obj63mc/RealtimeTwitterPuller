This is a demo app created at FI Live to track their tweets during the real time web apps workshop by Jason Lengstorf

To setup simply pull all code.

1. in /inc/config.inc.php setup all variables with your configuration values -
	$tag is the hash tag you want to track
	$pusher_key, _secret and _app_id are from your pusher.com account
	$twitter_username and _password are the username and password that you want to use to connect and pull from twitter
	$yourappdomain is the domain that your application lives on ex. "http://filive.moosedigital.com/"
	
2. In /lib/OauthPhirehose.php setup your twitter app consumer key and secret

3. Once deployed to your server run filter_track.php via command line such as - 
	>php filter_track.php
	
	This will need to stay open and is essentially a server constantly waiting for twitter to send data
	
4. Simply load the web application in the browser and your app will now be pulling in tweets real time.