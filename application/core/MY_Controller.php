<?php

class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        //$this->output->cache(30);

        $config_results = $this->db->get('config')->result();
        foreach ($config_results as $my_config) {
            $this->config->set_item($my_config->config_key, $my_config->config_value);
        }


        $timezone = config_item('timezone');
        if (empty($timezone)) {
            $timezone = 'Australia/Sydney';
        }
        date_default_timezone_set($timezone);
        //set_mysql_timezone($timezone);
        //check_installation();
    }
}
