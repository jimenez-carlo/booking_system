
$(document).ready(function () {  
  $('[data-link="menu"]').click(function () {
      var page = $(this).attr('name');
      $('a.sidebar-btn').removeClass('active');
    $(this).addClass('active');
    
    $(".result").html('');
    $( "#content" ).load( base_url+'module/page.php?page='+page );
  });
});

$(document).on("submit", 'form', function (e) {
  e.preventDefault();
  clearErrors();
  var form_raw = this;
  var form_name = this.name;
  
  if (this.name == 'logout') {
    window.location.href = base_url+'module/logout.php';
  }
  
  // var validateForm = validateForm(form_name);
  formdata = new FormData(this);
  formdata.append('form', form_name);
  
  $.ajax({
    method: "POST",
    url: base_url + "module/request.php",
    data: formdata,
    processData: false,
    contentType: false,
    success: function (res) {
      var result = JSON.parse(res);
      $('.result').html(result.result);
      reload_cart_count();
      if (form_name == 'remove_from_cart' || form_name == 'update_cart' || form_name == 'checkout_cart') {
        $( "#content" ).load( base_url+'module/page.php?page=cart' );
      }
      if (form_name == 'update_transaction') {
        $( "#content" ).load( base_url+'module/page.php?page=customer_orders' );
      }
      if (result.items != '') {
        errorFields(result.items);
      }
    }
  });
});

function reload_cart_count() {
  formdata = new FormData();
  formdata.append('form', 'update_cart_count');
  
  $.ajax({
    method: "POST",
    url: base_url + "module/request.php",
    data: formdata,
    processData: false,
    contentType: false,
    success: function (res) {
      var result = JSON.parse(res);
      $('[name="cart"][data-link="menu"]').html('<i class="fa fa-shopping-cart"></i> My Cart('+result.result+')');
    }
  });
}





