$(document).ready(function() {

  $('#start').val($(this).attr('placeholder'));
  $('#end').val($(this).attr('placeholder'));


  // the number of ignorable elements when a URL
  // is split('/'), corresponding to 'http:', '', 'domain'
  var urlIgnorable = 3;

  $('#start').datepicker({
    dateFormat: 'yy-mm-dd',
    onClose: function(selectedDate) {
      $('#end').datepicker('option', 'minDate', selectedDate);
    }
  });

  $('#end').datepicker({
    dateFormat: 'yy-mm-dd',
    onClose: function(selectedDate) {
      $('#start').datepicker('option', 'maxDate', selectedDate);
    }
  });

  $('#date-pick').click(function() {
  
    // parse the url to get the controller and method
    var url = document.URL.split('/');
    var controller = url.slice(urlIgnorable - url.length)[0];
    var method = url.slice(urlIgnorable - url.length)[1];

    console.log('controller: ' + controller);
    console.log('method: ' + method);

    if ($('#start').val() === '' ) {
      var d = new Date();
      var curr_year = d.getFullYear();
      var curr_month = ('0' + (d.getMonth() + 1)).slice(-2);
      var curr_date = ('0' + d.getDate()).slice(-2);

      var date = curr_year + '-' + curr_month + '-' + curr_date;
      $('#start').val(date);
    }
    //console.log($('#end').val() === '' );

    $.ajax({
      type: 'POST',
      url: '/' + controller + '/' + method + '/search',
      data: {
        start: $('#start').val(),
        end: $('#end').val()
      },
      success: function(response) {

        console.log(response);

        // clear out .content
        $('.content').html('');

        response.forEach(function(d, i) {
          if (method == 'tweets') {
            $('.content').append(addTweet(d));
          } else if (method == 'mentions') {
            $('.content').append(addUser(d));
          }
        });
        
      }
    });

  });

  var addTweet = function(tweet) {

    var html = '';
    html +=  '<div class="tweet">' + 
      '<p class="left"><img src="' + 
        tweet.profile_image_url + '"></p>' + 
      '<div class="name">' + tweet.name + 
      '<a href="http://localhost/profile/' + tweet.screen_name + 
      '">&commat;' + tweet.screen_name + '</a>' + '</div>' + 
      '<div class="text">' + tweet.tweet_text + '</div>' +
      '<div class="meta">' +
      '<p><small>' + tweet.retweet_count + ' retweets since ' + 
      tweet.created_at + '| ' + tweet.favorite_count + 
      ' favorited</small></p></div></div> <!--   end .tweet -->';

    return html;
  };

  var addUser = function(user) {

    var html = '';
    html += '<div class="panel">' +
      '<span class="label right">' + user.count + ' mentions</span>' +
      '<p class="left"><img src="' + user.profile_image_url + '"></p>' +
      '<div class="name">' + user.name + '<a href="/user/' + 
      user.screen_name + '">&commat;' + user.screen_name + '</a>' +
      '</div>' +
      '<div class="description">' +
      '<p>' + user.description + '<br>' +
      user.location + ' <a href="' + user.url + '" title="' + 
      user.screen_name + '" on Twitter">' + user.url + '</a></p>' +
      '</div>' +
      "<ul class='inline-list'>" +
      "<li><strong>Followers:</strong>" + user.followers_count + 
        "</li>" +
      "<li><strong>Following:</strong>" + user.friends_count +
        "</li>" +
      "<li><strong>Tweets:</strong>"    + user.statuses_count +
        "</li>" +
      "<li><strong>Listed:</strong>"    + user.listed_count +
        "</li>" +
      "<li><strong>Created:</strong>"   + user.created_at +
        "</li>" +
      "</ul>" + '</div> <!-- end .panel  -->';
  
    return html;
    
  };


});
