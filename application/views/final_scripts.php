<!-- Scripts -->
<script src="<?php echo get_asset_path('js', 'jquery.min.js'); ?>"></script>
<script src="<?php echo get_asset_path('js', 'jquery.scrolly.min.js'); ?>"></script>
<script src="<?php echo get_asset_path('js', 'jquery.poptrox.min.js'); ?>"></script>
<script src="<?php echo get_asset_path('js', 'browser.min.js'); ?>"></script>
<script src="<?php echo get_asset_path('js', 'breakpoints.min.js'); ?>"></script>
<script src="<?php echo get_asset_path('js', 'util.js'); ?>"></script>
<script src="<?php echo get_asset_path('js', 'main.js'); ?>"></script>

<script>
$(document).ready(function() {   
    
    //variables to hold request
    var request;
    var coffee_data;

    //bind to the submit event of our form
    $("#recipe_configuration").submit(function(event){

        //prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
            if (request) {
                request.abort();
            }

            //cache input fields
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");

            //serialize the data in the form
            var serializedData = $form.serialize();

            //disabled form elements will not be serialized.
            $inputs.prop("disabled", true);

            //submit ajax request to results controller
            request = $.ajax({
                url: "<?php echo site_url('results'); ?>",
                type: "post",
                data: serializedData
            });

            //callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR) {

                //console.log(response)

                //parse serialized data into JSON for easy use in page html
                var coffee_data = JSON.parse(response);

                pour_one = coffee_data.pour_one;
                pour_two = coffee_data.pour_two;
                pour_three = coffee_data.pour_three;
                pour_four = coffee_data.pour_four;
                total_steps = coffee_data.total_steps;
                
                //populate html with variables returned from controller via jQuery
                $('span.pour_one').html(pour_one);
                $('span.pour_two').html(pour_two);
                $('span.pour_three').html(pour_three);
                $('span.pour_four').html(pour_four);
                
                //if five steps in recipe, show fifth step
                if (total_steps === 5) {
                    pour_five = coffee_data.pour_five;
                    $('span.pour_five').html(pour_five);
                    $('#step_five').show();
                }
                
                //scroll effects and fade in / fade out on complete
                $('html, body').animate({
                    scrollTop: $('body').offset().top
                }, 500, 'linear', function () {
                    $('.form_wrapper').fadeOut(1000, function () {
                        $('.results_wrapper').fadeIn(1000);
                    });
                });
            });
                       
            //callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                console.error(
                        "The following error occurred: " +
                        textStatus, errorThrown
                        );
            });

            //callback handler that will be called regardless
            //if the request failed or succeeded
            request.always(function () {
                //re-enable the inputs
                $inputs.prop("disabled", false);
            });

        });

        $('select#serving_size').on('change', function () {

            $selected_option = this.value;

            if ($selected_option === "custom") {
                $('.custom_yield').toggle();
            } else {
                $('.custom_yield').hide();
            }

        });
        
        $('.more_info_action').click(function(){
            $('.form_inner').fadeOut(1000, function () {
                $('.form_more_info').fadeIn(1000);
            });   
        });
        
        $('.more_info_back').click(function(){
            $('.form_more_info').fadeOut(1000, function () {
                $('.form_inner').fadeIn(1000);
            });   
        });
        
});
</script>