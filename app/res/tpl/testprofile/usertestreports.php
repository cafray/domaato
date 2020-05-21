<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */

/**
 * Load the comments for this report.
 * 
 *  */ 

?>

<?php //var_dump($records) ?>

<?php foreach ($records as $record): ?>
        
    <div class="container">
    <h1 style="font-size:1rem;">Company ID: <?php echo $record->person_id ?></h1>
    <h1>Report: </h1><p class="lead"><?php echo $record->content ?></p>
    </div>
        
<?php endforeach; ?>




