<?php
    #single is only used for individual events
    #this is a template file
    get_header();
 ?>
 <!-- Page Banner  -->
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?= the_title() ?></h1>
      <div class="page-banner__intro">
        <p>Dont forget to replace me later</p>
      </div>
    </div>  
  </div>
  <!-- Content begins -->
  <div class="container container--narrow page-section">      
<?php


    while(have_posts()) {
        //Gets the post data ready for parsing 
        the_post();
?>

    <div class="generic-content"><?=  the_content() ?></div>
<?php

    /**  
    * The advanced custom fields plug-in enables access to a function called 
    * get_field, here the field name of the Related Programs group is 'related_programs' 
    * get_field will return an array of WP_Post Objects
    * alot of these custom plug-ins appear to add the values to the wp_posts table
    */
    $relatedPrograms = get_field('related_programs');
    
    /** This is some troubleshooting that was done to test the output of the related programs. 
     
     * print_r is a good was to see whats in a variable. Pre tag with maintain the array indentation of the print_r function
     * echo "<pre>";
     * echo print_r($relatedPrograms);
     * echo "</pre>";
     */

    if($relatedPrograms)  {
?>
    <hr class="section-break" >
    <h2 class="headline headline-medium">Subject(s) Taught</h2>
    <p>
<?php
            //Loop through all the related programs, they are a series of WP_Post Objects 
        foreach($relatedPrograms as $program)  {

            $lastKey =array_key_last($relatedPrograms);
          
            if($program === $relatedPrograms[$lastKey] ) {
            //get_the_title() can be passed a post id or a WP_Post Object
            //get_the_permalink can be passed a page id or a a WP_Post Object
?>
      <a href="<?= get_the_permalink($program) ?>"><?= get_the_title($program) ?></a>
<?php
            } else {
  ?>
      <a href="<?= get_the_permalink($program) ?>"><?= get_the_title($program) ?></a> /
  <?php
            }
        }
    }
?>
    </p>
  </div>
  <hr>
<?php
} //end single professor has posts

    get_footer();
?>