<?php
#this is a template file

?>
<!DOCTYPE html>
<html <?= language_attributes(); ?>>
  <head>
    <meta charset="<?= bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
        #this will run functions in functions.php added by the wp_enqueue function
        #this adds style sheets from style.css 
        #this allows wordpress to control the loading of files and assets
        wp_head(); 
    ?>    
  </head>
<body <?= body_class() ?>>
  

  <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left"><a href="<?= site_url() ?>"><strong>Fictional</strong> University</a></h1>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <?php 
              //  This will render the wp administered menu
              // wp_nav_menu(array(
              //   'theme_location'  =>  'headerMenuLocation'
              // ));
          ?>
          <ul>
            <!-- If the page is the about us page or the parent of the current page is the about us -->
            <li <?php if (is_page('about-us') or wp_get_post_parent_id(0) == 23) echo 'class="current-menu-item"'  ?>><a href="<?= site_url('/about-us') ?>">About Us</a></li>
            <li><a href="#">Programs</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">Campuses</a></li>
            <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"'  ?>><a href="<?= site_url('/blog') ?>">Blog</a></li>
          </ul>
        </nav>
        <div class="site-header__util">
          <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
          <a href="#" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>


