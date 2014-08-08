$(document).ready(function() {

  console.log('group: ' + group);
  console.log('controller: ' + controller);
  console.log('action: ' + action);
  console.log('label: ' + label);

  // make an ajax call to get the content
  // TODO: turn ajax call into a method
  $.ajax({
    type: 'POST',
    url: '/users/search/' + action,
    data: {
      start: $('#start').val(),
      end: $('#end').val(),
      group: group,
    },
    success: function(response) {
      $('.content').html('');
      
      response.forEach(function(d, i) {
        $('.content').append(formatUser(d, label));
      });
    }
  });

  $('#date-pick').click(function() {
    $.ajax({
      type: 'POST',
      url: '/users/search/' + action,
      data: {
        start: $('#start').val(),
        end: $('#end').val(),
        group: group,
      },
      success: function(response) {
        $('.content').html('');
        
        response.forEach(function(d, i) {
          $('.content').append(formatUser(d, label));
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
