// MAIN SCRIPT

function mainScript() {
  // Highlight active header link
  let activeHeaderLink = $("#main-script").attr("activeHeaderLink")
  if (typeof activeHeaderLink !== "undefined") $("." + activeHeaderLink).addClass("active");

  // Contact button
  $("#contact-us-button").click(function() {
    console.log("this should work")
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#contact-us-form").offset().top
    }, 2000);
  });
}


// OTHER FUNCTIONS

// Check if value can be numeric
function isInteger(value) {
  return /^\d+$/.test(value);
}

// Pagination function
function managePagination(scrollOffset) {
  if (document.location.hash !== "") {
    $(".categories-span").css("display", "none");
    $(`.categories-span${document.location.hash[5]}`).css("display", "");
  } else {
    document.location.hash = "#page1";
    $(".categories-span").css("display", "");
  }
  $("#categories-pagination ul li a").css("background", "white");
  
  if (isInteger(document.location.hash[5])) {
    const clickedButton = document.getElementById("categories-pagination").children[0].children[(document.location.hash[5] - 1)].children[0];
    $(clickedButton).css("background", "#c1c1c1");
  }
  // Scroll to top for mobile :/
  let offset = $(`.categories-span0`).offset();
  if (!isInteger(scrollOffset)) scrollOffset = 20;
  offset.top -= scrollOffset;
  $([document.documentElement, document.body]).animate({
    scrollTop: offset.top
  }, 1);
}

// Get GET parameters
function findGetParameter(parameterName) {
  var result = null,
      tmp = [];
  location.search
      .substr(1)
      .split("&")
      .forEach(function (item) {
        tmp = item.split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
      });
  return result;
}