jQuery(document).ready(function($) {

	$(document).on('click', '#button_reset_email_template', function() {
		
		var _confirm = $(this).attr("_confirm"); 
		
		if( _confirm == 'no' ) {
			
			$(this).attr( '_confirm', 'yes' );
			$(this).html( '<i class="fa fa-hand-o-up"></i> Confirm' );
			
			return;
		}
		
		var template_name = $(this).attr("template_name"); 
		
		$(this).parent().addClass('reseting');
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_email_ajax.qa_email_ajaxurl,
		data: { "action": "qa_email_reset_template_data",'template_name':template_name },
		success: function( data ) {	
		
			location.reload();
		}
			});
		
	})
	
	
});	







