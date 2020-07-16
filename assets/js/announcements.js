function pageScript(callback) {

  if (typeof callback === "function") callback();
  var dashboard = true;

  $.ajax({
    type: "GET",
    url: "/php/announcements.php",
    success: function (response) {
      let announcements = JSON.parse(response);
      // Announcements implementing
      let numberOfCards = 0;
      let divNumber = 0;
      announcements.map(({id, name, description, date}, index) => {
        if (index % 10 === 0) {
          $(`.categories-span${divNumber}`).after(`<div style="display: none;" class="row categories-span categories-span${divNumber + 1}"></div>`);
          divNumber++;
        }
        $(`.categories-span${divNumber}`).append(
      `
      <div class="card w-100 alert-success announcement">
        <div class="card-body margin-bottom-0">
          <h2 class="display-4 card-title text-center"><small><small>${name}</small></small></h2>
          <p class="h5 card-text">${description}</p>
          <div class="margin-bottom-0">
            <h6 class="font-weight-lighter d-flex justify-content-right">${date}</h6>`+
            ((dashboard) ? `<div class="d-flex justify-content-center margin-bottom-0"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#index${index}">حذف</button></div>` : ``)
          + `</div>
        </div>
      </div>` +
    ((dashboard) ? `            
      
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
          هل تريد حذف هذا الخبر
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
            <form action="../php/announcements.php" method="POST"><input name="mode" hidden value="DELETE"><input name="id" hidden value="${id}"><button type="submit" class="btn btn-danger">حذف</button></form>
          </div>
        </div>
      </div>
    </div>` : ``)
      )
      numberOfCards++;
      })
      
      // Pagination script
      let numberOfPages = Math.ceil(announcements.length / 10);
      let i = 0;
      while (i < numberOfPages) {
        i++;
        $("#categories-pagination ul").append(`<li class="page-item"><a class="page-link" onclick="managePagination(false, ${i});">${i}</a></li>`);
      }

      showPageLoading();
      managePagination(70, 1);

      if (dashboard) callback();
    },
  });
}
