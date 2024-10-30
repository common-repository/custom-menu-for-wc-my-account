<?php if (!defined('ABSPATH')) {
	exit; // Exit if directly accessed
}
/**
 * Fired during plugin activation
 */
if (!class_exists('WACMAddMenuClass')) {
	class WACMAddMenuClass {
		public function __construct() {
			/*Menu hook*/
			add_action('admin_menu', array($this, 'register_WACM_menu'));
			/*Register WP Admin Styling Scripts*/
			add_action('admin_enqueue_scripts', array($this, 'WACM_admin_enqueue'));
		}

		public function register_WACM_menu() {
			if (is_admin()) {
			  add_submenu_page('woocommerce','Add Account Menu','Add Account Menu','administrator','WACM_add_menu_page', array($this, 'WACM_add_menu_page') );
			} 
		}
		
		public function WACM_admin_enqueue($hook) {
			if ($hook == "woocommerce_page_WACM_add_menu_page") {
		if ( ! did_action( 'wp_enqueue_media' ) ) {wp_enqueue_media();}
			 wp_enqueue_style('WACM-global-css', WACM_URL . '/assets/css/global.css');
			 wp_enqueue_script('WACM-main',WACM_URL."assets/js/main.js","","",true);
			}
		}

		public function WACM_add_menu_page() {

			if (is_admin() && current_user_can('manage_options')) {
				require WACM_PATH.'/templates/add_menu_template.php';
			} else {
				_e('Denied ! Only admin can see this.', 'multi-countDown');
			}
		}

	public function WACM_add_menue() {

	if (!empty($_POST) && isset($_POST["my_cm_menu"])) {

	   foreach ($_POST['my_cm_menu'] as $key => $value) {
       $sslrf_repeter[] = array(
      'my_cm_menu' => $this->WACM_validator_function($_POST['my_cm_menu'][$key]),
      'my_cm_menu_position' => $this->WACM_validator_function($_POST['my_cm_menu_position'][$key]),
      'my_cm_menu_template' => $this->WACM_validator_function($_POST['my_cm_menu_template'][$key]));
       }

      $status = update_option("wc_custom_product_menu_list",$sslrf_repeter);

	     if ($status)
	     { 
	     	 global $wp_rewrite; 
			 $wp_rewrite->set_permalink_structure('/%postname%/'); 
			  update_option( "rewrite_rules", FALSE ); 
			 $wp_rewrite->flush_rules( true );

	     	_e('<div class="notice notice-success is-dismissible"><p>Record Updateed!</p></div>');
	     }

	  	else
	  	{
	  		_e('<div class="notice notice-warning is-dismissible"><p>No Changes Found!</p></div>');  
	  	}
	    	 }

	}

	public function getMenue() {

	$wc_custom_product = get_option('wc_custom_product_menu_list');
	return empty($wc_custom_product) ? array(1) : $wc_custom_product;

	}

	public function WACM_validator_function($field) {
		if (empty($field)) {
			return;
		}
		$field = sanitize_text_field($field);
		$field = trim($field);
		$field = stripslashes($field);
		$field = htmlspecialchars($field);
		return $field;
	}
}
	new WACMAddMenuClass();
}

