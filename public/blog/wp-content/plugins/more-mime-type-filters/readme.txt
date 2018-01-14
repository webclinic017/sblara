=== More Mime Type Filters ===
Contributors: trepmal
Donate link: http://kaileylampert.com/donate
Tags: media library, mime types
Requires at least: 3.1
Tested up to: 3.5
Stable tag: 0.3

Adds to the default Images | Audio | Video filters in the Media Library

== Description ==

In the Media Library, there are a few convenient filter links (Images | Audio | Video). This plugin allows you to add other types to that list.
For example, you could add a PDFs link to easily find all PDFs in the Media Library.

May require at least 2.8.6 (definitely doesn't work on anything older than that)

* [I'm on twitter](http://twitter.com/trepmal)


== Installation ==

1. Upload `mimes.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Find the Mime Types page under Media in the sidebar

== Frequently Asked Questions ==

= How can I add more mime types? =

If you've customized the allowed mime types for upload, they'll automatically appear on this plugins admin page.
Here's some example code for how to all additional mime types to be uploaded:
`add_filter( 'upload_mimes', 'make_alfredextenstion_allowed_upload' );
function make_alfredextenstion_allowed_upload( $mimes ) {
	$mimes['alfredextension'] = 'application/octet-stream';
	return $mimes;
}`

== Screenshots ==

1. The admin page in the menu
2. Before the plugin
3. With the plugin
4. (Old) Admin page
5. Admin page (since v0.3)

== Changelog ==

= 0.3 =
* Prettier admin page
* Clean up notices

= 0.2 =
* bug fix for non-admins in debug mode

= 0.1 =
* First release
