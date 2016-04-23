<?php
function find_wp_config_path() {
    $dir = dirname(__FILE__);
    do {
        if( file_exists($dir."/wp-config.php") ) {
            return $dir;
        }
    } while( $dir = realpath("$dir/..") );
    return null;
}
if ( ! function_exists('add_action') ) {
    include_once( find_wp_config_path()  . '/wp-load.php' );
}

class Render {
	function view( $file_name, $data = null )
	{
		if( is_array($data) ) {
			extract($data);
		}

		include WP_EGRIDS_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR. $file_name;
		//if(isset($_SESSION['quiz_flash'])){ unset($_SESSION['quiz_flash']); }
	}
}
?>