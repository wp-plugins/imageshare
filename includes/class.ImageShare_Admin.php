<?php
/**
 * WordPress ImageShare Plug-in: Admin class
 *
 * @author		WPEssence
 * @copyright	2011 WPEssence
 * @website		wpessence.com
 * @see			WPMS_ImageShare
 */

class WPIS_ImageShare_Admin extends WPIS_ImageShare
{
	
	/**
	 * Load page
	 * @param string $page Page name
	 */
	public function page($page = '')
	{
		global $wpdb;
		
		$do = (in_array($_GET['do'], array('add', 'edit', 'configure', 'delete'))) ? $_GET['do'] : 'manage';
		$do_on = $_GET['on'];
		
		include WPAA_ABSPATH . '/admin/pages/' . $page . '.php';
	}
	
	/**
	 * Admin page: Options
	 */
	public function page_options()
	{
		$this->page('options');
	}
	
	/**
	 * Action: admin_menu
	 */
	public function action_admin_menu()
	{
		add_options_page('ImageShare', 'ImageShare', 'manage_options', $this->get_setting('unique_plugin_identifier'), array(&$this, 'page_options'));
	}
	
	/**
	 * Action: admin_head
	 */
	public function action_admin_head()
	{
	}
	
	/**
	 * Action: admin_init
	 */
	public function action_admin_init()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js');
		wp_enqueue_script('utils');
		wp_enqueue_script('colorpicker-jquery', $this->get_setting('plugin_url') . '/public/js/colorpicker.js', array('jquery'));
		wp_enqueue_style('colorpicker-jquery', $this->get_setting('plugin_url') . '/public/css/colorpicker.css');
		wp_enqueue_script('imageshare_admin', $this->get_setting('plugin_url') . '/public/js/admin.js', array('jquery'));
		wp_enqueue_style('jquery-ui-lightness', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/ui-lightness/jquery-ui.css');
		wp_enqueue_style('admin', $this->get_setting('plugin_url') . '/public/css/admin.css');
		
		register_setting($this->get_setting('options_prefix') . 'options', $this->get_setting('options_prefix') . 'icon');
		register_setting($this->get_setting('options_prefix') . 'options', $this->get_setting('options_prefix') . 'general');
		register_setting($this->get_setting('options_prefix') . 'options', $this->get_setting('options_prefix') . 'icons');
	}

}
?>