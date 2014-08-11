$(document).ready(function() {
  
  console.log('group: ' + group);
  console.log('filter: ' + filter);

  var labelHtml = '<span class="label" style="float: left; margin-right: 6px; ' +
    'top: 6px; text-transform: uppercase">' + group + 
    '</span>' + 
    '<h4 style="color: #999; text-transform: uppercase;">' + filter + 
    ' tweets <small class="dates">' + $('#start').val() +
    ' &ndash; ' + $('#end').val() + '</small></h4>';

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
      $('.content').html(labelHtml)
      
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
        $('.content').html(labelHtml)

        var start = $('#start').val();
        var end = $('#end').val();
        $('.dates').html(start + ' &ndash; ' + end);

        response.forEach(function(d, i) {
          $('.content').append(formatTweet(d));
        });
      }
    });
  });
});
