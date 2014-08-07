$(document).ready(function() {

  /**
   * Set up the datepicker
   */
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


  /**
   * Compute the date values and set them
   */
  var d = new Date();
  var curr_year = d.getFullYear();
  var curr_month = ('0' + (d.getMonth() + 1)).slice(-2);
  var last_month = ('0' + d.getMonth()).slice(-2);
  var curr_date = ('0' + d.getDate()).slice(-2);
  var startDate, endDate;

  if ($('#start').val() === '' ) {
    startDate = curr_year + '-' + last_month + '-' + curr_date;
    endDate = curr_year + '-' + curr_month + '-' + curr_date;

    $('#start').val(startDate);
    $('#end').val(endDate);
  } else if ($('#end').val() === '' && $('#start').val() !== '') {
    endDate = curr_year + '-' + curr_month + '-' + curr_date;
    $('#end').val(endDate);
  }

  console.log('start: ' + startDate);
  console.log('end: ' + endDate);

});
