<?php
/*
Plugin Name: CFS - Hyperlink Add-on
Plugin URI: http://uproot.us/
Description: The hyperlink field type for Custom Field Suite (add-on).
Version: 1.0.0
Author: Matt Gibbs
Author URI: http://uproot.us/
License: GPL2
*/

$cfs_hyperlink_addon = new cfs_divider_addon();

class cfs_divider_addon
{
    function __construct()
    {
        add_filter('cfs_field_types', array($this, 'cfs_field_types'));
    }

    function cfs_field_types($field_types)
    {
        $field_types['hyperlink'] = dirname(__FILE__) . '/hyperlink.php';
        return $field_types;
    }
}
