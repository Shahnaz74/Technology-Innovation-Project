// On page load
$(document).ready(function () {
  // Sidebar toggle
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });

  // Toast message show on load
  // $(".toast").toast("show");
});

// Sticky header
const header = document.getElementById("form-header");
const intercept = document.createElement("div");

intercept.setAttribute("data-observer-intercept", "");
header.before(intercept);

const observer = new IntersectionObserver(([entry]) => {
  header.classList.toggle("active", !entry.isIntersecting);
});

observer.observe(intercept);

// File keyword selector
// $(function () {
//   $("select").selectpicker();
// });

// Template fields drag to order
// function init() {
//   $(".droppable-area1, .droppable-area2")
//     .sortable({
//       connectWith: ".connected-sortable",
//       stack: ".connected-sortable",
//     })
//     .disableSelection();
// }

// $(init);

function renumber() {
  var count = 1;

  $("tbody tr").each(function () {
    $(this).find(".js-sort-number").text(count);

    count++;
  });
}

$("input.form-control").change(function () {
  var startNo = $(this).val();

  $(".js-start-number").text(startNo);
});

$(".connected-sortable").on("sortupdate", function (event, ui) {
  renumber();
});
