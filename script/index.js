$(document).ready(function () {
   $(".tabqie a").click(function(){
     $(this).addClass("cur").siblings().removeClass("cur");
     var x = $(this).index();
     $(".contqie").eq(x).show().siblings(".contqie").hide();
   });
})
