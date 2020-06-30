<?php
    #single is only used for individual programs
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

    <!-- metabox -->
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?= get_post_type_archive_link('program') ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs </a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>
    <div class="generic-content"><?=  the_content() ?></div>

    <hr class="section-break">

<?php
    //This is were we list professors that teach this event
    $today = date('Ymd');

    $associatiedProfessors = New WP_Query(array(
        'posts_per_page' => -1, // -1 means all 
        'post_type' => 'professor',
        'meta_key' => '',
        'order' => 'ASC', //default is DESC
        'meta_query' => array( 
            array( 
              'key' => 'related_programs', // If multiple values, Wordpress will serialize the array. i.e. array(12, 120, 57) === a:3:{i:0;i:"12";i:1;i:"120";i:2;i:"1200";}
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"' // Gets the ID of the current program. Because the array of results are serialize, 
            )
        )
    )); 
    
    // this will echo out all the professors
    // echo "<pre>";
    // echo print_r($associatiedProfessors);
    // echo "</pre>";

    while($associatiedProfessors->have_posts()) {
        $associatiedProfessors->the_post();
?>

<?php

    }  wp_reset_postdata();
?>
<?php
    //This is were we list events that are related to the programs 
    $today = date('Ymd');

    $associatiedEvents = New WP_Query(array(
        'posts_per_page' => -1, // -1 means all 
        'post_type' => 'event',
        'meta_key' => 'event_date', //use meta key to sort by the event_date custom field
        'orderby' => 'meta_value_num', // choose title for the title of the post(maybe without the meta_key?), post-date is the default sort by, use rand for random sorting, use meta_value to sort by a custom field (like the event_date custom field we created)
        'order' => 'ASC', //default is DESC
        'meta_query' => array( //Adding this will cause the query to only return values that are equal to or greater than today and match the related programs field of the event with the current program ID
            array( //this matches dates later than today to avoid repeats 
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today, //date(Ymd)
              'type' => 'numeric'
            ),
            array( //
              'key' => 'related_programs', // If multiple values, Wordpress will serialize the array. i.e. array(12, 120, 57) === a:3:{i:0;i:"12";i:1;i:"120";i:2;i:"1200";}
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"' // Gets the ID of the current program. Because the array of results are serialize, 
            )
        )
    )); 
    
    //This will test and see if that are any posts in the associated events array
    if ($associatiedEvents->have_posts())  {

        echo "<h3 class=\"headline headline--medium\" style=\"margin-bottom:.6rem;\">Upcoming " . get_the_title(). " Events:</h3>";

        while($associatiedEvents->have_posts()) {

            $associatiedEvents->the_post();
?>
      <div class="event-summary">
        <a class="event-summary__date t-center" href="#">
          <span class="event-summary__month">
<?php
            //the_field and get_field are custom funtions made available be the Custom Fields plugin. 
            //the_fiels will echo out the field and get_field will just return it

            $eventDate = new DateTime(get_field('event_date'));
            echo $eventDate->format('M');
            //the_time('M') 
?>            
        </span>
        <span class="event-summary__day">
<?php 
            //the_field and get_field are custom funtions made available be the Custom Fields plugin. 
            //the_fiels will echo out the field and get_field will just return it
            $eventDate = new DateTime(get_field('event_date'));
            echo $eventDate->format('d'); 
            //the_time('d') 
?>
        </span>  
      </a>
      <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
        <p>
<?php

            if(has_excerpt()) {
                
                echo wp_trim_words(get_the_excerpt(), 21);  //using the_excerpt() will echo it out with a p tag
            } else {
                
                echo wp_trim_words(get_the_content(), 21); //using the_content() will echo it out with a p tag
            }      
?>              
          <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
      </div>
    </div>
<?php
        } wp_reset_postdata(); //ends the while loop
    }
?>  
  </div>
  <hr>

<?php
    }

    get_footer();
?>