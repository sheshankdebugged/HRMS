jQuery(document).ready(function ($) {


    // $("[data-toggle=popover]").popover({
    //     html : true,
    //     trigger: 'focus',
    //     content: function() {
    //         var content = $(this).attr("data-popover-content");
    //         return $(content).children(".popover-body").html();
    //     }
    // });
    
	$("#datepicker").datepicker({ 
	        autoclose: true, 
	        todayHighlight: true
	 }).datepicker('update', new Date());

	$('.dropdown-custom').click(function(e){
    if($('.dropdown.action-drop').hasClass('active')){
        $(this).removeClass('active');
    }
    $(this).parent().toggleClass('active');
});
$('.menu-toggle-mob').click(function(e){
  $('body').toggleClass('mobile-menu');
});
//         $('#myTabs a').click(function (e) {
//   e.preventDefault()
//   $(this).tab('show')
// })

    

});
