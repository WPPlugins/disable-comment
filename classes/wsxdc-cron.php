<?php

if (!class_exists('WSXDC_Cron')) {

    
    class WSXDC_Cron extends WSXDC_Module
    {
        protected static $readable_properties = array();
        protected static $writeable_properties = array();

        /*
         * Magic methods
         */

        /**
         * Constructor
         *
         * @mvc Controller
         */
        protected function __construct()
        {
            $this->register_hook_callbacks();
        }


        /*
         * Static methods
         */

        
        public static function add_custom_cron_intervals($schedules)
        {
            $schedules['adc_debug'] = array(
                'interval' => 5,
                'display' => 'Every 5 seconds'
            );

            $schedules['adc_ten_minutes'] = array(
                'interval' => 60 * 10,
                'display' => 'Every 10 minutes'
            );

            $schedules['adc_example_interval'] = array(
                'interval' => 60 * 60 * 5,
                'display' => 'Every 5 hours'
            );

            return $schedules;
        }

        /**
         * Fires a cron job at a specific time of day, rather than on an interval
         *
         * @mvc Controller
         */
        public static function fire_job_at_time()
        {
            $now = current_time('timestamp');

            // Example job to fire between 1am and 3am
            if ((int)date('G', $now) >= 1 && (int)date('G', $now) <= 3) {
                if (!get_transient('adc_cron_example_timed_job')) {
                    //WSXDC_CPT_Example::exampleTimedJob();
                    set_transient('adc_cron_example_timed_job', true, 60 * 60 * 6);
                }
            }
        }

        
        public static function example_job()
        {
            // Do stuff

            add_notice(__METHOD__ . ' cron job fired.');
        }


        
        public function register_hook_callbacks()
        {
            add_action('adc_cron_timed_jobs', __CLASS__ . '::fire_job_at_time');
            add_action('adc_cron_example_job', __CLASS__ . '::example_job');

            add_action('init', array($this, 'init'));

            add_filter('cron_schedules', __CLASS__ . '::add_custom_cron_intervals');
        }

        
        public function activate($network_wide)
        {
            if (wp_next_scheduled('adc_cron_timed_jobs') === false) {
                wp_schedule_event(
                    current_time('timestamp'),
                    'adc_ten_minutes',
                    'adc_cron_timed_jobs'
                );
            }

            if (wp_next_scheduled('adc_cron_example_job') === false) {
                wp_schedule_event(
                    current_time('timestamp'),
                    'adc_example_interval',
                    'adc_cron_example_job'
                );
            }
        }

       
        public function deactivate()
        {
            wp_clear_scheduled_hook('adc_timed_jobs');
            wp_clear_scheduled_hook('adc_example_job');
        }

        
        public function init()
        {
        }

       
        public function upgrade($db_version = 0)
        {
            /*
            if( version_compare( $db_version, 'x.y.z', '<' ) )
            {
                // Do stuff
            }
            */
        }

        
        protected function is_valid($property = 'all')
        {
            return true;
        }
    } // end WSXDC_Cron
}
