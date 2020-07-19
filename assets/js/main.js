// MAIN SCRIPT

function mainScript(imageLoading) {

  if (typeof pageLoaded === "undefined") var pageLoaded = false;

  // Highlight active header link
  let activeHeaderLink = $("#main-script").attr("activeHeaderLink");
  if (typeof activeHeaderLink !== "undefined") $("." + activeHeaderLink).addClass("active");

  // Contact button
  $(".contact-us-button").click(function() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#contact-us-form").offset().top
    }, 2000);
  });

  // If there is no images to load show the page
  if (imageLoading === false) {
    showPageLoading();
  } else {                        // Else wait for a maximum of 7 seconds
    setTimeout(() => {
      if (!pageLoaded) {
        showPageLoading();
        console.log("Timer ran out");
      }
    }, 4000);
  }
}


// OTHER FUNCTIONS

// Check if value can be numeric
function isInteger(value) {
  return /^\d+$/.test(value);
}

// Pagination function
function managePagination(scrollOffset, pageNo) {
  if (typeof page === "undefined") {
    page = 1;
  } else {
    page = pageNo;
  }
  $(".categories-span").css("display", "none");
  $(`.categories-span${pageNo}`).css("display", "");
  $("#categories-pagination ul li a").css("background", "white");
  
  if (isInteger(page)) {
    const clickedButton = (typeof document.getElementById("categories-pagination").children[0].children[(page - 1)] !== "undefined") ? document.getElementById("categories-pagination").children[0].children[(page - 1)].children[0] : showPageLoading();
    $(clickedButton).css("background", "#c1c1c1");
  }
  // Scroll to top for mobile :/
  let offset = $(`.categories-span0`).offset();
  if (!isInteger(scrollOffset)) scrollOffset = 20;
  offset.top -= scrollOffset;
  $([document.documentElement, document.body]).animate({
    scrollTop: offset.top
  }, 1);

  // if (typeof scrollToContact !== "undefined") scrollToContact(); else console.log("no");

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

// Hide loading animation and show page
function showPageLoading() {
  $("div.loading-page").css("display", "block");
  $(".main-page-core").css("opacity", "1");
  $(".loading-icon").css("display", " none");
}

// Check if images is loaded to show the page
function showPageAfterImageLoad(selector, {numberOfImages, minimum}, movePixels, callback) {
  $(selector).one("load", () => {
    imageLodingFunc();
  });
  
  $(selector).one("error", () => {
    imageLodingFunc();
  });

  const imageLodingFunc = () =>  {
    imagesLoaded++;
    if (imagesLoaded == numberOfImages || imagesLoaded > minimum) {
      showPageLoading();
      pageLoaded = true;
      
      if (typeof callback === "function") {
        callback();
      }

      // Hashtag management
      if (movePixels !== false) {
        managePagination(movePixels, 1);
      }
    }
  }

}