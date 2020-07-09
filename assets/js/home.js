function pageScript() {
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
  showPageAfterImageLoad(".bd-placeholder-img", {numberOfImages: 3, minimum: 3}, false);
  });
}