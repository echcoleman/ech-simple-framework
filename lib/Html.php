<?php

/**
 * Html helper class
 */
class Html {
	
	/**
	 * Get a formatted IMG element
	 * 
	 * @param mixed $path Path to the image file string or array
	 * @param array $options Array of HTML attributes
	 * @return string Formatted IMG element
	 */
	public function image($path, $options = array()) {
		$path = siteurl($path);
		$html = $this->htmlattributes($options);
		return '<img src="' . $path . '" ' . $html . ' />';
	}
	
	/**
	 * Get a formatted HTML link
	 * 
	 * @param string $title HTML title, can be an image element etc.
	 * @param string $path URL path string
	 * @param array $options Array of HTML attributes
	 * @return string Formatted IMG element
	 */
	public function link($title, $path, $options = array()) {
		
		$path = siteurl($path);
		$html = $this->htmlattributes($options);
		return '<a href="' . $path . '" ' . $html . ' >' . $title . '</a>';
	}
	
	/**
	 * Get a formatted HTML mailto link
	 * 
	 * @param string $email Email address
	 * @param string $text Mailto text. Default $email address
	 * @param array $options Array of HTML attributes
	 * @return string Formatted mailto link
	 */
	public function mailto($email, $text = null, $options = array()) {
		if (!isset($text)) {
			$text = $email;
		}
		$link = 'mailto:' . antispambot($email, 1);
		return $this->link($text, $link, $options);
	}
	
	/**
	 * Get excerpt for text
	 * 
	 * @param string $text Text to get excerpt from
	 * @param int $excerpt_words Length to use, uses Wordpress settings by default
	 * @param string $excerpt_more More text if excerpt is created
	 * @param boolean $strip_tags Whether tags should be stripped. Default true
	 * @return string Excerpt text
	 */
	public function excerpt($text, $excerpt_words = 0, $more_link = false, $strip_tags = true) {

		$raw_excerpt = $text;
		
		// get excerpt length
		if (!$excerpt_words) {
			$excerpt_words = apply_filters('excerpt_length', 55);
		}

		// remove all shortcode tags from text
		$text = strip_shortcodes( $text );
		$text = str_replace(']]>', ']]&gt;', $text);

		// allowed tags set
		$allowed_tags = '';
		if (!$strip_tags) {
			$allowed_tags = '<p>,<a>,<b>,<strong>,<ul>,<li>,<ol>,<br>,<br/>';
		}
		$text = strip_tags($text, $allowed_tags);

		// get excerpt
		$limit_reached = false;
		preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $text, $tokens);
		foreach ($tokens[0] as $t) {
			// limit reached
			if ($w >= $excerpt_words) {
				$out .= __( '&hellip;' );
				$limit_reached = true;
				break;
			}
			// token is not a tag
			if ($t[0] != '<') {
				// limit reached, continue until ? . or ! occur at the end
				if ($w >= $excerpt_words && preg_match('/[\?\.\!]\s*$/uS', $t) == 1) { 
					$out .= trim($t);
					break;
				}
				$w++;
			}
			// append what's left of the token
			$out .= $t;
		}
		$text = force_balance_tags($out);
		if ($limit_reached && $more_link)
			$text .= ' <a href="' . $more_link . '">' . __('read more', 'api') . '</a>';

		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
	
	/**
	 * Simple parse of html attributes in array
	 * 
	 * @param array $options Array of HTML attributes
	 * @return string Html formatted attributes
	 */
	public function htmlattributes($options) {
		$html = array();
		foreach ($options as $key => $value) {
			$html[] = $key . '="' . $value . '"';
		}
		return implode(' ', $html);
	}
	
}

?>
