// Sidebar toggle
$(document).ready(function () {
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });
});

// Toast message
$(".toast").toast("show");

// Sticky header
const header = document.getElementById("form-header");
const intercept = document.createElement("div");

intercept.setAttribute("data-observer-intercept", "");
header.before(intercept);

const observer = new IntersectionObserver(([entry]) => {
  header.classList.toggle("active", !entry.isIntersecting);
});

observer.observe(intercept);
