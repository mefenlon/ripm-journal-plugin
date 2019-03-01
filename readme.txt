=== Plugin Name ===
Contributors:
Donate link: http://a.co/f6nKY3M
Tags: custom post type, journals
Requires at least: 4.6
Tested up to: 5.1
Stable tag: 4.3
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Plugin for RIPM Journal Custom Post Type and Journal related functions.
== Description ==

This plugin adds a journal custom post type and custom meta fields and taxonomies.

This plugin also includes the following [shortcodes](https://codex.wordpress.org/Shortcode "Wordpress Shortcode Documentation")
* [display_journal_table] Shows all journals in a table. Can be placed on any page.
* [display_journal_meta] Display the custom fields associated with a journal. Can be displayed on individual journal page.

This plugin includes the following Taxonomies (allows one or many)
USE -- in place of a comma.
* City
* Country
* Editor
* Language
* Publisher
Please note, Wordpress Taxonomies DO NOT ALLOW COMMAS in the text. Commas are used to seperate elements.
To get around this, use a -- in any taxonomy where you would need a comma.
Example: To enter "Poughkeepsie, New York" as a City, use the text Poughkeepsie-- New York


== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/ripm-journal-plugin` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin

== Frequently Asked Questions ==

= My city names or publishers are being split into two items =
Wordpress Taxonomies DO NOT ALLOW COMMAS in the text. Commas are used to seperate elements.
To get around this, use a -- in any taxonomy where you would need a comma.
Example: To enter "Poughkeepsie, New York" as a City, use the text Poughkeepsie-- New York
.
== Changelog ==

= 0.1 =
* Initial Release

== Upgrade Notice ==
