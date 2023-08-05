
var MessageFieldRequired = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please Enter Missing Fields.";
var MessagePasswordNotMatch = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Password Does Not Match.";

function clearErrors() {
  // Remove all error css
  $('form>.alert-danger').hide();
  $(".is-invalid").removeClass("is-invalid");
}

function errorFields(strings) {
  $.each(strings.split(","), function (i,word) {
    var field = $("#" + word);
      if (!$(field).hasClass("is-invalid")) {
        $(field).addClass("is-invalid");
      }
  });
}

function requireFields(strings) {
  var errors = 0;
  $.each(strings.split(","), function (i,word) {
    var field = $("#" + word);
    if (field.val() == "" || field.val() == null || field.val().length == 0) {
      if (!$(field).hasClass("is-invalid")) {
        $(field).addClass("is-invalid");
      }
      errors++;
    }
  });
  return (errors == 0) ? true : false;
}

function requireFields2(strings) {
  var errors = 0;
  $.each(strings.split(","), function (i,word) {
    var field = $("#" + word);
    if (field.val() == "" || field.val() == null || field.val().length == 0) {
      if (!$(field).hasClass("is-invalid")) {
        $(field).addClass("is-invalid");
      }
      errors++;
    }
  });
  return (errors == 0) ? true : false;
}

if ("page" in localStorage) {
  localStorage.setItem('page', localStorage.getItem('page'));
} else {
  localStorage.setItem('page', '');
}

if ("id" in localStorage) {
  localStorage.setItem('id', localStorage.getItem('id'));
} else {
  localStorage.setItem('id', '');
}

   function city() {
      $.ajax({
            method: "POST",
            url: base_url+"/module/city.php?id=" + $('select[name="province"]').val()
         })
         .done(function(result) {
            $('select[name="city"]').html(result);
            barangay();
         });
   }

   function barangay() {
      $.ajax({
            method: "POST",
            url: base_url+"/module/barangay.php?id=" + $('select[name="city"]').val()
         })
         .done(function(result) {
            $('select[name="barangay"]').html(result);
         });
}

   function parent_account($default = 0) {
      $.ajax({
            method: "POST",
            url: base_url+"/module/parent_account.php?id=" + $('select[name="account_type"]').val()+"&selected="+$default
         })
         .done(function(result) {
            $('select[name="parent_account_type"]').html(result);
         });
}

    function toggleSubAccountSection() {
      if ($('select[name="account_type"]').find(':selected').data('child') == 0 || $('select[name="account_type"]').val() == 4) {
        $('#subaccount').hide();
      } else {
        $('#subaccount').show();
      }
    }



function toggleSubAccountCheckbox() {
  if ($('#is_sub_account').is(":checked")) {
        $('#paccount').show();
  } else {
        $('#paccount').hide();
  }
}

$('#menu_search').on('input', function () {
  let text = $(this).val();
  let list = document.querySelectorAll("#side-menu>li:not(.sidebar-search)");
  
  if (text == '') {
    list.forEach(element => {
      $(element).show();
    });
  } else {
    list.forEach(element => {
      console.log();
      if (!($(element).children()[0].innerText).toUpperCase().includes(text.toUpperCase())) {
        $(element).hide();
      } else {
        $(element).show();
      }
    });
  }
 });