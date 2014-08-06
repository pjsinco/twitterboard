$(document).ready(function() {

  /**
   * Set up the datepicker
   */
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


  /**
   * Compute the date values and set them
   */
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

  /**
   * Parse the URL
   */
  // the number of ignorable elements when a URL
  // is split('/'), corresponding to 'http:', '', 'domain'
  var urlIgnorable = 3;
  var url = document.URL.split('/');
  var controller = url.slice(urlIgnorable - url.length)[0];
  var entity = url.slice(urlIgnorable - url.length)[1];

  console.log('start: ' + startDate);
  console.log('end: ' + endDate);
  console.log('controller: ' + controller);
  console.log('entity: ' + entity);

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

      switch (entity) {
        case 'tweets':
          response.forEach(function(d, i) {
            $('.content').append(formatTweet(d));
          });
          break;
        case 'mentions':
          response.forEach(function(d, i) {
            $('.content').append(formatUser(d));
          });
          break;
        case 'retweets':
          response.forEach(function(d, i) {
            $('.content').append(formatUser(d));
          });
          break;
        case 'tags':
          formatTable();
          response.forEach(function(d, i) {
            $('.content table tbody').append(formatTag(d));
          });
          break;
        default: // fallback is leader tweets; right move?
          response.forEach(function(d, i) {
            $('.content').append(formatTweet(d));
          });
          break;
      }
    }
  });

  $('#date-pick').click(function() {
  
    // parse the url to get the controller and entity
    var url = document.URL.split('/');
    var controller = url.slice(urlIgnorable - url.length)[0];
    var entity = url.slice(urlIgnorable - url.length)[1];

    console.log('controller: ' + controller);
    console.log('entity: ' + entity);
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

        switch (entity) {
          case 'tweets':
            response.forEach(function(d, i) {
              $('.content').append(formatTweet(d));
            });
            break;
          case 'mentions':
            response.forEach(function(d, i) {
              $('.content').append(formatUser(d));
            });
            break;
          case 'retweets':
            response.forEach(function(d, i) {
              $('.content').append(formatUser(d));
            });
            break;
          case 'tags':
            formatTable();
            response.forEach(function(d, i) {
              $('.content table tbody').append(formatTag(d));
            });
            break;
          default: // fallback is leader tweets; right move?
            response.forEach(function(d, i) {
              $('.content').append(formatTweet(d));
            });
            break;
        }
      }
    });
  });


  /**
   * Format table for listing tags
   */
  var formatTable = function() {
    var $content = $('.content').html('');
    $content.append('<table><thead><tr><th width="100">Count</th>' +
      '<th widtb="200">Tag</th><tbody>');
  };


  /**
   * Format a tag
   */
  var formatTag = function(tag) {
    var html = '';
    html += '<tr>';
    html += '<td>' + tag.count + '</td>';
    html += '<td>#' + tag.tag + '</td>';
    html += '</tr>';
    return html;
  };


  /*
   * Format a single tweet
   */
  var formatTweet = function(tweet) {
    var html = '';
    html +=  '<div class="tweet">' + 
      '<p class="left"><img src="' + 
        tweet.profile_image_url + '"></p>' + 
      '<div class="name">' + tweet.name + 
      '<a href="http://localhost/user/' + tweet.screen_name + 
      '">&commat;' + tweet.screen_name + '</a>' + '</div>' + 
      '<div class="text">' + tweet.tweet_text + '</div>' +
      '<div class="meta">' +
      '<p><small>' + tweet.retweet_count + ' retweets since ' + 
      tweet.created_at + '| ' + tweet.favorite_count + 
      ' favorited</small></p></div></div> <!--   end .tweet -->';
    return html;
  };


  /**
   * Format a single user
   */
  var formatUser = function(user, entity) {
    var html = '';
    html += '<div class="panel">' +
      '<span class="label right">' + user.count + ' ' + 
      entity + '</span>' +
      '<p class="left"><img src="' + user.profile_image_url + 
      '"></p>' + '<div class="name">' + user.name + '<a href="/user/' +
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
