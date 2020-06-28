<?php 
    //This is for all events
    //this is a tempalate file
    get_header();

?>

  <div class="page-banner">
    <!-- We get is good to use with php echo -->
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('images/ocean.jpg')?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All Events</h1>
      <div class="page-banner__intro">
        <p>See whats going on in our world.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
<?php

    while (have_posts()) {
        the_post();
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
        <p><?= wp_trim_words(get_the_content(), 18) ?> <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
      </div>
    </div>
<?php
    }
    
    echo "<br>" . paginate_links();
?>
  <hr class="section-break" >
  <p>Want to see whats been going on? Check out <a href="<?= site_url('past-events') ?>">Past Events</a></p>
  </div>

<?php 

    get_footer();

?>