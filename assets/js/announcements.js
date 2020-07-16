function pageScript(callback) {

  $.ajax({
    type: "GET",
    url: "/php/announcements.php",
    success: function (response) {
      let announcements = JSON.parse(response);
      // Announcements implementing
      let numberOfCards = 0;
      let divNumber = 0;
      announcements.map(({name, description, date}, index) => {
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
            <h6 class="font-weight-lighter d-flex justify-content-right">${date}</h6>
          </div>
        </div>
      </div>`
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

      if (typeof callback === "function") callback();
    },
  });
}
