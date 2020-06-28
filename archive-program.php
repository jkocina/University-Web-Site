<?php 
    //This is for all programs 
    //this is a tempalate file
    get_header();

?>

  <div class="page-banner">
    <!-- We get is good to use with php echo -->
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('images/ocean.jpg')?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All Programs</h1>
      <div class="page-banner__intro">
        <p>Can you handle what we offer?</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <ul class="link-list min-list">
<?php

    while (have_posts()) {
        the_post();
?>
      <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
<?php
    }
    echo "<br>" . paginate_links();
?>
    </ul>
  </div>

<?php 

    get_footer();

?>