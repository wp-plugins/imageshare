<?php
// Unset the icons variable if it is set
unset($icons);

// Set the scope for the variable to store the data in to global
global $icons;

// Icons
$icons = array(
	'blogger' => (object) array(
		'name' => 'Blogger',
		'text_default' => 'Post this on Blogger',
		'url_default' => 'http://www.blogger.com/blog_this.pyra?u={url}&n={title}'
	),
	'delicious' => (object) array(
		'name' => 'Delicious',
		'text_default' => 'Bookmark on Delicious',
		'url_default' => 'http://www.delicious.com/save?title={title}&url={url}'
	),
	'digg' => (object) array(
		'name' => 'Digg',
		'text_default' => 'Digg this',
		'url_default' => 'http://www.digg.com/submit?url={url}&title={title}'
	),
	'facebook' => (object) array(
		'name' => 'Facebook',
		'text_default' => 'Share on Facebook',
		'url_default' => 'http://www.facebook.com/share.php?u={url}'
	),
	'friendfeed' => (object) array(
		'name' => 'FriendFeed',
		'text_default' => 'Post on FriendFeed',
		'url_default' => 'http://www.friendfeed.com/share?title={title}&link={url}'
	),
	'googlebuzz' => (object) array(
		'name' => 'Google Buzz',
		'text_default' => 'Post this on Google Buzz',
		'url_default' => 'http://www.google.com/buzz/post?url={url}&title={title}'
	),
	'linkedin' => (object) array(
		'name' => 'LinkedIn',
		'text_default' => 'Share on LinkedIn',
		'url_default' => 'http://www.linkedin.com/shareArticle?url={url}&title={title}'
	),
	'mixx' => (object) array(
		'name' => 'Mixx',
		'text_default' => 'Mixx this',
		'url_default' => 'http://www.mixx.com/submit?page_url={url}'
	),
	'myspace' => (object) array(
		'name' => 'MySpace',
		'text_default' => 'Post on MySpace',
		'url_default' => 'http://www.myspace.com/Modules/PostTo/Pages/?u={url}'
	),
	'netvibes' => (object) array(
		'name' => 'NetVibes',
		'text_default' => 'Share on NetVibes',
		'url_default' => 'http://www.netvibes.com/share?url={url}&title={title}'
	),
	'reddit' => (object) array(
		'name' => 'Reddit',
		'text_default' => 'Reddit this',
		'url_default' => 'http://www.reddit.com/submit?title={title}&url={url}'
	),
	'stumbleupon' => (object) array(
		'name' => 'StumbleUpon',
		'text_default' => 'StumbleUpon this',
		'url_default' => 'http://www.stumbleupon.com/submit?url={url}&title={title}'
	),
	'technorati' => (object) array(
		'name' => 'Technorati',
		'text_default' => 'Bookmark on Technorati',
		'url_default' => 'http://www.technorati.com/faves?add={url}'
	),
	'twitter' => (object) array(
		'name' => 'Twitter',
		'text_default' => 'Tweet about this',
		'url_default' => 'http://www.twitter.com/share?text={title}&url={url}'
	),
	'yahoobuzz' => (object) array(
		'name' => 'Yahoo Buzz',
		'text_default' => 'Post this on Yahoo Buzz',
		'url_default' => 'http://buzz.google.com/buzz?targetUrl={url}&title={title}'
	),
);
?>