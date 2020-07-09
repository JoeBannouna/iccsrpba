function pageScript() {
  isCategoriesPage = true;
  
  let cardId = findGetParameter("id");
  $.ajax({
    type: "GET",
    url: "php/card.php?id=" + cardId,
    success: function (response) {
      const card = JSON.parse(response);
      const {id, name, description, imgurl, textarea} = card;

      // Card implementing
      $("#card-title").html(name);
      $("#card-description").html(description);
      $("#card-textarea").html(textarea);
      $("#card-img").attr("src", imgurl)
      $("#card-img").one("load", () => {
        $(".container-fluid").css("display", " block");
        $(".loading-icon").css("display", " none");
      });
      
      
    }
  });
}