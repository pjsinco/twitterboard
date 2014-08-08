$(document).ready(function() {
  
  console.log('portnoy');

  console.log('group: ' + group);
  console.log('filter: ' + filter);

  // make an ajax call to get the content
  // TODO: turn ajax call into a method
  $.ajax({
    type: 'POST',
    url: '/tweets/search',
    data: {
      start: $('#start').val(),
      end: $('#end').val(),
      group: group,
      filter: filter,
    },
    success: function(response) {
      $('.content').html('');
      
      response.forEach(function(d, i) {
        $('.content').append(formatTweet(d));
      });
    }
  });

  $('#date-pick').click(function() {
  
    console.log('start: ' + $('#start').val());
    console.log('end: ' + $('#end').val());

    $.ajax({
      type: 'POST',
      url: '/tweets/search',
      data: {
        start: $('#start').val(),
        end: $('#end').val(),
        group: group,
        filter: filter,
      },
      success: function(response) {

        // clear out .content
        $('.content').html('');

        response.forEach(function(d, i) {
          $('.content').append(formatTweet(d));
        });
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
