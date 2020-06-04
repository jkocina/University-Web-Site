<?php
#single is only used for individual blogposts
#this is a template file

    get_header();

    while(have_posts()) {
        //Gets the post data ready for parsing 
        the_post();
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
    <!-- metabox -->
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?= get_post_type_archive_link('event') ?>"><i class="fa fa-home" aria-hidden="true"></i> Event Home </a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>

    <div class="generic-content"><?=  the_content() ?></div>
  
  </div>
  <hr>

<?php
    }

    get_footer();
?>