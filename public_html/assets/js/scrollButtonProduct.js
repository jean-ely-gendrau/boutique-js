$('#prev').on('click', function() {
  $('#menu ul').animate({
    scrollLeft: '-=150'
  }, 300, 'swing');
});

$('#next').on('click', function() {
  $('#menu ul').animate({
    scrollLeft: '+=150'
  }, 300, 'swing');
});