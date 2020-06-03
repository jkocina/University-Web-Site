<?php
//looping through posts
#Looping through blog posts using wordpress functions
# These are related to blog posts
#  have_posts()
#  the_title()
#  the_content()
#  the_permalink() goes to > single.php, which will render a single blog. dataset available identified by the query string.  
#                            #index.php if single is not present

    while(have_posts()) {
        the_post() 
?>
   
    <h2><a href="<?= the_permalink(); ?>"><?= the_title()   ?></a></h2>
    <p><?=  the_content() ?></p> 
    <hr>
   
<?php
    }
?>


<?php
#page is only used for individual pages, not blog posts
#this is a template file

    get_header();


    while(have_posts()) {
        the_post() 
        ?>
        
        <h2><?= the_title()   ?></h2>
        <p><?=  the_content() ?></p> 
        <hr>
        
        <?php

    }

    get_footer();


?>