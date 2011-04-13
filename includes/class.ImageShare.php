<?php
/**
 * WordPress ImageShare Plug-in: Main class
 *
 * @author		WPEssence
 * @copyright	2011 WPEssence
 * @website		wpessence.com
 */

class WPIS_ImageShare
{

	/**
	 * Settings
	 * @access	protected
	 * @var	array (settingname => value)
	 */
	protected $_settings;
	
	/**
	 * Database	tables
	 * @access	protected
	 * @var	array (alias => tablename)
	 */
	protected $_dbtables;
	
	/**
	 * Icons
	 * @access	protected
	 * @var	array (slug => (array) information)
	 */
	protected $_icons;
	
	/**
	 * Vars stored, used by the magic setter and getter
	 * @access	private
	 * @var	array
	 */
	private $_vars;
	
	/**
	 * Constructor
	 * @param	array	$settings	Settings
	 * @param	array	$tables	Database tables
	 * @param	array	$icons	Icons
	 */
	public function __construct($settings = false, $tables = false, $icons = false) {
		$this->_vars = array();
		
		if (is_array($settings)) {
			$this->_settings = $settings;
		}
		
		if (is_array($tables)) {
			$this->_dbtables = $tables;
		}
		
		if (is_array($icons)) {
			$this->_icons = $icons;
		}
	}
	
	/**
	 * Plug-in install
	 */
	public final function install()
	{
		$current_version = get_option($this->get_setting('options_prefix') . 'version');
		
		if ($current_version === false) {
			add_option($this->get_setting('options_prefix') . 'version', $this->get_setting('version'));
		}
		else {
			update_option($this->get_setting('options_prefix') . 'version', $this->get_setting('version'));
		}
		
		$defaults = array(
			'icon' => array(
				'iconsize' => 2
			),
			'general' => array(
				'textoverlay_enabled' => true,
				'textoverlay_color' => '000000',
				'textoverlay_opacity' => 50,
				'textoverlay_textcolor' => 'E8E8E8',
				'showon' => 1
			)
		);
		
		$iconnames = array('twitter', 'facebook', 'delicious', 'digg', 'googlebuzz', 'stumbleupon');
		
		foreach ($iconnames as $index => $iconname) {
			if ($icon = $this->get_icon($iconname)) {
				$defaults['icons'][$iconname . '_enabled'] = true;
				$defaults['icons'][$iconname . '_text'] = $icon->text_default;
				$defaults['icons'][$iconname . '_url'] = $icon->url_default;
			}
		}
		
		foreach ($defaults as $index => $default) {
			if (get_option($index) === false) {
				add_option($this->get_setting('options_prefix') . $index, $default);
			}
		}
	}
	
	/**
	 * Plug-in uninstall
	 */
	public final function uninstall()
	{
	}
	
	/**
	 * Set plug-in settings
	 * @param	array $settings	Array of plug-in settings to set
	 * @return	plug-in Settings
	 */
	public function set_settings($settings)
	{
		foreach ($settings as $index => $setting) {
			$this->_settings[$index] = $setting;
		}
		
		return $this->_settings;
	}
	
	/**
	 * Get single plug-in setting
	 * @param	string $setting	Name of plug-in setting to set
	 * @return	Single plug-in setting
	 */
	public function get_setting($setting)
	{
		return $this->_settings[$setting];
	}
	
	/**
	 * Get all plug-in settings
	 * @return	plug-in Settings
	 */
	public function get_settings()
	{
		return $this->_settings;
	}
	
	/**
	 * Set DB tables
	 * @param	array $settings	Array of DB tables to set
	 * @return	DB tables
	 */
	public function set_dbtables($tables)
	{
		foreach ($tables as $index => $table) {
			$this->_dbtables[$index] = $table;
		}
		
		return $this->_dbtables;
	}
	
	/**
	 * Get single DB table
	 * @param	string $table	Name of DB table to set
	 * @return	Single DB table
	 */
	public function get_dbtable($table)
	{
		return $this->_dbtables[$table];
	}
	
	/**
	 * Get all DB tables
	 * @return	DB tables
	 */
	public function get_dbtables()
	{
		return $this->_dbtables;
	}
	
	/**
	 * Set icons
	 * @param	array $icons	Array of icons to use
	 * @return	Icons to use
	 */
	public function set_icons($icons)
	{
		foreach ($icons as $index => $icon) {
			$this->_icons[$index] = $icon;
		}
		
		return $this->_icons;
	}
	
	/**
	 * Get single icon
	 * @param	string $icon	Name of icon to set
	 * @return	Single icon
	 */
	public function get_icon($icon)
	{
		return $this->_icons[$icon];
	}
	
	/**
	 * Get all icons
	 * @return	Icons
	 */
	public function get_icons()
	{
		return $this->_icons;
	}
	
	/**
	 * Load JS
	 */
	public function load_js($file)
	{
		echo '<script type="text/javascript">';
		include $file;
		echo '</script>';
	}
	
	/**
	 * Load CSS
	 */
	public function load_css($file)
	{
		echo '<style type="text/css">';
		include $file;
		echo '</style>';
	}
	
	/**
	 * __set Magic function
	 */
	public function __set($name, $value)
	{
		print_r($value);
		if (is_array($value)) {
			if (!array_key_exists($name, $this->_vars)) {
				$this->_vars[$name] = array();
			}
			
			$this->_vars[$name] = array_merge($this->_vars[$name], $value);
		}
		else {
			$this->_vars[$name] = $value;
		}
	}
	
	/**
	 * __get Magic function
	 */
	public function &__get($name)
	{
		return $this->_vars[$name];
	}
	
	/**
	 * Action: init
	 */
	public function action_init()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui');
		
		add_action('wp_head', array(&$this, 'action_wp_head'));
	}
	
	/**
	 * Action: wp_head
	 */
	public function action_wp_head()
	{
	}

}
?>