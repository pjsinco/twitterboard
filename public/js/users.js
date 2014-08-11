$(document).ready(function() {

  console.log('group: ' + group);
  console.log('controller: ' + controller);
  console.log('action: ' + action);
  console.log('label: ' + label);

  var labelHtml = '<span class="label" style="float: left; margin-right: 6px; ' +
    'top: 6px; text-transform: uppercase">' + group + 
    '</span>' + 
    '<h4 style="color: #999; text-transform: uppercase;">' + action + 
    ' <small class="dates">' + $('#start').val() +
    ' &ndash; ' + $('#end').val() + '</small></h4>';

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
      $('.content').html(labelHtml);

      var start = $('#start').val();
      var end = $('#end').val();
      $('.dates').html(start + ' &ndash; ' + end);
      
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
        $('.content').html(labelHtml);

        var start = $('#start').val();
        var end = $('#end').val();
        $('.dates').html(start + ' &ndash; ' + end);
        
        response.forEach(function(d, i) {
          $('.content').append(formatUser(d, label));
        });
      }
    });
  });
});
