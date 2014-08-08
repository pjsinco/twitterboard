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
      $('.content').html('');
      
      response.forEach(function(d, i) {
        $('.content').append(formatUser(d, label));
      });
    }
  });
  

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


});
