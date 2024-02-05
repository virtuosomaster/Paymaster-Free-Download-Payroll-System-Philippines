jQuery(document).ready(function($){
  /**
   * get input fields that are required
   */
  $('input').each(function(){
    let $this = $(this);
    if( $this.prop('required') ){
      let label = $this.prev('label');
      if( label ) {
        label.append('<span class="text-danger">*</span>');
      }
    }
});

});