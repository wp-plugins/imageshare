jQuery.fn.extend({
    fixPNG: function(sizingMethod, forceBG) {
        if (!(jQuery.browser.msie)) {
			return this;
		}
		
        var emptyimg = "/empty.gif"; // Path to an empty 1x1px GIF goes here
        sizingMethod = sizingMethod || "scale"; //sizingMethod, defaults to scale (matches image dimensions)
		
        this.each(function() {
            var isImg = (forceBG) ? false : jQuery.nodeName(this, "img");
            var imgname = (isImg) ? this.src : this.currentStyle.backgroundImage;
            var src = (isImg) ? imgname : imgname.substring(5,imgname.length-2);
			
            this.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizingMethod='" + sizingMethod + "')";
			
            if (isImg) {
				this.src = emptyimg;
			}
            else {
				this.style.backgroundImage = "url(" + emptyimg + ")";
			}
        });
		
        return this;
    }
});


jQuery(document).ready(function($) {
	$(window).load(function() {
		wpis_images = 0;
		
		$('.wpis-overlay').each(function() {
			$(this).parents('a').each(function() {
				$(this).replaceWith($(this).html());
			});
			
			nextelement = $(this).next();
			
			if (nextelement[0].nodeName == 'A') {
				image = nextelement.children('img');
			}
			else {
				image = $(this).next('img');
			}
			
			cssclasses = image.attr('class').split(/\s+/);
			
			iswpimage = false;
			
			for (i = 0; i < cssclasses.length; i++) {
				if (cssclasses[i].indexOf('wp-image') === 0) {
					iswpimage = true;
				}
			}
			
			if (!iswpimage) {
				$(this).remove();
				
				return;
			}
			
			$(this).addClass('wpis-overlay-' + wpis_images.toString());
			image.addClass('wpis-image wpis-image-' + wpis_images.toString());
			
			image.css('position', 'relative');
			image.css('z-index', '0');
			
			wpis_images++;
		});
		
		$('.wpis-image').each(function() {
			$(this).parents('a').each(function() {
				$(this).replaceWith($(this).html());
			});
		});
		
		$('.wpis-overlay').prev('p').each(function() {
			if ($(this).html().replace(/\s/g, '') == '') {
				$(this).remove();
			}
		});
		
		$('.wpis-sbbutton').each(function() {
			$(this).wrap('<a href="' + $(this).attr('rel') + '" target="_blank" title="' + $(this).attr('title') + '" />');
		});
		
		$('.wpis-image').each(function() {
			$(this).prev('.wpis-overlay').width($(this).width());
			$(this).prev('.wpis-overlay').height($(this).height());
		});
		
		i = 0;
		$('.wpis-overlay').each(function() {
			elid = 'wpis-' + i.toString();
			
			$(this).wrap('<div class="wpis" id="' + elid + '" />');
			
			el = $('#' + elid);
			
			image = el.next('img');
			
			image.appendTo('#' + elid);
			el.width(el.children('img').width());
			el.height(el.children('img').height());
			
			i++;
		});
		
		$('.wpis').hover(function() {
			$(this).children('.wpis-overlay').fadeIn(200);
		}, function() {
			$(this).children('.wpis-overlay').fadeOut(200);
		});
		
		$('.wpis-sbbutton').hover(function() {
			$(this).fadeTo(100, 0.75);
			
			textoverlay = $(this).parents('.wpis-overlay').children('.wpis-textoverlay');
			textoverlay.show().children('span').html($(this).attr('title'));
			
			boxheight = textoverlay.parent().height();
			
			textoverlay.css('top', boxheight - textoverlay.height());
			
			textoverlay.children('.wpis-textoverlay-overlay').width(textoverlay.width()).height(textoverlay.height());
		}, function() {
			$(this).fadeTo(100, 1);
			$(this).parents('.wpis-overlay').children('.wpis-textoverlay').hide().children('span').html('');
		});
		
		$('.wpis-sbbutton').each(function () {
			$(this).attr('width', $(this).width());
			$(this).attr('height', $(this).height());
			$(this).fixPNG('image');
		});
	});
});

