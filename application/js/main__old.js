(function($) {
/**
 * Tags
 */
var $tags = $("#tags");

/**
 * Chosen Tags
 */
if ($tags.size() > 0) {
	$tags.chosen();
	$("#check-all-tags").on("click", function(e) {
		$tags.find("option").prop("selected", true);
    	$tags.trigger("liszt:updated");
	});
	$("#uncheck-all-tags").on("click", function(e) {
		$tags.find("option").prop("selected", false);
    	$tags.trigger("liszt:updated");
	});
}

/**
 * Search
 */
var $search_box = $("#search-box"),
	search_box_val = $search_box.val(),
	$search_btn = $("#btn-search");

// Search focus effect
$search_box.on("focus", function() { if($search_box.val() == search_box_val) $search_box.val(""); })
		.on("blur", function() { if($search_box.val() == "") $search_box.val(search_box_val); });

// Search on click action
$search_btn.click(function() {
	if ($search_box.val() == search_box_val) $search_box.focus();
	else {
		// Run search
	}
});

/**
 * Level raneg
 */
var $level_range = $("#level-range");
$level_range.noUiSlider({
	range: [0, 4],
	start: [1, 3],
	step: 1,
	orientation: "vertical"
});

/**
 * Price range
 */
var $price_range = $("#price-range");
$price_range.noUiSlider({
	range: [0, 5000],
	start: [1000, 2500],
	step: 100,
	slide: function(){
		var values = $(this).val();

		if(values[0] == 0 )
			values[0] = "Free";
		else if(values[0] > 999)
			values[0] = (values[0] / 1000) + "k";
		else if (values[1] > 999)
			values[1] = (values[1] / 1000) + "k";

		$price_range.find("a:first-child div").html("<span>" + values[0] + "$</span>");
		$price_range.find("a:eq(1) div").html("<span>" + values[1] + "$</span>");
	}		
});

/**
 * Period range
 */
var $period_range = $("#period-range");
$period_range.noUiSlider({
	range: [0, 8],
	start: [3, 6],
	step: 1,
	slide: function(){
		var values = $(this).val();
		if(values[0] == 0 ) { values[0] = "1Hr"; }
		if(values[0] == 1 ) { values[0] = "6Hr"; }
		if(values[0] == 2 ) { values[0] = "12Hr"; }
		if(values[0] == 3 ) { values[0] = "1W"; }
		if(values[0] == 4 ) { values[0] = "2W"; }
		if(values[0] == 5 ) { values[0] = "1M"; }
		if(values[0] == 6 ) { values[0] = "3M"; }
		if(values[0] == 7 ) { values[0] = "6M"; }
		if(values[0] == 8 ) { values[0] = "1Yr"; }
		if(values[1] == 0 ) { values[1] = "1Hr"; }
		if(values[1] == 1 ) { values[1] = "6Hr"; }
		if(values[1] == 2 ) { values[1] = "12Hr"; }
		if(values[1] == 3 ) { values[1] = "1W"; }
		if(values[1] == 4 ) { values[1] = "2W"; }
		if(values[1] == 5 ) { values[1] = "1M"; }
		if(values[1] == 6 ) { values[1] = "3M"; }
		if(values[1] == 7 ) { values[1] = "6M"; }
		if(values[1] == 8 ) { values[1] = "1Yr"; }
		$period_range.find("a:first-child div").html("<span>" + values[0] + "</span>");
		$period_range.find("a:eq(1) div").html("<span>" + values[1] + "</span>");
	}
});

/**
 * leanModal
 */
$("a[data-gal^=leanModal]").leanModal({closeButton: ".modal-close" });

$("#login").on("show", function(e) {
	$(this).find("[type=text]:first").focus();
});
$(".btn-login").on("mouseenter", function(e) {
	$(this).dropdown("show", $("#login"));
}).on("click", function(e) {
	$(this).dropdown("hide", $("#login"));
});

$(document).on("change", "#inst-photo", function(e) {
	$(this).prev(".filename").text( $(this).val().split('\\').pop() );
});

/**
 * Post Form
 */

/**
 * Register vars
 */
var $modal = $("#lean_overlay"),
	$d = $(document),
	modal_box_id = "";

// Show function
function open_reg(box_id) {
	$modal.stop(false, false).css("opacity",0.3).fadeIn();
	$("#"+box_id).stop(false, false).css("opacity",1).fadeIn();

	// Focus
	$("#"+box_id).find("input[type=text], input[type=password], textarea, select").eq(0).focus();
}

// Hide function
function close_reg(box_id) {
	$modal.stop(false, false).fadeOut(function() { $(this).hide(); });
	$("#"+box_id).stop(false, false).fadeOut(function() { $(this).hide(); });
}

// Auto Popup
if (typeof autoPopup == "string" && autoPopup.length > 0) {
	modal_box_id = autoPopup;

	// Open register modal
	open_reg(modal_box_id);
}

// On click event
$d.on("click", "[data-modal]", function(e) {
	e.preventDefault();

	var $this = $(this);
	modal_box_id = $this.attr("data-modal");

	// Open register modal
	open_reg(modal_box_id);
});

// Close modal
$d.on("click", ".modal-close, #lean_overlay", function(e) {
	if ($modal.is(":hidden")) return;

	close_reg(modal_box_id);
	return false;
});

/**
 * Esc key event
 */
$d.on("keyup", function(e) {
	if ($modal.is(":hidden")) return;
	var code = e.keyCode ? e.keyCode : e.which;
	// Esc
	if (code == 27) close_reg(modal_box_id);
});

/**
 * Course tabs
 */
var $tabs = $(".chapter-nav").eq(0);
if ($tabs.length > 0) {
	var easing_speed = 100,
		easing = "jswing";
		// easing = "easeInQuad";

	$tabs.on("click", ".head", function(e) {
		var $this = $(this),
			$body = $this.next(".body"),
			$siblings = $body.siblings(".body.active");

		$this.addClass("active").siblings(".head").removeClass("active");
		// $body.stop(false, false).slideDown(easing_speed, easing);// .addClass("active");
		$body.stop(false, false).slideDown(easing_speed, easing, function() { $body.addClass("active"); });
		$siblings.stop(false, false).slideUp(easing_speed, easing, function() { $siblings.removeClass("active"); });
	});
}

/**
 * Add Course
 *
var $add_question = $(".post-form .add-question");
if ($add_question.length > 0) {
	$add_question.on("click", function(e) {
		var $this = $(this),
			$tag = $this.parent().prev(".form-row.question.dn"),
			html = '<div class="form-row textarea question">';

			html += $tag.html();
			html += '</div>';

		$tag.before( html );
		$tag.prev().removeClass("dn").find("[type='checkbox']").removeAttr("checked");
	});
}
 */
var $add_question = $(".post-form .add-question");
	// q_nums = 1;

if ($add_question.length > 0) {
	// Inputs
	$add_question.on("click", function(e) {
		var $q_section = $(".post-form .q-section:last"),
			count = $(".q-section").size() + 1;

		$q_section.clone().insertBefore( $(this).parent() )
		.css("margin-top","20px").end()
		.find("h3").remove().end()
		.find(".form-label").text( "Question " + count ).end()
		.find(".questions-box").html("").end();

		// Reset exam numbers
		$(".q-section").each(function(key) {
			var $this = $(this);
			key++;

			$this.attr("id", "question-"+key).find("label.form-label:first").text("Question "+key);
			$(".content-exam").find("textarea, input[type=radio], input[type=text], input[type=checkbox]").each(function() {
				var $this = $(this),
					number = $this.closest(".q-section").attr("id").replace("question-", ""),
					name = $(this).attr("name"),
					name_val = "",
					pattern = /\[/;

				if (pattern.exec(name)) return;

				name_val = (name == "choice" || name == "choice_mark") ? name+"["+number+"][]" : name+"["+number+"]";

				$this.attr("name", name_val);
			});
		});
	});
}
$(document).on("change", "select.new-question", function(e) {
	alertify.log( $(this).val() );
});

/**
 * jCheckbox
 */
var jCheckbox = $(".jCheckbox");
if (jCheckbox.length > 0) {
	jCheckbox.jCheckbox();
	// jCheckbox_init();
}

/**
 * Stars widget
 */
var $stars = $(".stars-widget");
if ($stars.length > 0) {
	// Default stars
	$stars.each(function() {
		var $this = $(this),
			stars = $this.attr("data-stars") - 1;
		if (stars < 0) return;

		$this.children(".item").eq(stars).prevAll().andSelf().addClass("active");
	});

	// Actions
	$stars.children(".item").on({
		"mouseenter": function(e) {
			$(this).prevAll().andSelf().addClass("star-hover");
		},
		"mouseleave": function(e) {
			$(this).prevAll().andSelf().removeClass("star-hover");
		},
		"click": function(e) {
			// $(this).siblings().removeClass("active").end()
			// .prevAll.andSelf().addClass("active");
			var $this = $(this);
			$this.siblings().andSelf().removeClass("active");
			$this.prevAll().andSelf().addClass("active");
			$this.parent().attr("data-stars", $this.index()+1);
		}
	});
}

/**
 * jLightbox
 */
var $jLightbox = $("#jLightbox"),
	$jLightbox_overlay = $("#jLightbox-overlay")
	jLightbox_speed = 200;
if ($jLightbox.length > 0) {
	function jLightbox_close() {
		$jLightbox_overlay.stop(true, true).fadeOut(jLightbox_speed);
		$jLightbox.stop(true, true).fadeOut(jLightbox_speed);
	}

	function jLightbox_open(title, content) {
		$jLightbox.children(".lightbox-head").html(title+'<div class="lightbox-close"></div>');
		$jLightbox.children(".lightbox-body").html(content);

		$jLightbox_overlay.stop(true, true).fadeIn(jLightbox_speed);
		$jLightbox.stop(true, true).fadeIn(jLightbox_speed, function() {
			// Auto focus first input
			// $jLightbox.find("input[type='text'], input[type='password'], textarea, select").eq(0).focus();
		});
	}

	// Close
	$jLightbox_overlay.on("click", function(e) {
		jLightbox_close();
	});
	$jLightbox.on("click", ".lightbox-close", function(e) {
		jLightbox_close();
	});

	/**
	 * Esc key event
	 */
	$d.on("keyup", function(e) {
		if ($jLightbox.is(":hidden")) return;
		var code = e.keyCode ? e.keyCode : e.which;
		// Esc
		if (code == 27) jLightbox_close();
	});

	// Open
	$d.on("click", "a[data-jbox-content]", function(e) {
		var $this = $(this),
			content_id = $this.attr("data-jbox-content"),
			title = $this.attr("data-jbox-title"),
			content = $("#" + content_id).html();

		if ( $("#" + content_id).hasClass("reduce-padding") )
			$jLightbox.children(".lightbox-body").addClass("reduce-padding");
		else
			$jLightbox.children(".lightbox-body").removeClass("reduce-padding");

		jLightbox_open(title, content);
	});
}

/**
 * Previous code
 */
	$('aside').on('click','.toggle-subscription',function(event){
		$('.confirm-subscription').slideDown();
		event.preventDefault();
	});
	$('.confirm-subscription').on('click','.cancel',function(event){
		$('.confirm-subscription').slideUp();
		event.preventDefault();
	});
	$('.add-certificate').on('click','a',function(event){
		event.preventDefault();
		$('.add-certificate').before('<p><label>Certification</label><input type="text" /></p><p><label>Acredited by</label><input type="text" /></p><p><label>Verification link</label><input type="text" /></p>')
	});

	// $('.dropdown-menu').on('click','.toggle-instructor',function(){
	// 	$('.user-type').text('I’m an Instructor');
	// 	$('.toggle-register').attr('href','#register-instructor')
	// });
	// $('.dropdown-menu').on('click','.toggle-student',function(){
	// 	$('.user-type').text('I’m a Student');
	// 	$('.toggle-register').attr('href','#register-student')
	// });

	// $("a[rel*=leanModal]").leanModal({closeButton: ".modal-close" });

})(jQuery);