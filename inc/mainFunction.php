<?php if (!defined('ABSPATH')) {
    exit; // Exit if directly accessed
}

ini_set('max_execution_time', 0);

// ------------------
// 1. Add end_point

$wc_custom_menu_list = get_option('wc_custom_product_menu_list');

if ($wc_custom_menu_list != "" && !empty($wc_custom_menu_list)) {

function WACM_add_endpoint() {

global $wc_custom_menu_list;
foreach ($wc_custom_menu_list as $key => $value) 
    {
        add_rewrite_endpoint( str_replace(" ","-",strtolower($value['my_cm_menu'])) , EP_ROOT | EP_PAGES );
    }
}
  
add_action( 'init', 'WACM_add_endpoint' );
  

// ------------------
// 2. Add new query var
  
function WACM_query_vars( $vars ) {

global $wc_custom_menu_list;
foreach ($wc_custom_menu_list as $key => $value) 
    {
         $vars[] = str_replace(" ","-",strtolower($value['my_cm_menu']));
    }
    return $vars;
}

add_filter( 'query_vars', 'WACM_query_vars', 0 );
  


// ------------------
// 3. Add item in menue

function WACM_add_link_my_account( $items ) {

    global $wc_custom_menu_list;
    $my_items = array();

    foreach ($wc_custom_menu_list as $key => $value) 
    {
        $my_items[str_replace(" ","-",strtolower($value['my_cm_menu']))] = $value['my_cm_menu'];
    }

     $my_items = array_slice( $items, 0, $value['my_cm_menu_position'], true ) + $my_items + array_slice( $items, 1, count( $items ), true );

    return $my_items;
}

add_filter( 'woocommerce_account_menu_items', 'WACM_add_link_my_account' );



// ------------------
// 4. Add Templete in menu by end_point

 foreach ($wc_custom_menu_list as $key => $value) {
$my_pageId = $value['my_cm_menu_template']; $content = 'WACM_order_tracking_content';

add_action('woocommerce_account_'.str_replace(" ","-",strtolower($value['my_cm_menu'])).'_endpoint', function ($content) use ($my_pageId) {

    $is_child_theme = (is_child_theme() === false) ? get_template_directory() : get_stylesheet_directory();
    $page_template = get_post($my_pageId)->_wp_page_template;

    if ($page_template == "default") 
    {
        _e(apply_filters( 'the_content', get_the_content(null, false, $my_pageId)));
    }
    else
    { 
        include $is_child_theme.'/'.$page_template; 
    }

}, 10, 1);
}

}


?>