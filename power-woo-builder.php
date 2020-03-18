<?php
	/*
	Plugin Name: Woo Builder
	Plugin URI: https://wordpress.org/plugins/woo-builder
	Description: Woo Builder is an elementor supported addons.
	Version: 1.0.0
	Author: Khalid Jubair
	Author URI: https://woobuilder.com/
	License: GPLv3 or later
    */
    
    if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly. 
    }
    
    require_once __DIR__ . '/vendor/autoload.php';
    final class WooBuilder{

        const version = '1.0';

        private function __construct() {
            $this->define_constants();
            register_activation_hook( __FILE__, [ $this, 'activate' ] );
            add_action( 'plugins_loaded', [ $this, 'init' ] );
        }

        public static function instance() {

            static $instance = false;
			if ( ! $instance ) {
				$instance = new self();
			}
            return $instance;

        }

        public function define_constants(){
            define('WOOBUILDER_VERSION', self::version);
            define('WOOBUILDER_FILE', __FILE__);
            define('WOOBUILDER_PATH', __DIR__);
            define('WOOBUILDER_URL', plugins_url('', WOOBUILDER_FILE));
            define('WOOBUILDER_ASSETS', WOOBUILDER_URL . '/assets');
        }

        public function init(){

            if( is_admin() ){
                new WooBuilder\Admin();
            }else{
                new WooBuilder\Frontend();
            }
            
        }

        public function activate(){
            $installed = get_option('woobuilder_installed');
            if(!$installed){
                update_option( 'woobuilder_installed', time() );
            }
            
            update_option( 'woobuilder_version', WOOBUILDER_VERSION );
        }
    }

    function woobuilder(){
        return WooBuilder::instance();
    }
    woobuilder();