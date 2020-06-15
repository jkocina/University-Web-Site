<?php 
    
    get_header();

?>

  <div class="page-banner">
    <!-- We get is good to use with php echo -->
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('images/ocean.jpg')?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Past Events</h1>
      <div class="page-banner__intro">
        <p>All events that have gone by.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
<?php
    
    $today = date('Ymd');

    $pastEvents = new WP_Query(array(
          // paged configures the results for pagination, the value is going to be the amount of pages, which can be retieved from the method identifying the paged value
          'paged' => get_query_var('paged', 1), //This will get the value at the end of the query string. When paginated the page number will show at the end of the query, in this case, the value of "paged" which holds how many pages there are. if wordpress cant find the page number dynamically, it sticks to one. 
          //'posts_per_page' => 1, // -1 means all. defaults to 10 
          'post_type' => 'event',
          'meta_key' => 'event_date', //to sort by the date Custom Field
          'orderby' => 'meta_value_num', // title for the title of the post, post-date is the default, use rand for random, use meta_value to sort by a custom field (like the date custom field we created)
          'order' => 'ASC', //default is DESC
          'meta_query' => array( //Adding this will cause the query to only return values that are equal to or greater than today
              array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today, //date(Ymd)
                'type' => 'numeric'
              )
          ) 
    ));

    while ($pastEvents->have_posts()) {
        $pastEvents->the_post();
?>
    <div class="event-summary">
      <a class="event-summary__date t-center" href="#">
        <span class="event-summary__month">
<?php
    //the_field and get_field are custom funtions made available be the Custom Fields plugin. 
    //the_fiels will echo out the field and get_field will just return it
    
    $eventDate = new DateTime(get_field('event_date'));
    echo $eventDate->format('M');
    
    //This is hard coded
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
    
    echo "<br>" . paginate_links(array(
      'total' => $pastEvents->max_num_pages
    ));
?>
  </div>

<?php 

    get_footer();

?>