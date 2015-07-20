( function( $ ) {
// read more
	$(".hide_expand").toggle(function(){
		// 続きを読むリンクの親要素の兄姉（next）にhide_objがある場合
		var prevItemParentNext = $(this).parent().next(".hide_obj");
		// 続きを読むリンクが、hide_objの次にある場合（内包されていない）
		var prevItemNext = $(this).next(".hide_obj");
		// 続きを読むの中身（html）
		var prevItemParentNextText = $(prevItemParentNext).html();

		var lastText;
		if($(this).parent().hasClass("last_block")) {
			lastText = $(this).parent();
		} else {
			lastText = $(this).parent().addClass("last_block");
		}
		
		if(prevItemParentNext.length) { // 親要素の隣にhide_objがある場合
			var hideObj = $("<div class='hide_obj on liquid'></div>");
			var hideObjContent = $(hideObj).append(prevItemParentNextText);
			$(lastText).append(hideObjContent);
			$(hideObjContent).children(":first-child").css({display:"inline"});
			$(this).find(".text_expand").text("閉じる");
			$(prevItemParentNext).remove();
			lastText.append($(this));
		} else if( prevItemNext.length ) { // ボタンの次にhide_objがある場合
			$(this).next(".hide_obj").addClass("on");
			$(this).find(".text_expand").text("閉じる");
			prevItemNext.after($(this));
		}
		return false;
	}, function(){
			var prevItemParentNext = $(this).prev(".hide_obj");
			var lastText = $(this).prev(".last_block");
			var lastTextPrev = prevItemParentNext.prev(".last_block");
			var hideoObjHtml;
			if($(prevItemParentNext).hasClass("liquid")) {
				hideoObjHtml = $("<div class='hide_obj liquid'></div>");
			} else {
				hideoObjHtml = $("<div class='hide_obj'></div>");
			}
			if( prevItemParentNext.length ) {
				var hideObj = prevItemParentNext.html();
				$(hideoObjHtml).append(hideObj);
				$(this).after(hideoObjHtml);
				$(prevItemParentNext).remove();
				$(this).append(lastText);
				$(this).find(".text_expand").text("…続きを読む");
			}
		}
	);

} )( jQuery );