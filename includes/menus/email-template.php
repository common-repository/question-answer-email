<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class class_qa_email_settings_page  {
	
	
    public function __construct(){
		
    }
	
	public function qa_email_settings_options_form(){
		
		$class_qa_email_templates_design = new class_qa_email_templates_design();
		
		$qa_email_templates_data = get_option( 'qa_email_templates_data' );
			
		if( empty( $qa_email_templates_data ) ) {
			
			$templates_data = $class_qa_email_templates_design->qa_email_templates_data();
		} else {

			$templates_data = $class_qa_email_templates_design->qa_email_templates_data();
			$templates_data =array_merge($templates_data, $qa_email_templates_data);
		
		} 
		
		
		// $class_qa_email_templates_design = new class_qa_email_templates_design();
		// $qa_email_templates_data = $class_qa_email_templates_design->qa_email_templates_data();
		
		// echo '<pre>'; print_r( $qa_email_templates_data ); echo '</pre>';
		
		
		
		?>
		
		<div id="button_reset_email_template" class="button_reset_email_template_all" _confirm="no" template_name="all"><i class="fa fa-refresh"></i> <?php echo __('Reset all', QA_EMAIL_TEXTDOMAIN); ?> </div>
		
		<br /> <br />
		<div class="templates_editor expandable">
		
		<?php foreach( $templates_data as $key => $templates ) { ?>
				
		<div class="items template <?php echo $key; ?>">
			
			<div class="header">
	
				<span class="remove"><i class="fa fa-times"></i></span>
				<span><?php echo $templates['name']; ?></span>
				<span id="button_reset_email_template" class="button_reset_email_template_single" _confirm="no" template_name="<?php echo $key; ?>"><i class="fa fa-refresh"></i> <?php echo __('Reset', QA_EMAIL_TEXTDOMAIN); ?></span>
				
			</div>
			<input type="hidden" name="qa_email_templates_data[<?php echo $key; ?>][name]" value="<?php echo $templates['name']; ?>" />		
			
			<div class="options">
				
				
				
				
				<label><?php echo __('Email Subject:', QA_EMAIL_TEXTDOMAIN); ?><br/>
				<input type="text" name="qa_email_templates_data[<?php echo $key; ?>][subject]" value="<?php echo $templates['subject']; ?>" style="width:100%" />
				</label>
				
				<br><br/><label><?php echo __('Email Body:', QA_EMAIL_TEXTDOMAIN); ?></label>
				<?php ob_start();
				wp_editor( $templates['html'], $key, $settings = array('textarea_name'=>'qa_email_templates_data['.$key.'][html]','media_buttons'=>false,'wpautop'=>true,'teeny'=>true,'editor_height'=>'400px', ) );				
				echo ob_get_clean(); ?>
					
				
			</div>
			
		</div>
		<?php } ?>
		
		</div>
		
		<?php
	}

} new class_qa_email_settings_page();

	$class_qa_email_templates_design 	= new class_qa_email_templates_design();
	$class_qa_email_settings_page 		= new class_qa_email_settings_page();
	
	$is_form_submitted = ( isset( $_POST['qa_email_hidden'] ) && $_POST['qa_email_hidden'] == 'Y' ) ? true : false;

	if( $is_form_submitted ) {
		
		$qa_email_templates_data = stripslashes_deep($_POST['qa_email_templates_data']);
		update_option( 'qa_email_templates_data', $qa_email_templates_data );
		
		?><div class="updated"><p><strong><?php _e('Changes Saved.', QA_EMAIL_TEXTDOMAIN ); ?></strong></p></div> <?php	
		
	} else {
		$qa_email_templates_data = get_option( 'qa_email_templates_data' );
	}
	
	
	?> 	
	
	<div class="wrap">
		<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".sprintf(__('%s - Templates', QA_EMAIL_TEXTDOMAIN), QA_EMAIL_PLUGIN_NAME)."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
			<input type="hidden" name="qa_email_hidden" value="Y">
			
            <br /><br />
			<div class="para-settings job-bm-emails-templates">
			
			<?php settings_fields( 'qa_email_plugin_options' );
			do_settings_sections( 'qa_email_plugin_options' );
				
			echo $class_qa_email_settings_page->qa_email_settings_options_form();  ?>

			</div>
			
			<p class="submit"> <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes', QA_EMAIL_TEXTDOMAIN ); ?>" /> </p>
		</form>
		

		<div class="parameters"><ul>
		
		<?php foreach( $class_qa_email_templates_design->qa_email_templates_parameters() as $key=>$parameter ) { ?>
			
		<li><br /><b><?php echo $parameter['title']; ?></b>
			
		<?php foreach( $parameter['parameters'] as $parameter_name ) { ?>
		<li><?php echo $parameter_name; ?> </li>
		<?php } ?>
			
		</li>
			
		<?php } ?>
			
		</ul></div>
		
		
		
	</div>
