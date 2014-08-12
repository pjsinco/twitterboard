/**
 * Format table for listing tags
 */
var formatTable = function() {
  var $content = $('.content').html('');
  $content.append('<table><thead><tr><th width="100">Count</th>' +
    '<th widtb="200">Tag</th><tbody>');
};


/**
 * Format a single tweet
 */
var formatTweet = function(tweet) {
  console.log(tweet.tweet_id);
  var html = '';
  html +=  '<div class="tweet">' + 
    '<div class="profile-image"><img src="' + tweet.profile_image_url +
    '"></div>' + 
    '<a href="http://twitter.com/' + tweet.screen_name + 
    '/status/' + tweet.tweet_id + '">' +
    '<span class="label right" style="border-left: 1px solid #fff;">' +
    tweet.favorite_count + ' favorited' + 
    '</span>' +
    ' <span class="label right">' + tweet.retweet_count + ' retweets' +
    '</span>' + '</a>' +
    '<div class="name">' + tweet.name + 
    '<a href="/user/' + tweet.screen_name + 
    '"> &commat;' + tweet.screen_name + '</a> ' + tweet.created_at + 
    '</div>' + '<div class="text">' + tweet.tweet_text + '</div>' +
    '<div class="meta"></div></div> <!--   end .tweet -->';
  return html;
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


/**
 * Format a single user
 **/
var formatUser = function(user, category) {
  var html = '';
  html += '<div class="panel">' +
    '<span class="label right">' + user.count + ' ' + 
    category + '</span>' +
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
