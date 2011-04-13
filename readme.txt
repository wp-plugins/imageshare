=== Plugin Name ===
Contributors: Jesper800
Donate link: http://example.com/
Tags: image,share,social,bookmarking,buttons,imageshare,images,bookmark,facebook,twitter,delicious,buzz
Requires at least: 2.7.0
Tested up to: 3.1.1
Stable tag: 1.0
License: GPLv2 or later

The WordPress ImageShare plug-in gives you the possibility to add social bookmarking icons on an overlay on images in your blog posts.

== Description ==

The WordPress ImageShare plug-in adds social bookmarking buttons to images in your blog posts. This way, blog posts can be shared intuitively by hovering the mouse over the images and clicking on the social bookmarking buttons.

**ImageShare** supports 15+ social bookmarking buttons, including *Digg*, *Facebook*, *Google Buzz* and *Twitter*, and even more social bookmarking buttons can be configured. Besides that, the adminpanel offers full configuration of the buttons and their links, giving you the possibility to customize the button order, text and link.

Supported browsers include *FireFox 3+*, *Internet Explorer 7+*, *Google Chrome*, *Safari* and many more (but not all were tested). A visual box shadow will apear in browsers compatible with the CSS3 box-shadow property.

The admin panel also allows you to configure icon sizes, and it is possible to hide the icons from certain pages and categories. The plug-in also allows you to specify on which image the buttons should appear (either the first, the last or every image in a post). Configuring a text and color overlay is also possible, with options to change the color, opacity and text color.

== Installation ==

1. Upload 'imageshare' to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plug-in through the plug-in configuration panel under Settings => ImageShare
1. WordPress adds an image class ('wp-image-[index]') to images automatically. Such a tag is required for images you want to dislay the buttons on, so make sure to add it if you didn't add the images via the normal WordPress methods for that.

== Frequently Asked Questions ==

= How can I disable the text/color overlay? =

The textoverlay and color overlay can be seperately enabled/disabled in the admin panel, by (un)ticking the boxes next to "Enabled".

= Can I add my own social bookmarking buttons? =

Of course! The configuration file for the icons is located in '[plugindir]/config/icons.php'. There, you can add your own icon according to the standards (which you can derive from the standard icons). Make sure to upload the social bookmarking images in the icons images folder '[plugindir']/public/img/icons/[size]/[index].png'.

== Screenshots ==

1. Sample post with a few buttons and the text overlay enabled screenshot-samplepost.jpg
2. Configuring the icons in the admin panel screenshot-configureicons.jpg
3. Using 48x48 buttons screenshot-buttonsize.jpg

== Changelog ==

= 1.0 =
* First version

== Upgrade Notice ==

= 1.0 =
First version
