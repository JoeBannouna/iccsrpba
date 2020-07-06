let servicesDropdown = false;

$(function () {
  $(".services-dropdown").on("click", () => {
    servicesDropdown = servicesDropdown ? false : true;
    servicesDropdown ? $(".services-dropdown").parent().addClass("active") : $(".services-dropdown").parent().removeClass("active");

    $(".span-services-dropdown").slideToggle();
  });
});