$(document).ready(function() {
  $("#trans").hover(
    function (e) { 
      $(".body_t_over").fadeIn("slow");
      
    },
    function (e) {
      $(".body_t_over").fadeOut("slow");
      
    }
  );
   $("#ultra").hover(
    function (e) { 
      $(".body_u_over").fadeIn("slow");
      
    },
    function (e) {
      $(".body_u_over").fadeOut("slow");
      
    }
  );
    $("#centre").hover(
    function (e) { 
      $(".body_c_over").fadeIn("slow");
      
    },
    function (e) {
      $(".body_c_over").fadeOut("slow");
      
    }
  );
     $("#sud").hover(
    function (e) { 
      $(".body_s_over").fadeIn("slow");
      
    },
    function (e) {
      $(".body_s_over").fadeOut("slow");
      
    }
  );
});    