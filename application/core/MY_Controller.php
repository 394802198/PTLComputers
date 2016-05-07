<?php

class MY_Controller extends CI_Controller
{
    public function __construct( $config )
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');

        // Prevent Global Variable Cause Security Issues
        $manager = false;
        $wholesaler = false;
        $customer = false;
        if( ! isset( $_SESSION ) ) session_start();

        /* Session Validation */
        switch( $config['session'] )
        {
            case 'manager' :
                if ( ! isset( $_SESSION["manager"] ) )
                {
                    header('Location:/manager/login');
                }
                else
                {
                    $coreStatusModelQuery = $this->db->get('t_core_status');
                    $_SESSION['coreStatus'] = $coreStatusModelQuery->row_array();
                }
                break;
            case 'wholesaler' :
                if ( ! isset( $_SESSION["wholesaler"] ) )
                {
                    header('Location:/remarketing/login');
                }
                else
                {
                    $coreStatusModelQuery = $this->db->get('t_core_status');
                    $coreStatus = $coreStatusModelQuery->row_array();
                    if( $coreStatus['remarketing_state'] == 'maintain' )
                    {
                        if( isset( $_SESSION['wholesaler'] ) ) unset( $_SESSION['wholesaler'] );
                        header('Location:/remarketing/login');
                    }
                }
                break;
            case 'customer' :
                if ( ! isset( $_SESSION["customer"] ) )
                {
                    header('Location:/home');
                }
                else
                {
                    $coreStatusModelQuery = $this->db->get('t_core_status');
                    $coreStatus = $coreStatusModelQuery->row_array();
                    if( $coreStatus['estore_state'] == 'maintain' )
                    {
                        if( isset( $_SESSION['customer'] ) ) unset( $_SESSION['customer'] );
                        header('Location:/home');
                    }
                }
                break;
            default : break;
        };

        /* Role Validation */
        if( isset( $config['role'] ) )
        {
            switch ( $config['role'] )
            {
                case 'administrator' : $this->isCurrentManagerAdmin(); break;
                default : break;
            };
        }
    }

    // If manager role isn't admin then redirect to index page
    public function isCurrentManagerAdmin()
    {
        if( $_SESSION['manager']['role']=='administrator' )
        {
            return true;
        }
        else
        {
            header('Location:/manager');
        }
    }
}