$('.dash-btn').toggleClass("active");


$('.feat-btn').click(function(){
    $('.feat-btn').toggleClass("active");
    $('.sidebar-menu ul .feat-show').toggleClass("show");
});

$('.serv-btn').click(function(){
    $('.sidebar-menu ul .serv-show').toggleClass("show");
    $('.serv-btn').toggleClass("active");
});



