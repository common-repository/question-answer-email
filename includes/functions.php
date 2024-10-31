<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	

	add_filter( 'qa_filter_settings_options', 'qa_filter_settings_options_function', 10 );

	function qa_filter_settings_options_function( $options ){
	
		$section_options = array(
			
			'qa_email_on_question_submission'=>array(
				'css_class'=>'qa_email_on_question_submission',					
				'title'=>__('Send email on new question submission?',QA_EMAIL_TEXTDOMAIN),
				'option_details'=>__('Default: Yes.',QA_EMAIL_TEXTDOMAIN),					
				'input_type'=>'select',
				'input_values'=> 'yes',
				'input_args'=> array( 'no'=>__('No',QA_EMAIL_TEXTDOMAIN), 'yes'=>__('Yes',QA_EMAIL_TEXTDOMAIN),),
			),

			'qa_email_on_question_published'=>array(
				'css_class'=>'qa_email_on_question_published',					
				'title'=>__('Send email on new question published?',QA_EMAIL_TEXTDOMAIN),
				'option_details'=>__('Default: Yes.',QA_EMAIL_TEXTDOMAIN),					
				'input_type'=>'select',
				'input_values'=> 'yes',
				'input_args'=> array( 'no'=>__('No',QA_EMAIL_TEXTDOMAIN), 'yes'=>__('Yes',QA_EMAIL_TEXTDOMAIN),),
			),
			
			
			'qa_email_on_answer_published'=>array(
				'css_class'=>'qa_email_on_answer_published',					
				'title'=>__('Send email on new answer published?',QA_EMAIL_TEXTDOMAIN),
				'option_details'=>__('Default: Yes.',QA_EMAIL_TEXTDOMAIN),					
				'input_type'=>'select',
				'input_values'=> 'yes',
				'input_args'=> array( 'no'=>__('No',QA_EMAIL_TEXTDOMAIN), 'yes'=>__('Yes',QA_EMAIL_TEXTDOMAIN),),
			),			
			
			
			
			
			
			
			'qa_email_on_question_solved'=>array(
				'css_class'=>'qa_email_on_question_solved',					
				'title'=>__('Send email on question solved?',QA_EMAIL_TEXTDOMAIN),
				'option_details'=>__('Default: Yes.',QA_EMAIL_TEXTDOMAIN),					
				'input_type'=>'select',
				'input_values'=> 'yes',
				'input_args'=> array( 'no'=>__('No',QA_EMAIL_TEXTDOMAIN), 'yes'=>__('Yes',QA_EMAIL_TEXTDOMAIN),),
			),
			
			'qa_email_on_question_unsolved'=>array(
				'css_class'=>'qa_email_on_question_unsolved',					
				'title'=>__('Send email on question unsolved?',QA_EMAIL_TEXTDOMAIN),
				'option_details'=>__('Default: Yes.',QA_EMAIL_TEXTDOMAIN),					
				'input_type'=>'select',
				'input_values'=> 'yes',
				'input_args'=> array( 'no'=>__('No',QA_EMAIL_TEXTDOMAIN), 'yes'=>__('Yes',QA_EMAIL_TEXTDOMAIN),),
			),
			
			'qa_email_on_comment_flag'=>array(
				'css_class'=>'qa_email_on_comment_flag',					
				'title'=>__('Send email on comment flag status changed?',QA_EMAIL_TEXTDOMAIN),
				'option_details'=>__('Default: Yes.',QA_EMAIL_TEXTDOMAIN),					
				'input_type'=>'select',
				'input_values'=> 'yes',
				'input_args'=> array( 'no'=>__('No',QA_EMAIL_TEXTDOMAIN), 'yes'=>__('Yes',QA_EMAIL_TEXTDOMAIN),),
			),
			
			'qa_email_on_comment_unflagged'=>array(
				'css_class'=>'qa_email_on_comment_unflagged',					
				'title'=>__('Send email on comment unflag status changed?',QA_EMAIL_TEXTDOMAIN),
				'option_details'=>__('Default: Yes.',QA_EMAIL_TEXTDOMAIN),					
				'input_type'=>'select',
				'input_values'=> 'yes',
				'input_args'=> array( 'no'=>__('No',QA_EMAIL_TEXTDOMAIN), 'yes'=>__('Yes',QA_EMAIL_TEXTDOMAIN),),
			),			
			
			
			'qa_email_on_answer_voting'=>array(
				'css_class'=>'qa_email_on_answer_voting',					
				'title'=>__('Send email on answer vote?',QA_EMAIL_TEXTDOMAIN),
				'option_details'=>__('Default: Yes.',QA_EMAIL_TEXTDOMAIN),					
				'input_type'=>'select',
				'input_values'=> 'yes',
				'input_args'=> array( 'no'=>__('No',QA_EMAIL_TEXTDOMAIN), 'yes'=>__('Yes',QA_EMAIL_TEXTDOMAIN),),
			),
			
			
		);

		
		$options['<i class="fa fa-envelope" aria-hidden="true"></i> '.__('Email',QA_EMAIL_TEXTDOMAIN)] = apply_filters( 'qa_settings_section_notification', $section_options );
		return $options;
	}
	
	
	function qa_email_reset_template_data() {
		
		$template_name = $_POST['template_name'];
		
		$class_qa_email_templates_design = new class_qa_email_templates_design();
		$templates_data_ori = $class_qa_email_templates_design->qa_email_templates_data();
		
		$qa_email_templates_data = get_option( 'qa_email_templates_data' );

		if( $template_name == 'all' ) {
			
			$qa_email_templates_data = $templates_data_ori;
			
		}
		else {
			
			$qa_email_templates_data[ $template_name ] = $templates_data_ori[ $template_name ];
		}
		update_option( 'qa_email_templates_data', $qa_email_templates_data );
		
		die();
	}

	add_action('wp_ajax_qa_email_reset_template_data', 'qa_email_reset_template_data');
	add_action('wp_ajax_nopriv_qa_email_reset_template_data', 'qa_email_reset_template_data');
