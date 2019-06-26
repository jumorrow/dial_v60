<!DOCTYPE HTML>
<html>
    <?php $this->load->view('head'); ?>
<body class="primary_layout">
    <div class="form_wrapper">
    <section id="header">
        <header>
            <h1>Welcome To Dial v60</h1>
            <p>A Simple, Useful Tool for Dialing in that v60 Pour Over</p>
        </header>
        <footer>
            <a href="#banner" class="button style2 scrolly-middle">Let's Get Started</a>
        </footer>
    </section>
    <section id="banner">
        <header>
            <h2>Equipment Checklist</h2>
            <p class="no-padding">Make sure you've got the following handy:</p>
        </header>
        <p>v60 Brewer, Fresh Coffee, Filters, Scale, Timer, Kettle</p>
        <footer>
            <a href="#first" class="button style2 scrolly">Onward</a>
        </footer>
    </section>
    <article id="first" class="container box style1 right">
        <a href="#" class="image fit"><img src="<?php echo get_asset_path('images','v60-1.jpg');?>" alt="Coffee Grind" /></a>
        <div class="inner">
            <header>
                <h2>Grind Is Crucial But...</h2>
            </header>
            <p>Every single grinder on the planet will produce a unique output of fines and boulders so let's not focus on "grind settings" and make this easy.</p>
            <p>Simply try and create something similar to this image.</p>
        </div>
    </article>
    <!-- Ratio Configurator -->
    <article class="container box style3">
        <div class="form_inner">
        <header>
            <h2>Ratio / Yield Configuration</h2>
        </header>
        <form id="recipe_configuration">
            <div class="row gtr-50">
                <div class="col-12 col-12-mobile serving_size">
                    <p>Serving Size?</p>
                    <select name="serving_size" id="serving_size">
                        <option value="300" selected>Standard Coffee Cup (300ML)</option>
                        <option value="400">Large Coffee Cup (400ML)</option>
                        <option value="500">Two Standard Coffee Cups (500ML)</option>
                        <option value="custom">Custom Output</option>
                    </select> 
                </div>
                <div class="col-12 col-12-mobile custom_yield">
                    <p>Enter Desired Coffee Output (300-1000 In ML)</p>
                    <input type="number" name="custom_yield" id="custom_yield" value="300" min="300" max="1000" />
                    <p><span class="smaller-text"><em>If brewing more than 500 ML of coffee, make the grind more coarse than normal.</em></span></p>
                </div>
                <div class="col-12 col-12-mobile strength_preference">
                    <p>Strength Preference</p>
                    <select name="strength_preference" id="strength_preference">
                        <option value="lighter" selected>Lighter</option>
                        <option value="stronger">Stronger</option>
                    </select> 
                </div>
                <div class="col-12 col-12-mobile flavor_preference">
                    <p>Flavor Preference</p>
                    <select name="flavor_preference" id="flavor_preference">
                        <option value="balanced" selected>Balanced</option>
                        <option value="sweeter">Sweet</option>
                        <option value="brighter">Bright</option>
                    </select> 
                    <p><span class="smaller-text"><em>Can't Decide? <a class="more_info_action">Here</a> are some helpful tips.</em></span></p>
                </div>                    
                <div class="col-12">    
                    <ul class="actions">
                        <li><input type="submit" value="Generate Brew Recipe" /></li>
                    </ul>
                </div>
            </div>
        </form>
        </div>
        <div class="form_more_info">
            <header>
            <h2>Method Overview and Direction</h2>
        </header>
        <p>The calculation for this brew method is based on the 4:6 
                ratio, which was used by <a href="https://kurasu.kyoto/blogs/kurasu-journal/2016-world-brewers-cup-champion-tetsu-kasuya" target="_blank">Tetsu Kasuya</a> to secure the win 
                during the 2016 World Brewers Cup.</p>
            <p><em>"The 4-6 method begins by dividing the total water into 40% and 60%.
                    You pour the first 40% in two pours, and then decide how many pours 
                    you want to make for the last 60%. The first 2 pours decide the balance of 
                    the acidity and sweetness. The remaining number of pours will decide 
                    the strength of the coffee."</em>- <strong>Tetsu Kasuya</strong></p>
            <p>This calculator simply takes the guess work out of the 
                equation and allows you to dial in that pour over 
                coffee based on your personal preference.</p>
            <p>Furthermore, certain coffee varietals may benefit from a brighter (more acidic) or sweeter recipe configuration.</p> 
            <p><a class="more_info_back">Back</a> to the form please.</em></span></p>
        </div>
    </article>
    <?php $this->load->view('footer');?>
    </div>
    <div class="results_wrapper">
        <section id="header">
            <header>
                <h1>Results</h1>
                <p>This recipe was generated based on your own personal strength and flavor preferences.</p>
            </header>
            <footer>
                <a href="#step_one" class="button style2 scrolly-middle">Let's Start Brewing</a>
            </footer>
        </section>
        <!--Steps-->
        <article class="container box style2" id="step_one">
            <header>
                <h2>Step One (The Bloom)</h2>
                <p><strong>0:00 - 0:45</strong> - Start by pouring ~<span class="pour_one"></span>
                    grams of water in a steady, circular motion from center to outward rim without 
                    pouring on the walls. </p>
            </header>
        </article>
        <article class="container box style2" id="step_two">
            <header>
                <h2>Step Two</h2>
                <p><strong>@ 0:45</strong> - Continue to pour to ~<span class="pour_two"></span>
                    grams of water in a steady, circular motion from center to outward rim without 
                    pouring on the walls. </p>
            </header>
        </article>
        <article class="container box style2" id="step_three">
            <header>
                <h2>Step Three</h2>
                <p><strong>@ 1:30</strong> - Pour to ~<span class="pour_three"></span>
                    grams of water in a steady, circular motion from center to outward rim without 
                    pouring on the walls. </p>
            </header>
        </article>
        <article class="container box style2" id="step_four">
            <header>
                <h2>Step Four</h2>
                <p><strong>@ 2:15</strong> - Pour to ~<span class="pour_four"></span>
                    grams of water in a steady, circular motion from center to outward rim without 
                    pouring on the walls. </p>
            </header>
        </article>
        <article class="container box style2" id="step_five">
            <header>
                <h2>Step Five</h2>
                <p><strong>@ 3:00</strong> - Pour to ~<span class="pour_five"></span>
                    grams of water in a steady, circular motion from center to outward rim without 
                    pouring on the walls. </p>
            </header>
        </article>
        <?php $this->load->view('footer'); ?>
    </div>
<?php $this->load->view('final_scripts'); ?>       
</body>
</html>