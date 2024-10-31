<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class class_qa_email_menu  {
	
	public function __construct(){

		add_action( 'qa_action_admin_menus', array( $this, 'admin_menu' ), 12 );
    }
	
	public function admin_menu() {
		
		add_submenu_page( 'edit.php?post_type=question', __( 'Email Template', QA_EMAIL_TEXTDOMAIN ), __( 'Email Template', QA_EMAIL_TEXTDOMAIN ), 'manage_options', 'email_template', array( $this, 'email_template' ) );		

	}
	
	public function email_template(){
		include( QA_EMAIL_PLUGIN_DIR. 'includes/menus/email-template.php' );
	}	
	
} new class_qa_email_menu();

