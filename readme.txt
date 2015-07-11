=== Open Graph link tile ===
Contributors: kotaroho
Donate link: http://example.com/
Tags: OGP, link
Requires at least: 2.6
Tested up to: 4.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This WordPress plugin makes a link tile from Open Graph protocol.

== Description ==

This WordPress plugin makes a link tile from Open Graph protocol.
What you have to write is just a shortcode:

[khlt_linktile url="URL"]

And there are some options.

*   url : (mandatory) URL to link
*   bgcolor : (option, default: #fff) background-color of the link tile.
*   nocache : (option, default: false) set to true once if the linked page is changed.
*   desc : (option, default: fetch from OGP) set any text here if you want to override OGP's description.

OGP data from linked site is cached for a week. (You can change my PHP code)

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `koho_oglinktile` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `[khlt_linktile url="URL"]` in your article

== Screenshots ==

1. screenshot-1.png

== Changelog ==

= 1.0.0 =
* Initial version.

== Upgrade Notice ==

= 1.0.0 =
None.
