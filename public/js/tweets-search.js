$(document).ready(function() {

  console.log('bike');
  var target = document.getElementsByClassName('content')[0];

  $('#search-terms').click(function(evt) {

    var terms = $('#terms').val();

    $.ajax({
      type: 'POST',
      url: '/tweets/search/circle',
      beforeSend: function() {
        var spinner = 
          new Spinner({top: '200%', left: '50%'}).spin(target);
      },
      data: {
        //start: $('#start').val(),
        //end: $('#end').val(),
        terms: terms,
      },
      success: function(response) {
        console.log(response);
    
        $('.content').html(
          '<h4 style="color: #999; text-transform: uppercase;">' + 
          'Results for <span class="search-term">"' + terms + 
          '"</span></h4>'
        );

        response.forEach(function(d, i) {
          $('.content').append(formatTweet(d));
        });
      }
    });

  });

});
