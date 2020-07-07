function pageScript() {
  let categoryId = findGetParameter("id");
  $.ajax({
    type: "GET",
    url: "php/category.php?id=" + categoryId,
    success: function (response) {
      let category = JSON.parse(response);
      // Category implementing
      $(".cards h1").html(category.name);
    
      let divNumber = 0;
      category.services.map(({id, name, description, imgurl}, index) => {
        if (index % 3 === 0) {
          $(`.categories-span${divNumber}`).after(`<div style="display: none;" class="row categories-span categories-span${divNumber + 1}"></div>`);
          divNumber++;
        }
        $(`.categories-span${divNumber}`).append(
      `<div class="col-sm-4">
        <div class="card">
          <img src="${imgurl}" class="card-img-top" alt="${name}">
          <div class="card-body">
            <h5 class="card-title">${name} </h5>
            <p class="card-text">${description}</p>
            <a href="card.html?id=${id}" class="btn btn-primary">المزيد من التفاصيل</a>
          </div>
        </div>
      </div>`
      )
      })
      
      // Pagination script
      let numberOfPages = Math.ceil(category.services.length / 3) ;
      let i = 0;
      while (i < numberOfPages) {
        i++;
        $("#categories-pagination ul").append(`<li class="page-item"><a class="page-link" href="#page${i}">${i}</a></li>`);
      }
    
      // Hashtag management
      managePagination(70);
      $(window).on('hashchange', () => managePagination(70));
    }
  });
}