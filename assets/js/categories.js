function pageScript() {
  // Category implementing
  let divNumber = 0;
  categories.map(({id, name, imgurl}, index) => {
    if (index % 6 === 0) {
      $(`.categories-span${divNumber}`).after(`<div style="display: none;" class="row categories-span categories-span${divNumber + 1}"></div>`);
      divNumber++;
    }
    $(`.categories-span${divNumber}`).append(
  `<div class="col-md-4 text-align-center">
      <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="${imgurl}">
      <h4>${name}</h4>
      <p>
        <a class="btn btn-secondary arabic" href="category.html?id=${id}" role="button">التفاصيل &raquo;</a>
      </p>
    </div>`
  )
  })
  
  // Pagination script
  let numberOfPages = Math.ceil(categories.length / 6) ;
  let i = 0;
  while (i < numberOfPages) {
    i++;
    $("#categories-pagination ul").append(`<li class="page-item"><a class="page-link" href="#page${i}">${i}</a></li>`);
  }

  // Hashtag management
  managePagination();
  $(window).on('hashchange', managePagination);
}
