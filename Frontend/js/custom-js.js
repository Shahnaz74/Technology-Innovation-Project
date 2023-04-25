// Sidebar toggle
$(document).ready(function () {
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });
});

// Toast message
$(".toast").toast("show");
