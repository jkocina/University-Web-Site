<?php
#page is only used for individual pages, not blog posts
#this is a template file

    get_header();

    //This is alot similiar to how a single blog post page loops
    while(have_posts()) {
        the_post(); 
?>
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('images/ocean.jpg')?>);"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?= the_title() ?></h1>
    <div class="page-banner__intro">
      <p>Dont forget to replace me later</p>
    </div>
  </div>  
</div>

  <div class="container container--narrow page-section">
<?php

    //this is how to test for a parent page
    //echo get_the_ID();

    //echo wp_get_post_parent_id(get_the_ID());
    

    //This will test if the current page has a parent page (is it a child?)
    $theParent = wp_get_post_parent_id(get_the_ID());

    if ($theParent) {
?>
    
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?= get_permalink($theParent) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?= get_the_title($theParent) ?></a> <span class="metabox__main"><?= the_title() ?></span></p>
    </div>

<?php 
    } else {
      //debug testing as not the about us page 
    }
?>

<?php

    //The will test if the current page has any child pages
    $testArray  =  get_pages(array(
        'child_of'  =>  get_the_ID()
    ));

    if($theParent or $testArray)  { ?>

    <!-- This is the side panel for child page navigation -->
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?= get_permalink($theParent) ?>"><?= get_the_title($theParent) ?></a></h2>
      <ul class="min-list">
<?php
      
        if($theParent) {    
            $rootOftarget = $theParent;
        } else {
            $rootOftarget = get_the_ID();
        }

        wp_list_pages(
            array(
                'child_of'    =>   $rootOftarget,
                'title_li'    =>   NULL
            )
        );
    }
?>
        <!--<li class="current_page_item"><a href="#">Our History</a></li>
        <li><a href="#"><?= the_title() ?></a></li>-->
      </ul>
    </div>
    
    <div class="generic-content">
      <?php the_content(); ?>
    </div>
<?php
    //why is the while loop ending right here?
    }
    get_footer();
?>