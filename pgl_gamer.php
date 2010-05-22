<?php
/*
Plugin Name: Playgamelah Embed
Plugin Script: pgl_gamer.php
Plugin URI: http://playgamelah.com/use-wordpress-plugin.php
Description: Easily add playgamelah.com games by just entering the game name [playgamelah game="" width="" height=""]         By using this plugin, you agree that we will place our link on your blog footer via wp_footer()
Version: 1.0
Author: Play Game Lah | Play Free Online Games
Author URI: http://www.playgamelah.com

=== RELEASE NOTES ===
2010-05-19 - v1.0 - first version
*/

/* 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt
*/


//Do NOT remove footer
function ga()  {
$s = "Games provided by <a href=\"http://www.playgamelah.com\" rel='dofollow'>Play Game Lah | Play Free Online Games</a>";
echo $s;
}

// [bartag foo="foo-value"]
function pgl_func($atts) {
	extract(shortcode_atts(array(
		'game' => 'Happy%20Tree%20Friends%20Fire%20Escape',
		'width' => '',
		'height' => '',
	), $atts));
	
	$url ="http://playgamelah.com/extractgames/wprss.php?search=".$game;
	$rss = simplexml_load_file($url);
	$arrFeeds = array();
	foreach ($rss->channel->item as $item) {
		$orheight = $item->height;
		$orwidth = $item->width;
	}
	if ($width!="") {
		$ration = $orwidth/$width;
	}
	else {
		$ration=1;
	}
	
	$game = str_replace("%20"," ",$game);
	//echo $game;
	return '<object width="'.$orwidth/$ration.'" height="'.$orheight/$ration.'"><param name="movie" value="http://playgamelah.com/arcade/'.$game.'.swf"><embed src="http://playgamelah.com/arcade/'.$game.'.swf" width="'.$orwidth/$ration.'" height="'.$orheight/$ration.'"></embed></object>';
}

add_shortcode('playgamelah', 'pgl_func');

//Do not remove footer
add_action('wp_footer', 'ga');

?>