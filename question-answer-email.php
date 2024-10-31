<?php
/*
Plugin Name: Question Answer - Email
Plugin URI: http://pickplugins.com
Description: Awesome Email notification addon for Question and Answer plugin.
Version: 1.0.2
Author: pickplugins
Text Domain: question-answer-email
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class QuestionAnswerEmail{
	
	public function __construct(){
	
		$this->qa_email_define_constants();
		
		$this->qa_email_declare_classes();
		$this->qa_email_declare_actions();
		$this->qa_email_functions();
		$this->qa_email_loading_script();
		
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ));
	}
	
	public function load_textdomain() {

		$locale = apply_filters( 'plugin_locale', get_locale(), 'question-answer-email' );
		load_textdomain('question-answer-email',WP_LANG_DIR .'/question-answer/question-answer-email-'. $locale .'.mo');
		load_plugin_textdomain( 'question-answer-email', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' ); 
	}
	
	
	public function qa_email_functions() {
		
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/functions.php');
	}
	
	public function qa_email_loading_plugin() {
		
		add_action( 'activated_plugin', array( $this, 'redirect_welcome' ));
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/classes/class-admin-setup-wizard.php');
	}
	
	public function qa_email_loading_script() {
	
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
		add_action( 'admin_enqueue_scripts', array( $this, 'qa_email_admin_scripts' ) );
	}
	
	public function qa_email_declare_actions() {
	
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-question-submit.php');
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-question-published.php');
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-answer-published.php');		
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-question-solved.php');
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-question-unsolved.php');
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-comment-flag.php');
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-comment-unflag.php');		
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-answer-voteup.php');
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-answer-votedown.php');
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/actions/action-answer-comment.php');
	}
	
	public function qa_email_declare_classes() {
		
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/classes/class-menu.php');	
		require_once( QA_EMAIL_PLUGIN_DIR . 'includes/classes/class-templates-design.php');	
		
	}
	
	public function qa_email_define_constants() {
		
		$this->define('QA_EMAIL_PLUGIN_URL', plugins_url('/', __FILE__)  );
		$this->define('QA_EMAIL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		$this->define('QA_EMAIL_PLUGIN_NAME', 'Question Answer Email' );
		$this->define('QA_EMAIL_TEXTDOMAIN', 'question-answer-email' );
	}
	
	private function define( $name, $value ) {
		if( $name && $value )
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	public function qa_email_admin_scripts(){
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		
		wp_enqueue_script('qa_email_admin_js', plugins_url( '/assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'qa_email_admin_js', 'qa_email_ajax', array( 'qa_email_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		wp_enqueue_style('qa_email_paraAdmin', QA_EMAIL_PLUGIN_URL.'assets/admin/ParaAdmin/css/ParaAdmin.css');
		wp_enqueue_style('admin-style', QA_EMAIL_PLUGIN_URL.'assets/admin/css/style.css');
	}
	
	
} new QuestionAnswerEmail();