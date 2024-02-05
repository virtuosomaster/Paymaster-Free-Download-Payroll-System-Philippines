jQuery(document).ready(function($){
	$('#summernote').summernote({
		// placeholder: 'Content Here',
		tabsize: 2,
		height: 120,
		toolbar: [
		['style', ['style']],
		['font', ['bold', 'underline', 'clear']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		['table', ['table']],
		['insert', ['link', 'picture', 'video']],
		['view', ['fullscreen', 'codeview', 'help']]
		]
	});

	$( '#optTemplate' ).on('change', function( e ){
		var memo = $(this).val();	
		jQuery.get('/templates/memo/'+memo+'.tpl.html', function(data) {
			$('#summernote').summernote('code', data );
		}, 'text' );
	});
	
	$( '.add-template' ).on('click', function( e ){
		e.preventDefault();
		var memo = $(this).data('memo');	
		jQuery.get('/templates/memo/'+memo+'.tpl.html', function(data) {
			$('#summernote').summernote('code', data );
		}, 'text' );
	});
	$( 'input[name="save_document"]' ).on('click', function( e ){
		if ( $('#summernote').summernote('isEmpty')) {
			alert('Document content is empty');
		}
	});

});