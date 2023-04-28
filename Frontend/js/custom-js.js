// On page load
$(document).ready(function () {
  // Sidebar toggle
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });

  // Toast message show on load
  $(".toast").toast("show");

  // Template field add & delete row
  $("#addRow").click(function () {
    //Add row
    row = "";
    row +=
      // '<tr><td><input type="text" class="form-control"></td><td ><input type="date" class="form-control"></td><td><input type="date" class="form-control"></td><td><input type="number" class="form-control"></td>';
      '<tr class="draggable-item"><td class="fixed-col"><i class="bi bi-arrows-move pe-2"></i>Row number</td><td><select class="form-select" aria-label="Default select example"><option selected>Select data field</option><option value="1">Data field 1</option><option value="2">Data field 2</option><option value="3">Data field 3</option></select></td><td><input class="form-check-input mt-0 me-2" type="checkbox" value="" id="flexCheckDefault"><label class="form-check-label" for="flexCheckDefault">Mandatory field</label></td>';
    row +=
      // '<td><button class="btn btn-outline-danger delete_row">remove</button></td></tr>';
      '<td><button type="button" class="btn neutral-outlin-btn deleteRow"><i class="bi bi-trash3-fill pe-2"></i>Delete field</button></td></tr>';
    $("tbody").append(row);
  });

  $("#templateFieldTable").on("click", ".deleteRow", function () {
    $(this).closest("tr").remove();
  });

  // Add event listener to every new row that is added
  $("#templateFieldTable").on("change", "select", function () {
    // Code to handle select change goes here...
  });
});

// home search bar dropdown list
$(document).ready(function () {
  $(".default_option").click(function () {
    $(".dropdown ul").addClass("active");
  });

  $(".dropdown ul li").click(function () {
    var text = $(this).text();
    $(".default_option").text(text);
    $(".dropdown ul").removeClass("active");
  });
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
$(function () {
  $("select").selectpicker();
});

// Template fields drag to order
function init() {
  $(".droppable-area1, .droppable-area2")
    .sortable({
      connectWith: ".connected-sortable",
      stack: ".connected-sortable",
    })
    .disableSelection();
}

$(init);

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
