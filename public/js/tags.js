$(document).ready(function() {

  console.log('group: ' + group);
  console.log('controller: ' + controller);
  console.log('action: ' + action);
  console.log('label: ' + label);

  // make an ajax call to get the content
  // TODO: turn ajax call into a method
  $.ajax({
    type: 'POST',
    url: '/tags/search',
    data: {
      start: $('#start').val(),
      end: $('#end').val(),
      group: group,
    },
    success: function(response) {
      
      response.forEach(function(d, i) {
        $('.content table.tags tbody').append(formatTag(d, label));
      });
    }
  });
  
  $('#date-pick').click(function() {

    $.ajax({
      type: 'POST',
      url: '/tags/search',
      data: {
        start: $('#start').val(),
        end: $('#end').val(),
        group: group,
      },
      success: function(response) {
        
        // clear the table body
        $('.content table.tags tbody').html('');

        response.forEach(function(d, i) {
          $('.content table.tags tbody').append(formatTag(d, label));
        });
      }
    });
  });



});
