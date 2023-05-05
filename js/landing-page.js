$(document).on("submit", 'form', function (e) {
  e.preventDefault();
  clearErrors();
  var formName = this.name;
  var error = $('form[name="' + formName + '"]>.alert-danger');
  error.hide();
  var validate = validateForm(formName);
  if (validate.length !== 0) {
    error.html(validate.join('<br>'));
    error.show();
    return false;
  }
  
  var submitBtn = $('form[name="' + formName + '"]>div>button[type="submit"]');
  submitBtn.html("Processing... <i class='fa fa-spinner fa-spin'></i>");
  $('button').prop('disabled', true);
  
  formdata = new FormData(this);
  formdata.append('form', formName);
  
  $.ajax({
    method: "POST",
    url: base_url+"module/landing_page.php",
    data: formdata,
    processData: false,
    contentType: false,
    success: function (result) {
      result = JSON.stringify(result).replace(/"/g,"");
      if (result == 1) {
        submitBtn.html("Submit <i class='fa fa-check'></i>");
        location.reload();
      } else {
        error.html( "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> " + result);
        error.show();
        submitBtn.html("Submit <i class='fa fa-check'></i>");
        $('button').prop('disabled', false);
      }
    }
  })
    .fail(function( msg ) {
        error.html(msg);
        submitBtn.html("Submit <i class='fa fa-check'></i>");
        $('button').prop('disabled', false);
    }
    
  );
  
});

function validateForm(formname){
  switch (formname) {
    case 'login':
      return validateLogin();
    case 'signup':
      return validateSignup();
    default:
      return false;
  }
}

function validateLogin() {
  var fields = "login_username,login_password";
  var result = [];
  if (!requireFields2(fields)) {
    result.push(MessageFieldRequired);
  }
  return result;
}

function validateSignup() {
  var fields = "username,email,password,password_retype,firstname,lastname,address,contact,gender";
  var password = $('#password');
  var password_retype = $('#password_retype');
  var result = [];
  
  if (!requireFields(fields)) {
    result.push(MessageFieldRequired);
  }
  if (password.val() != password_retype.val()) {
    errorFields("password,password_retype");
    result.push(MessagePasswordNotMatch);
  }
  return result;
}

  
$(document).on("click", '[data-link="menu"],.view-eto', function () {  
      var page = $(this).attr('name');
      $('a.sidebar-btn').removeClass('active');
    $(this).addClass('active');
    
    $(".result").html('');
    $("#myCarousel").html('');
    $( "#content" ).load( base_url+'module/page.php?page='+page );
  });