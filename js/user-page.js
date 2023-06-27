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

  let submit_btn = $(e.originalEvent.submitter);
  let refresh = $(this).attr('refresh');
  request(submit_btn, form_name, formdata, refresh);
  
  // $.ajax({
  //   method: "POST",
  //   url: base_url + "module/request.php",
  //   data: formdata,
  //   processData: false,
  //   contentType: false,
  //   success: function (res) {
  //     var result = JSON.parse(res);
  //     $('.result').html(result.result);
  //     if (result.status == true && result.reset == true) {
  //       $(form_raw).trigger('reset');
  //     }
  //     if (result.status == true) {

  //     }
  //     if (result.items != '') {
  //       errorFields(result.items);
  //     }
  //   }
  // });
});


function request(submit_btn,form_name,formdata, refresh ='') {
  $.ajax({
    method: "POST",
    url: base_url + "module/request.php",
    data: formdata,
    processData: false,
    contentType: false,
    success: function (res) {
      var result = JSON.parse(res);
      $('.result').html(result.result);
      if (result.status == true) {
        // $(form_raw).trigger('reset');
      }
      if (result.status == true) {
        if (refresh != '') {
          $("#content").load(base_url + 'module/page.php?page=' + refresh, function () {
            if (result.status == true) {            
              $('.result').html(result.result);          
            }
          });    
        }
      }
      
      if (result.items != '') {
        errorFields(result.items);
      }
      submit_btn.removeAttr('disabled');
      
      let icon = submit_btn.children('i');
      let current_icon = icon.attr('class'); // current icon
      icon.removeClass();
      icon.addClass(current_icon);
            if (result.refresh == true) {
              location.reload();
      }
    }
  });
}



