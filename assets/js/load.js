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
    url: "components/contact?v=1",
    success: function (response) {
      $("#contact-us-form").html(response);
      $("#referrer-input").val(window.location.href);
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
    dropDownItems.map(({id, name}) => $(".span-services-dropdown span").append(`<li class="nav-item"><a class="nav-link" href="category.html?id=${id}"><i class="fas fa-arrow-left fa-fw mr-2"></i> &nbsp;${name}</a></li>`));
    
    $(".services-dropdown").on("click", () => {
      servicesDropdown = servicesDropdown ? false : true;
      if (!isCategoriesPage) servicesDropdown ? $(".services-dropdown").parent().addClass("active") : $(".services-dropdown").parent().removeClass("active");
      $(".span-services-dropdown").slideToggle();
    });
    
    const pageScriptExists = typeof pageScript !== "undefined";
    
    // Start the main.js and Execute page script if it exists.
    if (pageScriptExists) {
      mainScript();
      pageScript();
    } 
    else mainScript(false);

    typeof contactScript !== "undefined" ? contactScript() : '';

  });
}

$.ajax({
  type: "get",
  url: "components/header?v=1",
  success: function (response) {
    $(".header.text-center").html(response);
    loadContact();
  }
});