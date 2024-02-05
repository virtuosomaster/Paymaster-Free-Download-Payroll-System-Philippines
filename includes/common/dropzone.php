<?php
include_once "./../database.php";
define('TIMEZONE_DIFF', 50400 ); // Manila Timezone defference 14hours ( - 50400 )
define('LOGOUT_DIFF_ALLOW', 1800 ); // 30 Minutes logout allowace
date_default_timezone_set("Asia/Manila");
include_once "./../ezsql/ez_sql_core.php";
include_once "./../ezsql/ez_sql_mysqli.php";
$paycheck = new ezSQL_mysqli( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
require_once( './../lib/class-files.php' );



if( isset( $_POST['action'] ) && $_POST['action'] == 'submit_dropzonejs' ){
    date_default_timezone_set('Asia/Manila');
    $target_dir = "uploads/".trim( preg_replace( '/[^a-z0-9]/i', '', $_POST['dirname'] ) )."/";
    if( !file_exists( $target_dir ) ){
        mkdir( __DIR__.'/'.$target_dir );
    }
    $file_name      = basename($_FILES["file"]["name"]);
    $file_type      = $_FILES["file"]["type"];
    $target_file    = $target_dir . $file_name;
    $file_data      = array('Testing');
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
        $employee_files = new EmpFiles;
        $file_data  = array(
            'uid'       => 1,
            'type'      => $file_type,
            'file_name' =>  $file_name
        );
        //$employee_files->insert( $file_data );
        $status = 1;

        // $sql = "INSERT INTO `".$this->tableName."` ( ".$table_column." ) VALUES ( ".$table_value." )";
		// $paycheck->query( $sql );
		// $inserted_id = $paycheck->insert_id;
    }

    // echo json_encode( $_FILES['file'] );
    echo json_encode( $file_data  );

	die();
}