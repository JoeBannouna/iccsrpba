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
    url: "components/contact",
    success: function (response) {
      $("#contact-us-form").html(response);
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
    let number = categories.length - 1;
    for (let i = 0; i < 3; i++) {
      dropDownItems.push(categories[number]);
      number--;
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

  });
}

$.ajax({
  type: "get",
  url: "components/header",
  success: function (response) {
    $(".header.text-center").html(response);
    loadContact();
  }
});