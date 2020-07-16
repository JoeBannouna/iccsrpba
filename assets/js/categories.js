function pageScript(cat) {
  isCategoriesPage = true;

  // Category implementing
  let numberOfCards = 0;
  let divNumber = 0;
  pixels = (typeof cat === "object") ? false : 20;
  (pixels === false) ? categories = cat : "" ;
  categories.map(({id, name, imgurl}, index) => {
    if (index % 6 === 0) {
      $(`.categories-span${divNumber}`).after(`<div style="display: none;" class="row categories-span categories-span${divNumber + 1}"></div>`);
      divNumber++;
    }
    $(`.categories-span${divNumber}`).append(
  `<div class="col-md-4 text-justify text-center">
      <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="${imgurl}">
      <h4>${name}</h4>
      <p>` + ((typeof cat === "object") ? `<!-- Button trigger modal -->
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#index${index}">حذف</button>
      
      <!-- Modal -->
      <div class="modal fade" id="index${index}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-*-center" id="exampleModalLabel">هل انت متأكد؟</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            هل تريد حذف هذا القسم
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
              <form action="../php/category.php" method="POST"><input name="mode" hidden value="DELETE"><input name="id" hidden value="${id}"><button type="submit" class="btn btn-danger">حذف</button></form>
            </div>
          </div>
        </div>
      </div>` : `<a class="btn btn-secondary arabic" href="category.html?id=${id}" role="button">التفاصيل &raquo;</a>`) + `</p>
    </div>`
  )
  numberOfCards++;
  })
  
  // Pagination script
  let numberOfPages = Math.ceil(categories.length / 6) ;
  let i = 0;
  while (i < numberOfPages) {
    i++;
    $("#categories-pagination ul").append(`<li class="page-item"><a class="page-link" onclick="managePagination(false, ${i});">${i}</a></li>`);
  }

  showPageAfterImageLoad(".bd-placeholder-img", {numberOfImages: numberOfCards, minimum: 6}, pixels);
}
