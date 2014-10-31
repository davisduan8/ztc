// JavaScript Document
$(function(){
	//tab
	$(".tabtag li").click(function(){
		$(this).addClass("cur").siblings().removeClass("cur");
		$(".tabcon .con").eq($(".tabs .tabtag li,.tabtag li").index(this)).show().siblings().hide();
	});
	//tab end
	$(".side_menu dd").hover(function() {
		$(this).addClass("cur_hover");
	}, function() {
		$(this).removeClass("cur_hover");
	});
	//select
	$(".select_box input").click(function(){
		var thisinput = $(this);
		var thisul = $(this).parent().find("ul");
		if(thisul.css("display")=="none"){
			thisul.fadeIn("100");
			thisul.mouseleave(function() {
				$(this).fadeOut("100")
			});
			thisul.find("li").click(function(){
				thisinput.val($(this).text());
				thisul.fadeOut("100");
			}).hover(function() {
				$(this).addClass("cur")
			}, function() {
				$(this).removeClass("cur")
			});
		}else{
			thisul.fadeOut("100")
		}
	})
})




