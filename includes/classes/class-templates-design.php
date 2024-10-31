<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class class_qa_email_templates_design  {
	
	public function __construct(){
		
    }
	
	public function qa_send_email($to_email='', $email_subject='', $email_body='', $attachments=''){
		
		$from_email = get_option('admin_email');

		$headers = "";
		$headers .= "From: ".$from_email." \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		return wp_mail($to_email, $email_subject, $email_body, $headers, $attachments);
	}	

	public function qa_email_templates_data(){
		
		$templates_data_html = array();
		
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/new_question_submitted.php');
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/new_question_published.php');
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/new_answer_submitted.php');		
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/new_answer_published.php');			
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/question_solved.php');
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/question_unsolved.php');
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/comment_flag.php');
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/comment_unflag.php');		
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/answer_voteup.php');
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/answer_votedown.php');	
		include( QA_EMAIL_PLUGIN_DIR . 'templates/templates-part/answer_comment.php');			
			
		
		$templates_data = array(
			
			'new_question_submitted'=>array( 
				'name'		=>__('New Question Submitted', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('New Question Submitted - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['new_question_submitted'],
			),
			
			'new_question_published'=>array(	
				'name'		=>__('New Question Published', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('New Question Published - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['new_question_published'],
			),	

			'new_answer_submitted'=>array(	
				'name'		=>__('New Answer Submitted', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('New Answer Submitted - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['new_answer_submitted'],
			),	

			'new_answer_published'=>array(	
				'name'		=>__('New Answer Published', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('New Answer Published - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['new_answer_published'],
			),	


			'question_solved'=>array(	
				'name'		=>__('Question solved', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('Question solved - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['question_solved'],
			),	

			'question_unsolved'=>array(	
				'name'		=>__('Question unsolved', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('Question unsolved - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['question_unsolved'],
			),	

			'comment_flag'=>array(	
				'name'		=>__('Comment flag', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('Comment flagged - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['comment_flag'],
			),	
			
			'comment_unflag'=>array(	
				'name'		=>__('Comment unflag', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('Comment unflagged - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['comment_unflag'],
			),				
			

			'answer_voteup'=>array(	
				'name'		=>__('Answer Voted Up', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('Answer voted up - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['answer_voteup'],
			),	

			'answer_votedown'=>array(	
				'name'		=>__('Answer Voted Down', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('Answer voted down - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['answer_votedown'],
			),	


			'answer_comment'=>array(	
				'name'		=>__('Answer Comment', QA_EMAIL_TEXTDOMAIN),
				'subject'	=>__('New Comment on Answer - {site_url}', QA_EMAIL_TEXTDOMAIN),
				'html'		=>$templates_data_html['answer_comment'],
			),	

				
			
		);
		
		$templates_data = apply_filters('qa_email_filters_templates_data', $templates_data);
		
		return $templates_data;
	}
	
	
	public function qa_email_templates_parameters(){
		
		$parameters['site_parameter'] = array(
			'title'=>__('Site Parameters', QA_EMAIL_TEXTDOMAIN),
			'parameters'=>array('{site_name}','{site_description}','{site_url}','{site_logo_url}'),										
		);
		
		$parameters['user_parameter'] = array(
			'title'=>__('Users Parameters', QA_EMAIL_TEXTDOMAIN),
			'parameters'=>array('{user_name}','{user_avatar}','{user_email}'),										
		);	

		$parameters['question_parameter'] = array(
			'title'=>__('Question Parameters', QA_EMAIL_TEXTDOMAIN),
			'parameters'=>array('{question_id}','{question_edit_url}','{question_title}','{question_shortcontent}','{question_url}'),										
		);										
		
		$parameters = apply_filters('qa_email_templates_parameters',$parameters);
		
		return $parameters;
	}
	
} new class_qa_email_templates_design();

