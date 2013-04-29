
(function($, window, undefined) {
    channel.bind('new-tweet', function(data){

        var tweets = $.parseJSON(data.tweets);
        var tweetcontainer = $('#tweets');
        tweetcontainer.find('.loading').hide(400).delay(400).remove();
        if(tweets.length > 1){            
            for(var x in tweets){
                console.log(x);
                var li = "<li>" + x.text + " by: " + x.user.screen_name + "</li>";
                tweetcontainer.prepend(li);
            }
        } else {
            var li = "<li>" + tweets.text + " by: "+ tweets.user.screen_name +"</li>";
            tweetcontainer.prepend(li);
        }
        
    });
})(jQuery, window);