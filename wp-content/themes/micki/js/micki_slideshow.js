$(document).ready(function() {
	$('.slide:not(#slide1)').hide();
	$('#slide1').addClass('active');
	$('#thumb1').addClass('active');
	
	micki_ss = new micki_slideshow();
	micki_ss.timedSwitch('micki_ss.switchToSlide(2)');
});

function micki_slideshow() {
	this.timeout = 0;
	this.inFocus = 1;
	this.savedIndex = 2;
}

micki_slideshow.prototype.switchToSlide = function(index) {

	if(!this.inFocus) {
		this.savedIndex = index;
		return;
	}

	var id = '#slide' + index;
	$(id).fadeIn();
	$('.slide.active').fadeOut().removeClass('active');
	$(id).addClass('active');
	
	$('img.thumb.active').removeClass('active');
	var thumb_id = '#thumb' + index;
	$(thumb_id).addClass('active');
	
	index = (index % 4) + 1;
	this.savedIndex = index;
	
	this.timedSwitch('micki_ss.switchToSlide(' + index + ');');
}

micki_slideshow.prototype.timedSwitch = function(str) {
	this.timeout = setTimeout(str, 5000);
}

micki_slideshow.prototype.forcedSwitch = function(index) {
	var id = '#slide' + index;
	if (!$(id).hasClass('active')) {
		clearTimeout(this.timeout);
		this.switchToSlide(index);
	}
}

window.onblur = function() {
	micki_ss.inFocus = 0;
	clearTimeout(micki_ss.timeout);
}

window.onfocus = function() {
	if (micki_ss && !micki_ss.inFocus) {
		micki_ss.inFocus = 1;
		fn_str = 'micki_ss.switchToSlide(' + micki_ss.savedIndex + ')';
		micki_ss.timedSwitch(fn_str);
	}
}
