$(document).ready(function() {

  console.log('weather vane');
  
  $('#search-terms').click(function(evt) {

    var terms = $('#terms').val();

    $.ajax({
      type: 'POST',
      url: '/users/search',
      data: {
        terms: terms,
      },
      success: function(response) {

        console.log(response);
    
        $('.content').html('');

        response.forEach(function(d, i) {
          $('.content').append(formatUser(d));
        });
      }
    });

  });

  /**
   *   
   * Format a single user
   *       
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

});
