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


});
