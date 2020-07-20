var isCategoriesPage;
var categories;
var dropDownItems = [];
var pageLoaded;
var page;
var imagesLoaded = 0;
let servicesDropdown = false;

function loadContact() {
  $.ajax({
    type: "get",
    url: "components/contact?v=6",
    success: function (response) {
      $("#contact-us-form").html(response);
      $(".referrer-input").val(window.location.origin + window.location.pathname + window.location.search);
      $("#order-url").val(window.location.href);
      loadCategories();
    }
  });
}

function loadCategories() {
  $.ajax({
    type: "get",
    url: "php/categories.php",
    success: function (response) {
      categories = JSON.parse(response);
      startMain();
    }
  });  
}

function startMain() {
  $(function () {
    // Header drop down functionality
    let number = 0;
    let max = (categories.length > 2) ? 3 : categories.length;
    for (let i = 0; i < max; i++) {
      dropDownItems.push(categories[number]);
      number++;
    }
    // dropDownItems.map(({id, name}) => $(".span-services-dropdown span").append(`<li class="nav-item"><a class="nav-link" href="category.html?id=${id}"><i class="fas fa-arrow-left fa-fw mr-2"></i> &nbsp;${name}</a></li>`));
    
    let i = categories.length;
    let third = (i / 3);
    let rowNumber = 1;
    categories.map(({id, name}, index) => {
      if (third < index) {
        third *= 2;
        rowNumber++;
      }
      $(`.row-${rowNumber} ul`).append(`<li><a class="nav-link services-dropdown" href="category.html?id=${id}"> &nbsp;${name}</a></li>`);
    });
    
    $(".services-dropdown").on("mouseover", () => {
      $(".span-services-dropdown").css("display", "flex");
      $(".nav-link:not(.services-dropdown)").on("mouseover", () => {servicesDropdown ? "" : $(".span-services-dropdown").css("display", "none");});
    });

    $(".main-wrapper").on("mouseover", () => {servicesDropdown ? "" : $(".span-services-dropdown").css("display", "none");});
    $(".main-wrapper").on("click", () => {toggleServiceMenu(false);});
    // $(":not(.navbar-nav.flex-column.text-right, .navbar-nav.flex-column.text-right *, .navbar-nav.flex-column.text-right * *, .navbar-nav.flex-column.text-right * * *)").on("click", () => {toggleServiceMenu(false);});
    
    $(".services-dropdown").on("click", () => {
      toggleServiceMenu(true);
    });
    
    function toggleServiceMenu(alwaysClose) {
      if (alwaysClose === false) {
        if (!isCategoriesPage) $(".services-dropdown").parent().removeClass("active");
        $(".span-services-dropdown").css("display", "none");
        servicesDropdown = false;
      } else if (alwaysClose === true) {
        servicesDropdown = !servicesDropdown;
        if (!isCategoriesPage) servicesDropdown ? $(".services-dropdown").parent().addClass("active") : $(".services-dropdown").parent().removeClass("active");
        servicesDropdown ? $(".span-services-dropdown").css("display", "flex") : $(".span-services-dropdown").css("display", "none");
      }
    }

    const pageScriptExists = typeof pageScript !== "undefined";
    
    // Start the main.js and Execute page script if it exists.
    if (pageScriptExists) {
      mainScript();
      pageScript();
    } 
    else mainScript(false);

    var LoadingButton = `
    <button class="btn btn-primary" type="button" disabled>
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      <span class="sr-only">Loading...</span>
    </button>
    `;

    $("form.contact").submit(e => { 
      $("#sendmail-submit-button-contact").replaceWith(LoadingButton);
    });
    
    $("form.order").submit(e => { 
      $("#sendmail-submit-button").replaceWith(LoadingButton);
    });

  });
}

$.ajax({
  type: "get",
  url: "components/header?v=6",
  success: function (response) {
    $(".header.text-center").html(response);
    loadContact();
  }
});