$().ready(function() {
	$("#theList tr").hover(function() {
	$(this).toggleClass("highlight")
	},function() {$(this).toggleClass("highlight")});
	var print= "<img src='/sms/images/printButton.png'>"
	$("#print").each(function() {
	$(this).append(print)});
	

	});