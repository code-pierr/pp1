(function($){
$(function(){
  $('.button-collapse').sideNav();
  $(".dropdown-button").dropdown({
    hover: false
  });
  $('.modal-trigger').leanModal({
    dismissible: true,
    opacity: .5
  });
  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15
  });
  $('select').material_select();
}); // end of document ready
})(jQuery); // end of jQuery name space
