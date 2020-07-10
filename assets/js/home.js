function pageScript() {

  $.ajax({
    type: "GET",
    url: "php/announcements.php?limit=3",
    success: function (response) {
      let announcements = JSON.parse(response);
      // Announcements implementing
      console.log(announcements);
      let divNumber = 0;
      announcements.map(({name, description, date}) => {
        $(".categories-span0").css("display", "none");
        $(".categories-span0").append(
      `<div class="card w-100 alert-success announcement">
        <div class="card-body margin-bottom-0">
          <h2 class="display-4 card-title"><small><small>${name}</small></small></h2>
          <p class="h5 card-text">${description}</p>
          <div class="margin-bottom-0">
            <h6 class="font-weight-lighter d-flex justify-content-right">${date}</h6>
          </div>
        </div>
      </div>`
      )
      })

      dropDownItems.map(({id, name, imgurl}) => {
        $(`.categories-span`).append(
        `<div class="col-md-4 text-align-center">
          <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="${imgurl}">
          <h4>${name}</h4>
          <p>
            <a class="btn btn-secondary arabic" href="category.html?id=${id}" role="button">التفاصيل &raquo;</a>
          </p>
        </div>`
      );
      showPageAfterImageLoad(".bd-placeholder-img", {numberOfImages: 3, minimum: 3}, false, function () {
        $(".categories-span0").css("display", "");
      });
      });
    }
  });
}