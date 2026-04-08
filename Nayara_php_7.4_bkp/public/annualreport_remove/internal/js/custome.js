//Menu Script
function openNav(n) {
  var x = document.getElementById("mySidenav");
  if (x.style.width == "100%") {
    x.style.width = "0%";
    n.classList.toggle("change");
  } else {
    x.style.width = "100%";
    n.classList.toggle("change");
  }
}

$(document).ready(function() {
	//Mobile Navigation Section
	$(".nav-section").click(function(){
		$(".sidenav").toggleClass("sidenavMobile");
	});
	  
	//Read More text Script
	$('.btn-more').click(function(e) {
	  e.preventDefault();
	  $(this).text(function(i, t) {
		return t == 'READ LESS' ? 'READ MORE' : 'READ LESS';
	  }).prev('.more-text').slideToggle()
		$(this).hide();
	});
	
	
	
	 //Download Section
	  $(".btn-download, .btn-close").click(function(){
		$(".financial-performance-bg").slideToggle();
		$(".btn-download i").toggleClass("icon-arrow-up icon-arrow-down");
	  });
  
});