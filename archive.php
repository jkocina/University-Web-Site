<?php 
    
    get_header();

?>

  <div class="page-banner">
    <!-- We get is good to use with php echo -->
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('images/ocean.jpg')?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
<?php

    the_archive_title();

    // if (is_category())  {
        
    //     single_cat_title();

    // } else if (is_author()) {

    //     the_author();
        
    // }
?>
      </h1>
      <div class="page-banner__intro">
        <p><?php the_archive_description(); ?></p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
<?php
    while (have_posts()) {
        the_post();
?>
    <div id="post-item">
      <h2><a class="headline headline--medium headline--post-title" href="<?= the_permalink() ?>"><?= the_title() ?></a></h2>
      <div class="metabox">
        <p>Post by: <?php the_author_posts_link() ?> on <?php the_time('M, d Y') ?> in <?= get_the_category_list(', ') ?></p>
      </div>
      <div class="generic-content"><?php the_excerpt() ?></div>
      <p><a class="btn btn--blue" href="<?= the_permalink() ?>">Read More</a></p>
    </div>
<?php
    }
    
    echo "<br>" . paginate_links();
?>
  </div>

<?php 

    get_footer();

?>