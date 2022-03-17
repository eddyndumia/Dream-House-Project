$(document).ready(function(){


  $( "#slider_range_formess" ).slider({
    range: true,
    min: 100,
    max: 100000,
    step : 100,
    values: [ 10000, 14000 ],
    slide: function( event, ui ) {
      $( "#amount_range_mess" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    }
  });
  $( "#amount_range_mess" ).val( "$" + $( "#slider_range_formess" ).slider( "values", 0 ) +
   " - $" + $( "#slider_range_formess" ).slider( "values", 1 ) );



   $( "#slider-range-mess" ).slider({
         range: "max",
         min: 500,
         max: 100000,
         step : 100,
         value: 14000,
         slide: function( event, ui ) {
           $( "#amount_mess" ).val( ui.value );
         }
    });
  $( "#amount_mess" ).val( $( "#slider-range-mess" ).slider( "value" ) );


  $( "#price_tab_mess" ).tabs();
  $('.myrange').tooltip();








    $('#reg_as').on('change', function(){


      if(this.value == '1'){
        $('.reg_title p').text('Register as a Owner');
      }
      else if(this.value == '2'){
        $('.reg_title p').text('Register as a Tenant');
      }
    });

    var i = 1;
    var image = '<div class="main_input"><input type="file" style="float:left;" class="form-control-file" name="img_1" placeholder="Add Image(Optional)" value=""><span class="plus_btn"> <i class="fas fa-plus"></i> </span><span class="minus"> <i class="fas fa-minus"></i> </span></div>';

    $('#select_type').on('change', function(){
      console.log(this.value);
         if(this.value == 'Family' || this.value == 'Bachelor' || this.value == 'Sublet'){
           $('.mess').hide();
           $('.fam_bac_sub').show('500', function() {});
         }
         else if(this.value = 'Mess/Hostel') {
           $('.fam_bac_sub').hide();
           $('.mess').show('500', function() {});
         }
         $('.hidden_plus_btn').hide();
         if($('.main_input:not(:first-child)').length == 0) {
           $('.inner_image_input').append(image);
         }
         i=1;
         $('.main_input:not(:first-child)').remove();
         $('.main_input:first-child .plus_btn').show();
    });


    $( "body" ).delegate( ".plus_btn", "click", function() {
      if(i < 3){
        i++
        var s = $(this).parent().parent();
        $(s).append(image);
        var atr = $(s).children().last().children('input');
        $(atr).attr('name', 'img_'+i);
        $(this).hide();
      }
    });

    $( "body" ).delegate( ".hidden_plus_btn", "click", function() {
        var t = $(this).parent().last();
        $(t).append(image);
        $(this).hide();
        i++;
    });

    $( "body" ).delegate( ".minus", "click", function(){
      var s = $(this).parent();
      var q = $(this).parent().parent();
      $(q).children().last().remove();
      var m = $(q).children().last().children('.plus_btn');
      $(m).show();
      i--;
      if(i==(0)){
        $('.hidden_plus_btn').show();
      }
    });


});
