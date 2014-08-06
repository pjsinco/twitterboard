$(document).ready(function() {

  // set up the datepicker
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


  // compute the date values and set them
  var d = new Date();
  var curr_year = d.getFullYear();
  var curr_month = ('0' + (d.getMonth() + 1)).slice(-2);
  var last_month = ('0' + d.getMonth()).slice(-2);
  var curr_date = ('0' + d.getDate()).slice(-2);
  var startDate, endDate;

  if ($('#start').val() === '' ) {
    startDate = curr_year + '-' + last_month + '-' + curr_date;
    endDate = curr_year + '-' + curr_month + '-' + curr_date;

    $('#start').val(startDate);
    $('#end').val(endDate);
  } else if ($('#end').val() === '' && $('#start').val() !== '') {
    endDate = curr_year + '-' + curr_month + '-' + curr_date;
    $('#end').val(endDate);
  }

  // the number of ignorable elements when a URL
  // is split('/'), corresponding to 'http:', '', 'domain'
  var urlIgnorable = 3;
  var url = document.URL.split('/');
  var controller = url.slice(urlIgnorable - url.length)[0];
  var entity = url.slice(urlIgnorable - url.length)[1];

  // make an ajax call to get the content
  // TODO: turn ajax call into a method
  $.ajax({
    type: 'POST',
    url: '/' + controller + '/' + entity + '/search',
    data: {
      start: $('#start').val(),
      end: $('#end').val()
    },
    success: function(response) {

      console.log(response);

      // clear out .content
      $('.content').html('');

      response.forEach(function(d, i) {
        if (entity == 'tweets') {
          $('.content').append(formatTweet(d));
        } else if (entity == 'mentions' || 
            entity == 'retweets') {
          $('.content').append(formatUser(d, entity));
        }
      });
      
    }
  });

  $('#date-pick').click(function() {
  
    // parse the url to get the controller and entity
    var url = document.URL.split('/');
    var controller = url.slice(urlIgnorable - url.length)[0];
    var entity = url.slice(urlIgnorable - url.length)[1];

    console.log('controller: ' + controller);
    console.log('entity: ' + entity);


    //console.log($('#end').val() === '' );
    console.log('start: ' + $('#start').val());
    console.log('end: ' + $('#end').val());

    $.ajax({
      type: 'POST',
      url: '/' + controller + '/' + entity + '/search',
      data: {
        start: $('#start').val(),
        end: $('#end').val()
      },
      success: function(response) {

        console.log(response);

        // clear out .content
        $('.content').html('');

        response.forEach(function(d, i) {
          if (entity == 'tweets') {
            $('.content').append(formatTweet(d));
          } else if (entity == 'mentions' || 
              entity == 'retweets') {
            $('.content').append(formatUser(d, entity));
          }
        });
        
      }
    });

  });

  // format a single tweet
  var formatTweet = function(tweet) {

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


  // format a single user
  var formatUser = function(user, entity) {

    var html = '';
    html += '<div class="panel">' +
      '<span class="label right">' + user.count + ' ' + 
      entity + '</span>' +
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
