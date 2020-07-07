let servicesDropdown = false;
var categories;

function loadContact() {
  $.ajax({
    type: "get",
    url: "components/contact.html",
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
    let dropDownItems = [];
    for (let i = 0; i < 3; i++) {
      dropDownItems.push(categories[i]);
    }
    dropDownItems.map(({id, name}) => $(".span-services-dropdown span").append(`<li class="nav-item"><a class="nav-link" href="category.html?id=${id}"><i class="fas fa-arrow-left fa-fw mr-2"></i> &nbsp;${name}</a></li>`));
    
    $(".services-dropdown").on("click", () => {
      servicesDropdown = servicesDropdown ? false : true;
      servicesDropdown ? $(".services-dropdown").parent().addClass("active") : $(".services-dropdown").parent().removeClass("active");
      $(".span-services-dropdown").slideToggle();
    });
  });
}

$.ajax({
  type: "get",
  url: "components/header.html",
  success: function (response) {
    $(".header.text-center").html(response);
    loadContact();
  }
});