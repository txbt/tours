<?php

/*
* Template for Book a Tour page
*/

get_header();

if (isset($_GET['tourID'])) {
  $booktourID = $_GET["tourID"];
}

if (isset($_GET['tourName'])) {
  $booktourName = $_GET["tourName"];
  
 // echo $booktourName;
} else { $booktourName = "Create New Tour";}

?>


<div id="primary-full" class="row-fluid content-area" >

  <main id="main" class="site-main" role="main">
    <div class="inner-wrap">

      <div id="custom-tour-form2">
            <h2 class="tour-form-title" style="width:100%; margin:0;"><?php echo " " . $booktourName; ?></h2> 
            
            <?php
            echo do_shortcode('[gravityform id="26" name="Book Your Bike Tour" title="false" description="false"]');
            ?>
            
          </div>



    </div><!-- inner-wrap -->
  
	</main><!-- #content -->
		</div><!-- #primary .site-content -->

<script>

  var current_value = jQuery('#input_26_62').val();
  var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';


//  alert ('current_value page load: ' + current_value);


  jQuery('#input_26_55 option').each(function(){

  if (jQuery(this).val() == current_value) {
  jQuery(this).attr("selected", true);
  var textSelected = jQuery(this).text();

  // alert(textSelected);

  // This does the ajax request
  jQuery.ajax({
  url: ajaxurl,
  data: {
  'action':'example_ajax_request',
  'textSelected' : textSelected
  },
  success:function(data) {
  // This outputs the result of the ajax request
  jQuery('#tour-details').append().html(data);

//  console.log(data);
  },
  error: function(errorThrown){
  alert('!!!!!!!!!!!!!!!!!');
//  console.log(errorThrown);
  }
  });


  }




  });
  <!--  ================================================ -->

  jQuery('#input_26_55').change(function () {

  var optionSelected = jQuery(this).find("option:selected");
  var valueSelected = optionSelected.val();
  var textSelected = optionSelected.text();

  // alert(valueSelected);


  // We'll pass this variable to the PHP function example_ajax_request

  // This does the ajax request
  jQuery.ajax({
      url: ajaxurl,
      data: {
      'action':'example_ajax_request',
      'textSelected' : textSelected
    },
  success:function(data) {
    // This outputs the result of the ajax request
    jQuery('#tour-details').append().html(data);

    jQuery('#input_26_62').val(textSelected);
    // var current_value = jQuery('#input_26_55 option').val();

    var current_value = document.getElementById("input_26_55").value;

   // alert ('current_value: ' + current_value);


    console.log(data);
  },
  error: function(errorThrown){
    alert('!!!!!!!!!!!!!!!!!');
    console.log(errorThrown);
  }
  
  });


 

  <!-- end click -->



  });

</script>




<?php get_footer();?>