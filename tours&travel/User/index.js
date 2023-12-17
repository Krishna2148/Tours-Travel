

//show package booking form
$(document).on("click", ".bookPackageBtn", function (e) {
  e.preventDefault();
  var package_id = $(this).val();
  $("#bookPackageModal").modal();
});

//book package
$(document).on("submit", "#bookPackage", function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("book_package", true);
  $.ajax({
    async: true,
    type: "POST",
    url: "./bookpackage.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422 || res.status == 423) {
        $("#errorBookingMessage").removeClass("d-none");
        $("#errorBookingMessage").text(res.message);
      }
      if (res.status == 200) {
        $("#errorBookingMessage").removeClass("d-none");
        $("#bookPackage")[0].reset();
        alert("Request sent successfully");
        $("#bookPackageModal").modal("hide");
      }
    },
  });
});

//user review

var rating_data = 0;
var package_id;
$(document).on("click", "#add_review", function (e) {
  package_id = $(this).val();
  e.preventDefault();
  $("#review_modal").modal();
});

$(document).on("mouseenter", ".submit_star", function () {
  var rating = $(this).data("rating");

  reset_background();

  for (var count = 1; count <= rating; count++) {
    $("#submit_star_" + count).addClass("text-warning");
  }
});

function reset_background() {
  for (var count = 1; count <= 5; count++) {
    $("#submit_star_" + count).addClass("star-light");

    $("#submit_star_" + count).removeClass("text-warning");
  }
}

$(document).on("mouseleave", ".submit_star", function () {
  reset_background();

  for (var count = 1; count <= rating_data; count++) {
    $("#submit_star_" + count).removeClass("star-light");

    $("#submit_star_" + count).addClass("text-warning");
  }
});

$(document).on("click", ".submit_star", function () {
  rating_data = $(this).data("rating");
});
$(document).on("click", "#save_review", function (e) {
  var user_name = $("#user_name").val();

  var user_review = $("#user_review").val();
  if (user_name == "" || user_review == "") {
    alert("Please Fill Both Field");
    return false;
  } else {
    $.ajax({
      url: "./managerating.php",
      method: "POST",
      data: {
        package_id: package_id,
        rating_data: rating_data,
        user_name: user_name,
        user_review: user_review,
      },
      success: function (data) {
        $("#review_modal").modal("hide");
        alert(data);
        $("#user_review").load(location.href + "#user-review");

    },
    });
  }

});