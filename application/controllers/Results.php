<?php
/**
 * MorrowInteractive Controller
 *
 * Simple controller to process brew configuration form
 *
 * @package	CodeIgniter
 * @author	Justin Morrow <jumorrow@protonmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Results extends CI_Controller {

    const pour_ratio = 5;
    const brew_ratio = 15; //most configurations will use 1:15 ratio

    private $recipe_configuration = null;
    private $data = array();
    private $total_steps = 5;
    private $one_third = 0.33;
    private $two_thirds = 0.66;

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/results
     * 	- or -
     * 		http://example.com/index.php/results/index
     */
    public function index() {

        //capture post variables
        $serving_size = $this->input->post('serving_size');

        //detect if custom yield was selected
        if($serving_size !== "custom"){
            $serving_size = (int) $this->input->post('serving_size');
        } else {
            $serving_size = (int) $this->input->post('custom_yield');
        }

        //$custom_yield = (int) $this->input->post('custom_yield');
        $strength_preference = $this->input->post('strength_preference');
        $flavor_preference = $this->input->post('flavor_preference');

        //define standard pour division, to be used in each configuration
        $pour_division = $serving_size / self::pour_ratio;

        //define dosage of coffee, to be used in each configurations
        $coffee_dose = $serving_size / self::brew_ratio;

        //confirm client-side validation was not bypassed
        if (!$serving_size || !$strength_preference || !$flavor_preference) {

            //temporary error handling, ideally would display "something wrong
            //message within the layout HTML
            //die('something fishy');
            $this->load->view('primary_layout');

        } else {

            //determine which recipe configuration to use in switch statement
            if ($strength_preference == "lighter" && $flavor_preference == "balanced") {
                $this->recipe_configuration = "lighter_balanced";
            }

            if ($strength_preference == "lighter" && $flavor_preference == "sweeter") {
                $this->recipe_configuration = "lighter_sweeter";
            }

            if ($strength_preference == "lighter" && $flavor_preference == "brighter") {
                $this->recipe_configuration = "lighter_brighter";
            }

            if ($strength_preference == "stronger" && $flavor_preference == "balanced") {
                $this->recipe_configuration = "stronger_balanced";
            }

            if ($strength_preference == "stronger" && $flavor_preference == "sweeter") {
                $this->recipe_configuration = "stronger_sweeter";
            }

            if ($strength_preference == "stronger" && $flavor_preference == "brighter") {
                $this->recipe_configuration = "stronger_brighter";
            }

            //handle different permutations for the final coffee recipe
            switch ($this->recipe_configuration) {

                /*
                 * This is the basic recipe and will produce a balanced cup.
                 *
                 * You simply divide the final output (in grams) by 5 and use
                 * that number for the first two pours, then multiple that
                 * number by three and then divide by two for the final two
                 * pours.
                 *
                 * example: Brewing 300g of coffee, with this recipe will
                 * consist of four total pours:
                 *
                 * 1 > 60g
                 * 2 > 60g (to 120)
                 * 3 > 90g (60*3)/2 (to 210)
                 * 4 > 90g (60*3)/2 (to 300)
                 */
                case "lighter_balanced":

                    //define total steps for this configuration
                    $this->total_steps = 4;

                    //define individual pour to weights for this configuration
                    $data['pour_one'] = $pour_division;
                    $data['pour_two'] = $pour_division + $data['pour_one'];
                    $data['pour_three'] = $data['pour_two'] + ($pour_division * 3) / 2;
                    $data['pour_four'] = $data['pour_three'] + ($pour_division * 3) / 2;

                    break;

                /*
                 * This recipe will produce a sweeter, lighter cup.
                 *
                 * You simply divide the final output (in grams) by 5 and use
                 * that number for the first two pours but the first pour is 1/3
                 * of the total value for the first two pours and the
                 * second pour is 2/3 of the total value of the first two
                 * pours. Multiple that same number by three and then divide by
                 * two for the final two pours.
                 *
                 * example: Brewing 300g of coffee, with this recipe will
                 * consist of four total pours:
                 *
                 * 1 > 40g
                 * 2 > 80g
                 * 3 > 90g (60*3)/2
                 * 4 > 90g (60*3)/2
                 */
                case "lighter_sweeter":

                    //define total steps for this configuration
                    $this->total_steps = 4;

                    //define individual pour weights for this configuration
                    $data['pour_one'] = ceil(($pour_division * 2) * $this->one_third);
                    $data['pour_two'] = $data['pour_one'] + ceil(($pour_division * 2) * $this->two_thirds);
                    $data['pour_three'] = $data['pour_two'] + ($pour_division * 3) / 2;
                    $data['pour_four'] = $data['pour_three'] + ($pour_division * 3) / 2;

                    break;

                /*
                 * This recipe will produce a brighter, lighter cup.
                 *
                 * You simply divide the final output (in grams) by 5 and use
                 * that number for the first two pours but the first pour is 2/3
                 * of the total value for the first two pours and the
                 * second pour is 1/3 of the total value of the first two
                 * pours. Multiple that same number by three and then divide by
                 * two for the final two pours.
                 *
                 * example: Brewing 300g of coffee, with this recipe will
                 * consist of four total pours:
                 *
                 * 1 > 80g
                 * 2 > 40g
                 * 3 > 90g (60*3)/2
                 * 4 > 90g (60*3)/2
                 */
                case "lighter_brighter":

                    //define total steps for this configuration
                    $this->total_steps = 4;

                    //define individual pour weights for this configuration
                    $data['pour_one'] = ceil(($pour_division * 2) * $this->two_thirds);
                    $data['pour_two'] = $data['pour_one'] + ceil(($pour_division * 2) * $this->one_third);
                    $data['pour_three'] = $data['pour_two'] + ($pour_division * 3) / 2;
                    $data['pour_four'] = $data['pour_three'] + ($pour_division * 3) / 2;

                    break;

                /*
                 * This is a variation on the basic recipe and will produce a
                 * stronger, balanced cup.
                 *
                 * You simply divide the final output (in grams) by 5 and use
                 * that number for all five pours.
                 *
                 * example: Brewing 300g of coffee, with this recipe will
                 * consist of five total pours:
                 *
                 * 1 > 60g
                 * 2 > 60g
                 * 3 > 60g
                 * 4 > 60g
                 * 5 > 60g
                 */
                case "stronger_balanced":

                    //define individual pour weights for this configuration
                    $data['pour_one'] = $pour_division;
                    $data['pour_two'] = $data['pour_one'] + $pour_division;
                    $data['pour_three'] = $data['pour_two'] + $pour_division;
                    $data['pour_four'] = $data['pour_three'] + $pour_division;
                    $data['pour_five'] = $data['pour_four'] + $pour_division;

                    break;

                /*
                 * This recipe will produce a sweeter, stronger cup.
                 *
                 * You simply divide the final output (in grams) by 5 and use
                 * that number for the first two pours but the first pour is 1/3
                 * of the total value for the first two pours and the
                 * second pour is 2/3 of the total value of the first two
                 * pours. The final three pours are simply the final output
                 * divided by five.
                 *
                 * example: Brewing 300g of coffee, with this recipe will
                 * consist of five total pours:
                 *
                 * 1 > 40g
                 * 2 > 80g
                 * 3 > 60g
                 * 4 > 60g
                 * 5 > 60g
                 */
                case "stronger_sweeter":

                    //define individual pour weights for this configuration
                    $data['pour_one'] = ceil(($pour_division * 2) * $this->one_third);
                    $data['pour_two'] = $data['pour_one'] + ceil(($pour_division * 2) * $this->two_thirds);
                    $data['pour_three'] = $data['pour_two'] + $pour_division;
                    $data['pour_four'] = $data['pour_three'] + $pour_division;
                    $data['pour_five'] = $data['pour_four'] + $pour_division;

                    break;

                /*
                 * This recipe will produce a brighter, stronger cup.
                 *
                 * You simply divide the final output (in grams) by 5 and use
                 * that number for the first two pours but the first pour is 2/3
                 * of the total value for the first two pours and the
                 * second pour is 1/3 of the total value of the first two
                 * pours. The final three pours are simply the final output
                 * divided by five.
                 *
                 * example: Brewing 300g of coffee, with this recipe will
                 * consist of five total pours:
                 *
                 * 1 > 80g
                 * 2 > 40g
                 * 3 > 60g
                 * 4 > 60g
                 * 5 > 60g
                 */
                case "stronger_brighter":

                    //define individual pour weights for this configuration
                    $data['pour_one'] = ceil(($pour_division * 2) * $this->two_thirds);
                    $data['pour_two'] = $data['pour_one'] + ceil(($pour_division * 2) * $this->one_third);
                    $data['pour_three'] = $data['pour_two'] + $pour_division;
                    $data['pour_four'] = $data['pour_three'] + $pour_division;
                    $data['pour_five'] = $data['pour_four'] + $pour_division;

                    break;
            }

            //return recipe configuation for testing/debugging
            $data['recipe_configuration'] = $this->recipe_configuration;

            //prepare total steps for view
            //lighter will have 5 steps, stronger will have 4 steps
            $data['total_steps'] = $this->total_steps;

            //round all pour values to nearest tenth (for ease of use)
            $data['pour_one'] = nearest_tenth($data['pour_one']);
            $data['pour_two'] = nearest_tenth($data['pour_two']);
            $data['pour_three'] = nearest_tenth($data['pour_three']);
            $data['pour_four'] = nearest_tenth($data['pour_four']);

            if(isset($data['pour_five'])){
                $data['pour_five'] = nearest_tenth($data['pour_five']);
            }

            //prepare starting dosage for output
            $data['starting_dose'] = ceil($coffee_dose);

            //load view with recipe variables for display in HTML
            //$this->load->view('calculation_results', $data);

            echo json_encode($data);
        }
    }

}
