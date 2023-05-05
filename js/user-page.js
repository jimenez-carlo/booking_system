$(document).ready(function() {  
  $("div").on("click", "a.sidebar-btn", function () {
      var page = $(this).attr('name');
      $('a.sidebar-btn').removeClass('active');
        $(this).addClass('active');
        $(".result").html('');
    $("#content").load(base_url + 'module/page.php?page=' + page);
        localStorage.setItem('page', page);
      });
  
  
  if (window.location.search) {
    const path = new URLSearchParams(window.location.search);
    
    if (path.has('page')) {
      const bsOffcanvas = new bootstrap.Offcanvas('#offcanvasExample');
      bsOffcanvas.toggle();
      
      let page = path.get('page');
      $('a.sidebar-btn').removeClass('active');
      $('a.sidebar-btn[name='+localStorage.getItem('page')+']').addClass('active');
      page += (path.has('id')) ? "&id="+path.get('id') : "";
      
      $(".result").html('');
      $("#content").load(base_url + 'module/page.php?page=' + page);
    }
  }
  

});

$(document).on("click", '.a-view', function () {  
  var page = $(this).attr('name');
  var id = $(this).attr('value');
  window.open(base_url + "?page=" + page + "&id=" + id, '_blank');
});


$(document).on("click", '.btn-edit, .btn-view', function () {
  
  var page = $(this).attr('name');
  var id = $(this).attr('value');
  
  $(".result").html('');
  $("#content").load(base_url + 'module/page.php?page=' + page + '&id=' + id);
  
});

$(document).on("submit", 'form', function (e) {
  e.preventDefault();
  clearErrors();
  var form_raw = this;
  var form_name = this.name;
  var type = e.originalEvent.submitter.name;
  var type_value = e.originalEvent.submitter.value;
  if (this.name == 'logout') {
    window.location.href = base_url+'module/logout.php';
  }
  
  formdata = new FormData(this);
  console.log(form_name);
  formdata.append('form', form_name);
  formdata.append(type, type_value);

  $.ajax({
    method: "POST",
    url: base_url + "module/request.php",
    data: formdata,
    processData: false,
    contentType: false,
    success: function (res) {
      var result = JSON.parse(res);
      $('.result').html(result.result);
      if (result.status == true && result.reset == true) {
        $(form_raw).trigger('reset');
      }
      if (result.status == true) {
       if (form_name == 'update_user' && type_value == 'delete_user') {
         $( "#content" ).load( base_url+'module/page.php?page=users' );
       }
       if (form_name == 'update_user' && type_value == 'update' && formdata.get('access') == null) {
         $( "#content" ).load( base_url+'module/page.php?page=customer_edit&id=' +formdata.get('user_id'));
       }
       if (form_name == 'update_user' && type_value == 'update' && formdata.get('access')) {
         $( "#content" ).load( base_url+'module/page.php?page=user_edit&id=' +formdata.get('user_id'));
       }
       if (form_name == 'update_user' && type_value == 'delete_customer') {
         $( "#content" ).load( base_url+'module/page.php?page=customers' );
       }
       if (form_name == 'remove_from_cart' || form_name == 'update_cart' || form_name == 'checkout_cart') {
         $( "#content" ).load( base_url+'module/page.php?page=cart' );
        }
        
       if (form_name == 'update_transaction' && type_value == '5') {
         $( "#content" ).load( base_url+'module/page.php?page=customer_orders' );
        }
       if (form_name == 'update_transaction' && (type_value == '3' || type_value == '6')) {
         $( "#content" ).load( base_url+'module/page.php?page=transactions' );
        }
       if (form_name == 'update_transaction_view' && (type_value == '3' || type_value == '6')) {
         $( "#content" ).load( base_url+'module/page.php?page=transaction_view&id=' +formdata.get('id'));
        }
        
        if (form_name == 'update_order' && (type_value == '3' || type_value == '6')) {
         $( "#content" ).load( base_url+'module/page.php?page=orders' );
        }
       if (form_name == 'update_orders_view' && (type_value == '3' || type_value == '6')) {
         $( "#content" ).load( base_url+'module/page.php?page=orders_view&id=' +formdata.get('id'));
        }
       if (form_name == 'update_order_transaction' && (type_value == '3' || type_value == '6')) {
         $( "#content" ).load( base_url+'module/page.php?page=orders_view&id=' +formdata.get('invoice_id'));
        }
       if (form_name == 'pay_order') {
         $( "#content" ).load( base_url+'module/page.php?page=orders_view&id=' +formdata.get('pay'));
        }
        
       if (form_name == 'update_category' && type_value == 'delete') {
         $( "#content" ).load( base_url+'module/page.php?page=categories' );
        }
        if (form_name == 'update_category' && type_value == 'update') {
         $( "#content" ).load( base_url+'module/page.php?page=category_edit&id='+formdata.get('category_id') );
        }
        
       if (form_name == 'add_product') {
         $('#preview').attr('src','images/products/default.png');
       }
       if (form_name == 'update_product' && type_value == 'delete') {
         $( "#content" ).load( base_url+'module/page.php?page=products' );
       }
       if (form_name == 'update_product' && type_value == 're_stock_list') {
         $( "#content" ).load( base_url+'module/page.php?page=inventory' );
       }
       if (form_name == 'update_product' && type_value == 're_stock') {
         $( "#content" ).load( base_url+'module/page.php?page=inventory_edit&id='+formdata.get('product_id') );
        }
       if (form_name == 'update_product' && type_value == 'update') {
         $( "#content" ).load( base_url+'module/page.php?page=product_edit&id='+formdata.get('product_id') );
        }
      }
      if (result.items != '') {
        errorFields(result.items);
      }
    }
  });
});




