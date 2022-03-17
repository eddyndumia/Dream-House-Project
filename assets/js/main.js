$(document).ready(function(){
    $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
    $(".chosen-select-no-single").chosen({disable_search_threshold: 10});
    var height = window.innerHeight;
    minheight = $('.main').children().eq(2);
    $(minheight).css('min-height',height-160);
    $('.cover_area').css('min-height',height);

    $('.all_house_slider').slick({
      dots: false,
      infinite: true
    });

    $( "body" ).delegate( ".fixeds", "click", function() {
      $('#amount_fixed').attr('name', 'rental_value');
      $('#amount').attr('name', 'no');
    });
    $( "body" ).delegate( ".ranges", "click", function() {
      $('#amount').attr('name', 'rental_value');
      $('#amount_fixed').attr('name', 'no');
    });




    $( "#slider-range" ).slider({
      range: true,
      min: 100,
      max: 100000,
      step : 100,
      values: [ 10000, 14000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
     " - $" + $( "#slider-range" ).slider( "values", 1 ) );



     $( "#slider-range-max" ).slider({
           range: "max",
           min: 500,
           max: 100000,
           step : 100,
           value: 14000,
           slide: function( event, ui ) {
             $( "#amount_fixed" ).val( ui.value );
           }
      });
    $("#amount_fixed").val( $( "#slider-range-max" ).slider( "value" ) );


    $( "#price_tab" ).tabs();
    $('.myrange').tooltip();


});
