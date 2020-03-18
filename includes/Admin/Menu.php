<?php

namespace WooBuilder\Admin;

class Menu {

    function __construct(){
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu(){
        add_menu_page( __('Woo Builder', 'woobuilder'), __('Woo Builder', 'woobuilder'), 'manage_options', 'woobuilder', [$this, 'plugin_page'], 'dashicons-editor-contract', null );
    }

    public function plugin_page(){
        echo 'Hello World';
    }
    
}