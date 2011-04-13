<?php
/**
 * WordPress ImageShare Plug-in: Front-end class
 *
 * @author		WPEssence
 * @copyright	2011 WPEssence
 * @website		wpessence.com
 * @see			WPMS_ImageShare
 */

class WPIS_ImageShare_Frontend extends WPIS_ImageShare
{

	/**
	 * Action: init
	 */
	public function action_init()
	{
		parent::action_init();
		
		wp_enqueue_script('imageshare', $this->get_setting('plugin_url') . '/public/js/imageshare.js', array('jquery'));
		wp_enqueue_style('imageshare', $this->get_setting('plugin_url') . '/public/css/imageshare.css');
		
		add_filter('the_content', array(&$this, 'filter_the_content'));
		
		$this->options['icon'] = get_option($this->get_setting('options_prefix') . 'icon');
		$this->options['general'] = get_option($this->get_setting('options_prefix') . 'general');
		$this->options['icons'] = get_option($this->get_setting('options_prefix') . 'icons');
		$this->options['general']['hide_posts_array'] = explode(',', str_replace(' ' , '', $this->options['general']['hide_posts']));
		$this->options['general']['show_categories_array'] = explode(',', str_replace(' ' , '', $this->options['general']['show_categories']));
	}
	
	/**
	 * Filter: the_content
	 * @param string $content Post content
	 * @return string The post content
	 */
	public function filter_the_content($content)
	{
		global $post;
		
		$categories = wp_get_post_categories($post->ID);
		
		if (in_array($post->ID, $this->options['general']['hide_posts_array']) or array_diff($this->options['general']['show_categories_array'], $categories) != $this->options['general']['show_categories_array']) {
			return $content;
		}
		
		$encodedurl = urlencode(get_permalink($post->ID));
		$encodedtitle = urlencode(get_the_title());
		
		switch ($this->options['icon']['iconsize']) {
			case '1':
				$iconsize = '16x16';
				$iconwh = 16;
				break;
			case '2':
				$iconsize = '24x24';
				$iconwh = 24;
				break;
			case '4':
				$iconsize = '60x60';
				$iconwh = 60;
				break;
			default:
				$iconsize = '48x48';
				$iconwh = 48;
				break;
		}
		
		$string_insert = '
			<div class="wpis-overlay">
				' . ($this->options['general']['coloroverlay_enabled'] ? '<div class="wpis-coloroverlay"></div>' : '') . '
				' . ($this->options['general']['textoverlay_enabled'] ? '<div class="wpis-textoverlay">
					<div class="wpis-textoverlay-overlay"></div>
					<span></span>
				</div>' : '');
		
		$icons = $this->get_icons();
		
		$ordernumbers = array();
		
		foreach ($icons as $index => $icon) {
			$ordernumbers[$index] = $this->options['icons'][$index . '_order'];
		}
		
		array_multisort($ordernumbers, $icons);
		
		foreach ($icons as $index => $icon) {
			if (!$this->options['icons'][$index . '_enabled']) {
				continue;
			}
			
			$url = str_replace('{title}', $encodedtitle, str_replace('{url}', $encodedurl, $this->options['icons'][$index . '_url']));
			
			$string_insert .= '
				<img src="' . $this->get_setting('plugin_url') . '/public/img/icons/' . $iconsize . '/' . $index . '.png" title="' . $this->options['icons'][$index . '_text'] . '" width="' . $iconwh . '" height="' . $iconwh . '" class="wpis-sbbutton" rel="' . $url . '" />
			';
		}
		
		$string_insert .= '
			</div>
		';
		
		$string_insert_length = strlen($string_insert);
		$identifier = '<img ';
		
		$num_images = substr_count($content, $identifier);
		$offset = 0;
		
		if ($this->options['general']['showon'] == 3) {
			$contentlength = strlen($content);
			
			$valid = false;
			$elementpos = -1;
			
			while (!$valid and $elementpos !== false) {
				$elementpos = strrpos($content, $identifier, $offset);
				
				$closepos = strpos($content, '>', $elementpos);
				$classpos = strpos($content, 'wp-image', $elementpos);
				
				if ($classpos > $elementpos and $classpos < $closepos) {
					$valid = true;
				}
				
				$offset = $elementpos - $contentlength - 1;
			}
			
			$negoffset = $elementpos - $contentlength;
			$linkpos = strrpos($content, '<a ', $negoffset);
			$link_closepos = strpos($content, '</a>', $elementpos);
			
			$placepos = ($linkpos < $elementpos and $elementpos < $link_closepos) ? $linkpos : $elementpos;
			
			$content = substr($content, 0, $placepos) . $string_insert . substr($content, $placepos);
		}
		else {
			for ($i = 0; $i < $num_images; $i++) {
				$contentlength = strlen($content);
				
				$valid = false;
				$elementpos = -1;
				
				while (!$valid and $elementpos !== false) {
					$elementpos = strpos($content, $identifier, $offset);
					
					$closepos = strpos($content, '>', $elementpos);
					$classpos = strpos($content, 'wp-image', $elementpos);
					
					if ($classpos > $elementpos and $classpos < $closepos) {
						$valid = true;
					}
					
					if ($elementpos !== false) {
						$offset = $elementpos + 1;
					}
				}
				
				if (!$valid) {
					continue;
				}
				
				$negoffset = $elementpos - $contentlength;
				$linkpos = strrpos($content, '<a ', $negoffset);
				$link_closepos = strpos($content, '</a>', $elementpos);
				
				$placepos = ($linkpos < $elementpos and $elementpos < $link_closepos) ? $linkpos : $elementpos;
				
				$content = substr($content, 0, $placepos) . $string_insert . substr($content, $placepos);
				
				$offset = $elementpos + $string_insert_length + 1;
				
				if ($this->options['general']['showon'] == 1) {
					break;
				}
			}
		}
		
		return $content;
	}
	
	/**
	 * Action: wp_head
	 */
	public function action_wp_head()
	{
		parent::action_wp_head();
		
		$this->load_css(WPAA_ABSPATH . '/public/css/custom.css');
	}

}
?>