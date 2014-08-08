$(document).ready(function() {

  console.log('bike');

  //var labelHtml = '<span class="label" style="float: left; margin-right: 6px; ' +
    //'top: 6px; text-transform: uppercase">' + group + 
    //'</span>' + 
    //'<h4 style="color: #999; text-transform: uppercase;">' + filter + 
    //' tweets <small class="dates">' + $('#start').val() +
    //' &ndash; ' + $('#end').val() + '</small></h4>';

  $('#search-terms').click(function(evt) {

    var terms = $('#terms').val();

    $.ajax({
      type: 'POST',
      url: '/tweets/search/circle',
      data: {
        //start: $('#start').val(),
        //end: $('#end').val(),
        terms: terms,
      },
      success: function(response) {
        console.log(response);
    
        $('.content').html('');

        response.forEach(function(d, i) {
          $('.content').append(formatTweet(d));
        });
      }
    });

  });

  /*
   * Format a single tweet
   */
  var formatTweet = function(tweet) {
    var html = '';
    html +=  '<div class="panel">' + 
      '<span class="label right" style="border-left: 1px solid #fff;">' + 
      tweet.favorite_count + ' favorited' + 
      '</span>' +
      '<span class="label right">' + tweet.retweet_count + ' retweets' + 
      '</span>' +
      '<p class="left"><img src="' + 
        tweet.profile_image_url + '"></p>' + 
      '<div class="name">' + tweet.name + 
      '<a href="/user/' + tweet.screen_name + 
      '">&commat;' + tweet.screen_name + '</a>' + '</div>' + 
      '<div class="text">' + tweet.tweet_text + '</div>' +
      '<div class="meta">' +
      '<small>' + tweet.created_at +  
      ' </small></div></div> <!--   end .tweet -->';
    return html;
  };

});
