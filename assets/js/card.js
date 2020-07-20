function pageScript() {
  isCategoriesPage = true;

  let cardId = findGetParameter("id");
  $.ajax({
    type: "GET",
    url: "php/card.php?id=" + cardId,
    success: function (response) {
      const card = JSON.parse(response);
      const {id, title, description, textarea, cat_id} = card;

      // Card implementing
      $("#card-title").html(title);
      $("#back-link").attr("href", `category?id=${cat_id}`);
      $("#card-description").html(description);
      $("#card-textarea").attr("placeholder", textarea);
      $("#card-img").attr("src", "images/services/" + id + ".png");
      
      showPageAfterImageLoad("#card-img", {numberOfImages: 1, minimum: 1}, false);

      let offset = $(`#card-title`).offset();
      offset.top -= 70;
      $([document.documentElement, document.body]).animate({
        scrollTop: offset.top
      }, 1);
    }
  });
}