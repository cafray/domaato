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
         
            <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 style="font-size:2rem;">Company Name</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>
        </div>

    </div>

</article>