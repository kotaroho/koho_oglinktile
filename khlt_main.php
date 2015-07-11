<?php
/*
Plugin Name: Open Graph link tile
Description: This plugin makes a link tile from Open Graph protocol. What you have to write is just a shortcode: [khlt_linktile url="URL"]. And there are some options.
Version: 1.0.0
Author: KoHo
*/


require_once('khlt_OpenGraph.php');

function khlt_showlinktile( $atts ) {
	extract( shortcode_atts( array(
		'url' => '',
		'bgcolor' => false,
		'desc' => false,
		'nocache' => false,
	), $atts ) );
	$transient_key = 'khlt_cache_' . md5($url);

	preg_match('{https?://(.+?)/}i', $url . '/', $m);
	$domain = $m[1];
	if ( !$domain ) {
		return "";
	}

	if ( (!is_array($data = get_transient( $transient_key ))) || $nocache ) {
		$o = khlt_OpenGraph::fetch($url);
		$data = array(
			'image' => $o->image,
			'description' => $o->description,
			'title' => $o->title,
			'url' => $url,
		);
		set_transient( $transient_key, $data, 7 * DAY_IN_SECONDS ); // 1週間キャッシュ
		$data['debug'] = "<!-- khlt created -->";
	} else {
		$data['debug'] = "<!-- khlt from cache -->";
	}

	$divstyle = $bgcolor ? " style='background-color: $bgcolor;'" : "";
	$thumbnail = $data['image'] ? "<a class='khlt-thumbnail' href='$url'><img src='{$data['image']}' alt=''></a>" : "";
	$description = $desc ? $desc : $data['description'];
	$tag = <<< EOF
		<div class="khlt-box"$divstyle>
			$thumbnail
			<div class="khlt-content">
				<a class="khlt-title" href="$url">{$data['title']}</a>
				<div class="khlt-description">$description</div>
				<div class="khlt-footer">
					<a class="khlt-domain" href="$url"><img class="khlt-favicon" src="http://www.google.com/s2/favicons?domain=$domain" /> $domain</a>
				</div>
			</div>
		</div>{$data['debug']}
EOF;

	return $tag;
}

function khlt_linkstyle() {
	$plugin_url = plugin_dir_url( __FILE__ );
	echo "<link rel='stylesheet' href='${plugin_url}khlt_style.css' type='text/css' />" . PHP_EOL;
}

add_shortcode( 'khlt_linktile' , 'khlt_showlinktile');
add_action('wp_head', 'khlt_linkstyle');

?>
