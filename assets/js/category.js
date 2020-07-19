function pageScript() {
  isCategoriesPage = true;

  let categoryId = findGetParameter("id");
  $.ajax({
    type: "GET",
    url: "php/category.php?id=" + categoryId,
    success: function (response) {
      let category = JSON.parse(response);
      // Category implementing
      $(".cards h1").html(category.name);
    
      let numberOfCards = 0;

      let divNumber = 0;
      category.services.map(({id, title, description, imgurl}, index) => {
        if (index % 3 === 0) {
          $(`.categories-span${divNumber}`).after(`<div style="display: none;" class="row categories-span categories-span${divNumber + 1}"></div>`);
          divNumber++;
        }
        $(`.categories-span${divNumber}`).append(
      `<div class="col-sm-4">
        <div class="card">
          <img src="${imgurl}" class="card-img-top" alt="${title}">
          <div class="card-body">
            <h5 class="card-title">${title} </h5>
            <p class="card-text">${description}</p>
            <a href="card.html?id=${id}" class="btn btn-primary">المزيد من التفاصيل</a>
          </div>
        </div>
      </div>`
      )
      numberOfCards++;
      })

      // Pagination script
      let numberOfPages = Math.ceil(category.services.length / 3) ;
      let i = 0;
      while (i < numberOfPages) {
        i++;
        $("#categories-pagination ul").append(`<li class="page-item"><a class="page-link" onclick="managePagination(70, ${i})">${i}</a></li>`);
      }
 
      showPageAfterImageLoad(".card-img-top", {numberOfImages: numberOfCards, minimum: 3}, 70);
      managePagination(70, 1);
    }
  });
}