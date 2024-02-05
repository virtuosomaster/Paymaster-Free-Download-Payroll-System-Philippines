<?php require_once('./../config.php'); 
$memo         = new Memo;
if( isset( $_POST['save_document'] ) ){
    $data = array(
        'created_by'    => pa_get_current_user(),
        'assigned_to'   => $_POST['assigned_employee'],
        'subject'       => $_POST['subject'],
        'content'       => $_POST['summernote']
    );
    $result = $memo->save( $data );

    $fname 		= $employee->get_user_data_by_id( (int)$_POST['assigned_employee'], 'fname' );
    $lname 		= $employee->get_user_data_by_id( (int)$_POST['assigned_employee'], 'lname' );
    $email 		= $employee->get_user_info_by_id( (int)$_POST['assigned_employee'], 'email' );

    ob_start();
    ?>
    <p style="margin-bottom:24px!important;">Hi <?php echo $fname.' '.$lname; ?>,</p>
    <p>A memo <?php echo $_POST['subject']; ?> has been issued to you.</p>
    <p>Please login to you account </p>
    <p>and affix your signature.</p>
    <?php
    $message = ob_get_clean();
    send_mail( 'Admin notification - '.$_POST['subject'], $message, $email );

    header('Location: '.$siteHostAdmin.'add-document.php?submit=true&status='.$result );
}else{
    header('Location: '.$siteHostAdmin.'404.php' );
}
?>