const loginOption = (id) => {
  if (id == 0) {
    // Remove active/show Class

    $(".login-option li").removeClass("active");
    $(".card-body").removeClass("show");

    // Add active/show Class
    $("#func").addClass("active");
    $("#cardFunc").addClass("show");
  } else {
    // Remove active/show Class
    $(".login-option li").removeClass("active");
    $(".card-body").removeClass("show");

    // Add active/show Class
    $("#client").addClass("active");
    $("#cardClient").addClass("show");
  }
};
