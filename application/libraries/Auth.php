<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth
{
    public function check_login()
    {
        $CI =& get_instance();
        $excluded_methods = ['dashboard/index', 'projek/login']; // Methods or controllers to be excluded

        // Get current method and controller
        $current_method = $CI->router->fetch_method();
        $current_controller = $CI->router->fetch_class();

        if (in_array("$current_controller/$current_method", $excluded_methods)) {
            return; // Skip authentication for excluded methods
        }

        // Regular authentication logic
        if (!$CI->session->userdata('logged_in')) {
            redirect('dashboard/index'); // Redirect to login page if not logged in
        }
    }
}
 ?>
