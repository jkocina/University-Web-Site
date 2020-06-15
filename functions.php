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

#When wordpress calls any query, this will pre customize the query
function university_adjust_queries($query) {
    
    $today = date('Ymd');
    
    //is admin will test if on the admin page
    //is post type archive will test the post type archive
    //is main query will test if its the default wordpress query loading on the page as opposed to a custom query
    if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
        
        //This will restrict the posts to page to one
        //$query->set('posts_per_page','1');    
        $query->set('meta_key', 'event_date'); //to sort by the date Custom Field)
        $query->set('orderby', 'meta_value_num'); // title for the title of the post, post-date is the default, use rand for random, use meta_value to sort by a custom field (like the date custom field we created)
        $query->set('order','ASC'); //Default is  DESC
        $query->set('meta_query', array( //Adding this will cause the query to only return values that are equal to or greater than today
                                        array(
                                            'key' => 'event_date',
                                            'compare' => '>=',
                                            'value' => $today, //date(Ymd)
                                            'type' => 'numeric'
                                            )
                                        )
                    );

    }
    

}
add_action('pre_get_posts', 'university_adjust_queries');

?>