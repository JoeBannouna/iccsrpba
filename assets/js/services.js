function pageScript() {
  let categoryId = (findGetParameter("cat_id") !== null) ? "&cat_id=" + findGetParameter("cat_id") : "";

  $.ajax({
    type: "GET",
    url: `/php/services.php?services=1${categoryId}`,
    success: function (response) {
      console.log(response);
      let services = JSON.parse(response);
    
      let numberOfCards = 0;

      let divNumber = 0;
      services.map(({id, title, description, imgurl}, index) => {
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
                    <form action="../php/services.php" method="POST"><input name="mode" hidden value="DELETE"><input name="id" hidden value="${id}"><button type="submit" class="btn btn-danger">حذف</button></form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>`
      )
      numberOfCards++;
      })

      // Pagination script
      let numberOfPages = Math.ceil(services.length / 3);
      let i = 0;
      while (i < numberOfPages) {
        i++;
        $("#categories-pagination ul").append(`<li class="page-item"><a class="page-link" onclick="managePagination(70, ${i})">${i}</a></li>`);
      }
 
      showPageAfterImageLoad(".card-img-top", {numberOfImages: numberOfCards, minimum: 3}, false);
      managePagination("NoScroll", 1);
    }
  });
}