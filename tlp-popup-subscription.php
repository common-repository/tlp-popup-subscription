<?php
/**
 * @package TLP_Popup_Subscription
 * @version 1.0
 */

/*
Plugin Name: TLP Popup Subscription
Plugin URI: http://www.techlabpro.com
Description: Popup, pop, Subscription, newsletter, email, fancybox, frontpage.
Author: techlabpro1
Author URI: http://www.techlabpro.com
Version: 1.0
*/

define( 'TPL_POPUP_SUB_VERSION', '1.0' );
define(	'TPL_POPUP_SUB_TITLE', 'TLP Popup Subscription');
define( 'TPL_POPUP_SUB_SLUG', 'tpl_popup_subscription');
define( 'TPL_POPUP_SUB_PLUGIN_PATH', dirname( __FILE__ ));
define( 'TPL_POPUP_SUB_PLUGIN_URL', plugins_url( '' , __FILE__ ));

if(!class_exists('TLPpopupsub')):
/**
*
*/
class TLPpopupsub
{

	function __construct()
	{
		$data = get_option('tlp_popup_subscription');
		$e = (@$data['tlp_popup_enable'] ? @$data['tlp_popup_enable'] : null);
		if($e){
			add_action( 'wp_footer', array($this, 'fancy_model') );
			add_action( 'wp_enqueue_scripts', array($this,'tlp_popup_scripts' ));
		}
		add_action('admin_menu', array($this,'tlppopupsub_menu'));
	}

	function tlppopupsub_menu(){
		add_submenu_page('options-general.php', 'TLP Popup Subscription', 'TLP Popup', 'manage_options', 'tlp-popup-subscription', array($this, 'tlp_popup_page'));
	}

	function tlp_popup_page(){
		require_once('tlp-popup-settings.php');
	}


	function tlp_popup_scripts(){
		$data = get_option('tlp_popup_subscription');
		$location = (@$data['tlp_popup_location'] ? @$data['tlp_popup_location'] : 'front');
		if($location == 'front'){
			if(is_home() || is_front_page()){
				$this->loadScript();
			}
		}else{
			$this->loadScript();
		}
	}

	function loadScript(){
		wp_enqueue_style( 'tlp_popup_sub_fancybox_css', TPL_POPUP_SUB_PLUGIN_URL .'/assets/vendor/fancybox/source/jquery.fancybox.css' );
		wp_enqueue_style( 'tlp_popup_sub_custom_css', TPL_POPUP_SUB_PLUGIN_URL .'/assets/css/popup_custom.css' );

		wp_enqueue_script( 'tlp_popup_sub_fancybox_js', TPL_POPUP_SUB_PLUGIN_URL .'/assets/vendor/fancybox/source/jquery.fancybox.pack.js', array('jquery'), '', true );
		wp_enqueue_script( 'tlp_popup_sub_cookie_js', TPL_POPUP_SUB_PLUGIN_URL .'/assets/js/jquery.cookie.js', array('jquery'), '', true );
		wp_enqueue_script( 'tlp_popup_sub_custom_js', TPL_POPUP_SUB_PLUGIN_URL .'/assets/js/popup_custom.js', array('jquery'), '', true );
		$data = get_option('tlp_popup_subscription');
		$ltime = (@$data['tlp_popup_load_time'] ? @$data['tlp_popup_load_time'] : 5);
		$stime = (@$data['tlp_popup_session_time'] ? @$data['tlp_popup_session_time'] : 24);
		$ph = (@$data['tlp_popup_height'] ? (int)@$data['tlp_popup_height'] : 70);
		$pw = (@$data['tlp_popup_width'] ? (int)@$data['tlp_popup_width'] : 70);
		wp_localize_script( 'tlp_popup_sub_custom_js', 'tlp_popup_sub', array(
			'load'=> (int)$ltime,
			'session'=> (int)$stime,
			'pw'	=> (int)$pw,
			'ph'	=> (int)$ph,
			) );
	}

	function fancy_model(){
		$data = get_option('tlp_popup_subscription');
		$location = (@$data['tlp_popup_location'] ? @$data['tlp_popup_location'] : 'front');
		if($location == 'front'){
			if(is_home() || is_front_page()){
				$this->LoadFacyCode();
			}
		}else{
			$this->LoadFacyCode();
		}

	}

	function LoadFacyCode(){
		$html = null;
		$html .= '<a class="tlp_popup" href="#tlp_opoup_model" style="display: none"></a>';
		$html .= '<div id="tlp_opoup_model" style="display: none">';
					$settings = get_option('tlp_popup_subscription');
					$c = $settings['tlp_popup_code'];
					if(@$c){
						$html .= htmlspecialchars_decode(stripslashes($c));
					}else{
						$html .= "<p>No popup content found</p>";
					}
		$html .='</div>';
		echo $html;
	}
}

global $TLPpopupsub;

$TLPpopupsub = new TLPpopupsub;

endif;
