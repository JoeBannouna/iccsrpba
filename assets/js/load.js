$.ajax({
  type: "get",
  url: "components/header.html",
  success: function (response) {
    $(".header.text-center").html(response);
  }
});