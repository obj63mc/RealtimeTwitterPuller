<?php

require_once 'inc/config.inc.php';

// Catches realtime updates from Instagram
if ($_SERVER['REQUEST_METHOD']==='POST') {

    // Instantiates Pusher PHP API
    require 'lib/Pusher.php';

    // Retrieves the POST data from Instagram
    
    $tweets = json_decode($_POST['updates'], true);
    
    // If one or more photos has been posted, notify all clients
    if (is_array($tweets) && ($length=count($tweets))>0) {
        $pusher = new Pusher($pusher_key, $pusher_secret, $pusher_app_id);
        $pusher->trigger(
            'tweets', 
            'new-tweet', 
            array(
                'newcount' => $length,
                'tweets' => $_POST['updates']
            )
        );
    }

}

?>
<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/master.css" />
<link rel="shortcut icon" href="/favicon.ico" />

<title>Realtime Twitter Puller &mdash; Setup at Future Insights Live</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Domain.com</a>
          <ul class="nav">
              <li class="active"><a href="#">Home</a></li>              
           </ul>
        </div>
      </div>
    </div>
<div style="clear:both;"></div>
<div class="container mainblock">


    <header>
        <h1>Live Tweets</h1>
    </header>

    <article>

        <ul id="tweets">
            <li class="loading">Loading&hellip;</li>
        </ul><!--/#photos-->

    </article>




</div>
<footer>
    <p>Brought to you by your truly, <a href="http://twitter.com/madden_joe" target="_blank">Joe</a> and <a href="http://twitter.com/sirmixaloud" target="_blank">Mirsad</a>.</p>
</footer>
<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="//js.pusher.com/2.0/pusher.min.js"></script>
<script>

    // Enables pusher logging - don't include this in production
    Pusher.log = function(message) {
        if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;

    // Initializes Pusher (done inline to use PHP for config variables)
    var pusher   = new Pusher('<?=$pusher_key?>'),
        channel  = pusher.subscribe('tweets'),
        tag      = '<?=$tag?>'; // For PHP-powered tag selection

</script>
<script src="js/twitter.js"></script>

</body>

</html>
