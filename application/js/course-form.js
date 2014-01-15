(function($) {

/**
 * Post Form
 */
if ($(".form-row").length > 0) {
	var $d = $(document);

	// Attachment
	$d.on("change", ".form-row.input-file > input[type=file]", function(e) {
		var $this = $(this);
		$this.parent().children(".filename").eq(0).text( $this.val().split('\\').pop() );
	});
	// Submit
	$(".form-row.submit > .submit").eq(0).on("click", function(e) {
		e.preventDefault();
		$(this).closest("form").submit();
	});
	// Reset
	$(".form-row.submit > .reset").eq(0).on("click", function(e) {
		e.preventDefault();
		var $form = $(this).closest("form");
		$form.find("textarea, input[type=text], select").val("");
		$form.find(".form-row.input-file > .filename").text("");
	});

	/**
	 * Tags
	 */
	$(".chzn-select").chosen({allow_single_deselect: true});
	$d.on("keyup", ".search-field input, .chzn-search input", function(e) {
		var code = e.keyCode ? e.keyCode : e.which;
		// Esck
		if (code == 13) {
			var $this = $(this),
				val = $this.val(),
				select = $this.closest(".chzn-container").prev("select");

			if (val.length > 0) {

				var val_tag = select.children("option[value='"+val.toLowerCase()+"']");

				if ( val_tag.size() > 0 ) {
					val_tag.attr("selected", true);
					return;
				}

				select.append('<option value="'+val.toLowerCase()+'" selected>'+val+'</option>');
				select.trigger("liszt:updated");
				// select.trigger("chosen:updated");
			}
		}
	});


	var $course_period = $("#course-period-range"),
		course_period_val = $course_period.next("[data-range]").attr("data-range");
	$course_period.noUiSlider({
		range: [1, 99],
		start: course_period_val,
		handles: 1,
		step: 1,
		serialization: {
			"to": "course_period"
		},
		slide: function(){
			var values = $(this).val();
			$course_period.find("a:first-child div").html("<span>" + values + "&nbsp;Days</span>");
		}		
	}, true);
	$course_period.find("a:first span").html( course_period_val+"&nbsp;Days" );

	$d.on("keyup", "textarea.autogrow", function(e) {
		while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
			$(this).height($(this).height()+1);
		};
	});

	/**
	 * Dash sections
	 */
	// $(".large-btns [data-section]").on("click", function(e) {
	$("[data-section]").on("click", function(e) {
		var $this = $(this),
			box_id = $this.attr("data-section"),
			siblings_class = $this.attr("data-siblings");

		$this.addClass("active").siblings().removeClass("active");
		$("#"+box_id).show().siblings( "."+siblings_class ).hide();

		// slimScroll for questions
		$("#"+box_id).find(".custom-scroll").slimScroll({
			position: "right",
			// height: $(".video-stream").parent().height()+"px",
			height: 480 * 2,
			size: "3px",
			railVisible: true,
			railColor: "#dedede",
			railOpacity: 0.8,
			// distance: "2px",
			alwaysVisible: true,
			color: "#8aa3be",
			opacity: 1,
		    allowPageScroll: true
		});

		// $(".chzn-select").chosen({allow_single_deselect: true});
		$(".chzn-select").chosen();
		// $('.chzn-container').css('width', '');
		$('.chzn-container').each(function(i, key) {
			var $this = $(this);
				select = $this.prev("select");
			select.show();
			$this.css('width', select.width());
			select.hide();
		});
	});

	/**
	 * Content type
	 */
	var $content_type = $(".content_type");
	if ($content_type.length > 0) {
		$d.on("change", ".content_type", function(e) {
			var $this = $(this),
				val = $this.val();
			// $(".content-type.active").hide();
			if (val == "") {
				$this.closest(".post-form").find(".content-type").hide();
				// $(".content-type").hide();
			} else {
				// $this.closest("form").find(".content-type.content-" + val).show()
				$this.closest(".post-form").find(".content-type.content-" + val).show()
				.siblings(".content-type").hide();
			}
		});
	}

	/**
	 * Question type
	 */
	var $question_type = $(".question_type");
	if ($question_type.length > 0) {
		$d.on("change", ".question_type", function(e) {
			var $this = $(this),
				val = $this.val(),
				question_box = $this.parent().next(".questions-box");

			if (val == "") {
				question_box.html("");
			} else {
				question_box.html( $("#"+val).html() );
			}

			// jCheckbox_init();
			$(".jCheckbox").jCheckbox();

			// Questions numbers log
			$(".q_num").val($(".question_type").size());

			/**
			 * Rename question fields
			 */
		    $(".q-section").each(function(key) {
		        var $this = $(this);
		        // key+	+;

		        $this.attr("id", "question-"+key).find("label.form-label:first").text("Question "+key);
		        $(".content-exam").find("textarea, input[type=radio], input[type=text], input[type=checkbox]").each(function() {
		            var $this = $(this),
		            	data_type = $this.attr("data-type"),
		                number = $this.closest(".q-section").attr("id").replace("question-", ""),
		                // name = $(this).attr("name"),
		                name_val = "";

		            if (data_type == "regular_q" || data_type == "mark_q" || data_type == "choices_q") {
		            	name_val = "question[]";
		            }
		            else if (data_type == "mark_a")
		            	name_val = "answer_"+number;
		            else if (data_type == "choices_a")
		            	name_val = "choices_"+number+"[]";
		            else if (data_type == "choices_a_mark")
		            	name_val = "choices_"+number+"_mark[]";
		            // else if (data_type == "regular_q")
		            // 	name_val = "regular_question["+number+"]";
		            // else if (data_type == "mark_q")
		            // 	name_val = "mark_question["+number+"]";
		            // else if (data_type == "choices_q")
		            // 	name_val = "choices_question["+number+"]";

		            $this.attr("name", name_val);
		        });
		    });
		});
	}

	/**
	 * New Choice
	 */
	$d.on("click", ".answers .new-choice", function(e) {
		var $this = $(this).parent("p"),
			$copy = $this.prev("p").clone(),
			count = $this.parent().find("p").size() - 1;

		if (count >= 8) {
			alert("Sorry, maximum choices is 8");
			return false;
		}

		$copy
		.find("input").val("").end()
		.find(".jCheckbox").jCheckbox().end()
		.find(".jCheckbox input").prop("checked", false).end()
		.find(".jCheckbox .checkbox-icon").removeClass("active").end()
		.insertBefore( $this );

		// $(".jCheckbox, .jCheckbox > *").off();
		// jCheckbox_init();
	});

	$d.on("click", ".jCheckbox, .new-choice", function(e) {
		var $parent = $(this).closest(".answers");
			// size = $parent.find("data-type[choices_a_mark]").size();

		$parent.find("[data-type=choices_a_mark]").each(function(index) {
			var $this = $(this),
				name = $this.attr("name");

			// $this.attr("name", name.replace("[]", "_"+(index+1)) );
			$this.attr("name", name.replace("[]", "_"+(index)) );
		});
	});
}

})(jQuery);