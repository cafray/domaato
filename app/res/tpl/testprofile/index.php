<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>

<!-- Profile-->

<article class="main">
   <header>
		<h1><?php echo I18n::__('Profile_h1') ?></h1>
	
    </header>

        <!--<div>
            <img
        		src="<?php echo Gravatar::src($record->email, 72) ?>"
        		class="gravatar-account circular no-shadow"
        		width="72"
        		height="72"
        		alt="<?php echo htmlspecialchars($record->getName()) ?>" />
        </div>-->

    <div class="container">
    <div class="row" style="background-color:#f7fff0;height:800px;">
        <div class="col-md-4" style="margin-top: 3.5rem;">
        <div class="card" style="width: 18rem;">

        <img
        		src="<?php echo Gravatar::src($record->email, 72) ?>"
        		class="card-img-top"
        		
        		alt="<?php echo htmlspecialchars($record->getName()) ?>" />

            
            <div class="card-body">
                <h5 class="card-title" style="text-align:center;"><?php echo htmlspecialchars($record->name) ?></h5>
            </div>

            <div class="card-body">
                
                <div class="row">
                    
                    <div class="col">
                        <h4 style="text-align:center;">Reports</h4>
                            <h2 style="text-align:center;">1</h2>
                    </div>

                    <div class="col">
                        <h4 style="text-align:center;">Industries</h4>
                        <h2 style="text-align:center;">1</h2>
                    </div>

                </div>
            </div>
    
         
        </div>

       
    </div>

    <div class="col-md-8">

            <h4 style="text-align:center; font-size:1.rem;margin-top:1rem;"><?php echo I18n::__('user_reports') ?></h4>
            <button style="float:right;"><a href="/en/add-test-report"><?php echo I18n::__('add_new_test_report') ?></a></button>
            <div class="jumbotron jumbotron-fluid">
            
            <?php echo $usertestreports; ?>
  
</div>



        </div>

    </div>
    
    


</article>