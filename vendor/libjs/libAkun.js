var table  = $(".table");
var url1 = 'userakun';
url2 = 'profil';
$(document).ready(function() {
	loadDataTable(table);

})

function reloadTable(el){
  return el.DataTable().ajax.reload(null,false);
}

function initTable(el){
  el.DataTable({ 
          "retrieve": true,
          "processing": true, 
          "order": [], 
          "columnDefs": []

      });
}

function loadDataTable(el){
//el=> element , ds=>datasource
  //el.destroy();
  console.log('datatable called');
  var ds = el.data("source");
  el.DataTable().destroy();
  el.DataTable({ 
    
          "retrieve": true,
          "processing": true, 
          "serverSide": true,
          "order": [], 

        
          "ajax": {
              "url": siteUrl+'admin/Akun_user/'+ds,
              "type": "POST",
              "data": 
              function ( data ) {
                  
                }
          },

          "columnDefs": [
              { 
                  "targets": [ 0 ], 
                  "orderable": false, 
              },
              
              { 
                  "targets": [ -1 ], 
                  "orderable": false, 
              }

          ],
             "fnDrawCallback": function() {
            action_btn(); }

      });
}


function action_btn(){

}


$('#add_btn').on('click', function(event) {
  event.preventDefault();
  var datalabel = $(this).data('label');
  var form = $('#form_'+datalabel);

  form[0].reset();

  $('#modal_'+datalabel).modal('show');

});

$('.SaveBtn').on('click', function(event) {
  //console.log('savebtn diklik'); 
  var datalabel = $(this).data('label');
  let url = siteUrl+'admin/Akun_user/add_'+datalabel;
  var formdata = new FormData( $('#form_'+datalabel)[0] );

  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'json',
    data: formdata,
    processData: false,
    contentType: false
  })
  .done(function(resp) {
    if(resp.status){
      //console.log('resp = '+resp);
      swal('Berhasil',resp.msg.success,'success');
    }else{
      swal('Gagal',resp.msg.error,'error');
    }
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  




});