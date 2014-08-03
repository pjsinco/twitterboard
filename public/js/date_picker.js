$(document).ready(function() {

  console.log('hiya');

  $('#start').datepicker({
    dateFormat: 'yy-mm-dd',
    onClose: function(selectedDate) {
      $('#end').datepicker('option', 'minDate', selectedDate);
    }
  });

  $('#end').datepicker({
    dateFormat: 'yy-mm-dd',
    onClose: function(selectedDate) {
      $('#start').datepicker('option', 'maxDate', selectedDate);
    }
  });

  $('#date-pick').click(function() {

    $.ajax({
      type: 'POST',
      url: '/leaders/tweets/search',
      data: {
        start: $('#start').val(),
        end: $('#end').val()
      },
      success: function(response) {

        // clear out .content
        $('.content').html('');

        response.forEach(function(d, i) {
          $('.content').append(
            '<div class="tweet">' + 
            '<p class="left"><img src="' + 
              d.profile_image_url + '"></p>' + 
            '<div class="name">' + d.name + 
            '<a href="http://localhost/profile/' + d.screen_name + 
            '">&commat;' + d.screen_name + '</a>' + '</div>' + 
            '<div class="text">' + d.tweet_text + '</div>' +
            '<div class="meta">' +
            '<p><small>' + d.retweet_count + ' retweets since ' + 
            d.created_at + '| ' + d.favorite_count + 
            ' favorited</small></p></div></div> <!--   end .tweet -->'
          );
        });
        
      }
    });

  });


});
