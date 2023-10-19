<?php
/*
Plugin Name: eqeLoginForm
Plugin URI:  https://trecedenueve.com
Description: custom login form redirect to main page on enter or exit
Author:      esemaserre
Author URI:  
Version:     1.0
License:     GPL
*/
function eqe_stylesCss(){
    wp_register_style( 'eqe_loginFormCss', plugins_url( 'eqeloginform.css', __FILE__ ));
    wp_enqueue_style( 'eqe_loginFormCss' );
}

add_action( 'wp_enqueue_scripts', 'eqe_stylesCss' );

function eqe_login_form( ) {
    $redirect_login = get_home_url( );
    $redirect_logout = get_home_url( );

    if( !is_user_logged_in(  )) {
        $args = array(
            'echo' => false,
            'redirect' => $redirect_login,
            'form_id' => 'eqe-loginForm',
            'label_username' => __( 'Username' ),
        );
        return wp_login_form( $args );
    
    }else{
        $current_user = wp_get_current_user();
        $url_logout = wp_logout_url( $redirect_logout);

        $str = get_avatar( $current_user->user_email, 24) . ' ';
        $str .= 'Bienvenido ' . $current_user->display_name . '<br />';
        $str .= '<a href="' . $url_logout . '">desconectar</a>';

        return $str;
    }
}

function eqe_add_login_shortcode(){
    add_shortcode( 'eqeloginform', 'eqe_login_form' );
}

add_action( 'init', 'eqe_add_login_shortcode');