<?php
#this file is used to talk with features of wordpress. controller

function university_files() {
    
    #load scripts
    #microtime is a timer to set a unique version number to stop caching
    wp_enqueue_script('mainJS', get_theme_file_uri('js/scripts-bundled.js'), 'null', microtime(), true);

    #Google Fonts
    wp_enqueue_style('google_fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

    #font awesome
    wp_enqueue_style('font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    #uploads a css file
    # NULL for dependencies and microtime fake version to stop caching
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime());
    #wp_enqueue_style('university_main_styles', '/css/style.css', NULL, microtime());

    #wp_enqueue_script('university_main_styles', get_stylesheet_uri());

    
}

#run functions like this before pages load
#Takes 2 arguments
add_action('wp_enqueue_scripts','university_files');



#add features, some built in 
function university_features() {

    #Built in wordpress feature to enable administering menus from wordpress
    #This is the header menu
    // register_nav_menu('headerMenuLocation','Main Header Menu');

    #this is the footer menu
    // register_nav_menu('footerLocationOne','Footer Location One');
    // register_nav_menu('footerLocationTwo','Footer Location Two');

    #adding a built in wordpress feature
    add_theme_support('title-tag');

}

#This gets loaded after the website
add_action('after_setup_theme','university_features');

?>