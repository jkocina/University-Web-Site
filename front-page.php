<?php
    
    get_header();
?>

<?php 

    //When a function starts with the, wordpress will echo
    // the_title();

    // //when a function starts with get, wordpress will not echo
    // get_the_title();

    // the_ID();
    // get_the_id();

?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('images/library-hero.jpg') ?> );"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Welcome!</h1>
      <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
      <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
      <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
  </div>

  <div class="full-width-split group">
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Upcoming Events</h2> 
<?php
    
    $homepageEvents = new WP_Query(array(
          'posts_per_page' => -1, // -1 means all 
          'post_type' => 'event',
          'meta_key' => 'event_date', //to sort by the date Custom Field
          'orderby' => 'meta_value_num', // title for the title of the post, post-date is the default, use rand for random, use meta_value to sort by a custom field (like the date custom field we created)
          'order' => 'ASC' //default is DESC
    )); 

    while($homepageEvents->have_posts()) {
        
        $homepageEvents->the_post();
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
    } wp_reset_postdata();
?>        
          <p class="t-center no-margin"><a href="<?= get_post_type_archive_link('event') ?>" class="btn btn--blue">View All Events</a></p>

      </div>
    </div>
    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
<?php

  //WP Queries are are cool and customizable
  $homepagePosts = new WP_Query(array(
      'posts_per_page'  =>  2

  ));


  while($homepagePosts->have_posts())  {
      $homepagePosts->the_post();

?>
        <div class="event-summary">
          <a class="event-summary__date t-center" href="<?php the_permalink() ?>">
            <span class="event-summary__month"><?php the_time('M') ?></span>
            <span class="event-summary__day"><?php the_time('d') ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
            <p>
<?php
    if(has_excerpt()) {
      echo wp_trim_words(get_the_excerpt(), 21);  //the_excerpt() will echo it out in a p tag
    } else {
      echo wp_trim_words(get_the_content(), 21); //the_content() will echo it out in a p tag
    }
?> 
              <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a>
            </p>
          </div>
        </div>
        
    
<?php

    } wp_reset_postdata();
?>
    <p class="t-center no-margin"><a href="<?= site_url('/blog') ?>" class="btn btn--yellow">View All Blog Posts</a></p> 
        <!-- 
        <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="#">
            <span class="event-summary__month">Jan</span>
            <span class="event-summary__day">20</span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="#">We Were Voted Best School</a></h5>
            <p>For the 100th year in a row we are voted #1. <a href="#" class="nu gray">Read more</a></p>
          </div>
        </div>
        <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="#">
            <span class="event-summary__month">Feb</span>
            <span class="event-summary__day">04</span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="#">Professors in the National Spotlight</a></h5>
            <p>Two of our professors have been in national news lately. <a href="#" class="nu gray">Read more</a></p>
          </div>
        </div>
        
        <p class="t-center no-margin"><a href="#" class="btn btn--yellow">View All Blog Posts</a></p> 
        -->
      </div>
    </div>
  </div>

  <div class="hero-slider">
  <div class="hero-slider__slide" style="background-image: url(<?= get_theme_file_uri('images/bus.jpg') ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Free Transportation</h2>
        <p class="t-center">All students have free unlimited bus fare.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?= get_theme_file_uri('images/apples.jpg') ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
        <p class="t-center">Our dentistry program recommends eating apples.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?= get_theme_file_uri('images/bread.jpg') ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Free Food</h2>
        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
</div>

<?php
    get_footer();
?>