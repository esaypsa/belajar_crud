var table  = $(".table");
var save_method;
var urlSave  = '';
var fotoUser = $('#user_foto'); 
var tbJabatan = $('#table_jabatan');

var currentClass = site_url+class_url+'/';

$.fn.exists = function(callback) {
        if (this.length) {
          var args = [].slice.call(arguments, 1);
          callback.call(this, args);
        }
        return this;
      };

$(document).ready(function() {

  setFotoUser('upload_img/user_img/no_foto.jpg');
  loadJabatanSdm();
    $("#check-all").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });
});

function setFotoUser(imgData){
  fotoUser.attr('src', site_url+ imgData);
  return false;
}

$('#select_sdm').select2({
  minimumInputLength: 3,
  width: 'resolve',
  allowClear: true,
  placeholder: 'Cari NIK/Nama',
  ajax: {
     dataType   : 'json',
     url        : site_url+class_url+'/select_sdm',
     type       :'post',
     delay      : 800,
     data       : function(params) {
                 return {
                   search: params.term
                 }
     },
     processResults: function (data, page) {
       return {
         results: data
       };
   },
 }
}).on('select2:select', function (evt) {
        initTable(tbJabatan);
        var id = $(".select2 option:selected").val();
        LoadDataUser(id);

});

function LoadDataUser(id){
  $.ajax({
        url : site_url+class_url+ "/getdatauser/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(resp)
        {
          if (resp.status) {
            $('#idSdm').val(resp.data['id']);
            $('#nama_sdm').text(resp.data['nama']);
            $("#NamaSdm").val(resp.data['nama']);
            $("#NikSdm").val(resp.data['nik']);
                $("#badge_golongan").text(resp.data['kgolongan']);
                $("#badge_status").text(resp.data['kstatus']);
            resp.data['foto'] ? setFotoUser('upload_img/user_img/'+resp.data['foto']) : '';
             //TableDestroy(tbPendidikan);
            loadDataTable(tbJabatan);
          }
          else {
              console.log(resp.status);
              swal('Error','Data tidak ditemukan','error');
              
          }
    
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

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
              "url": site_url+class_url+'/'+ds,
              "type": "POST",
              "data": 
              function ( data ) {
                  data.nik = $('#NikSdm').val();
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

function loadJabatanSdm(){
  $('#id_jabatan').load(site_url+class_url+'/select_jabatan')
}

$('.AddBtn').click(function(){
    $('.parentStruktur').exists(function(){
         loadParentStruktur('add')    
    })
    var dataLabel = $(this).data('label');
    formID = 'form_'+dataLabel;
    console.log(dataLabel);
    urlSave = site_url+class_url+'/add_'+dataLabel;
    save_method = 'add';
   
    $('#'+formID)[0].reset();
    $('#'+formID+' input[name=nik]').val($('#NikSdm').val());
    $('#'+formID+' input[name=namasdm]').val($('#NamaSdm').val());
    
    //$(this).attr('disabled',false);
       
    $('.form-group').removeClass('has-error has-success'); 
    $('.help-block').empty();
   
    
    $('#modal_'+dataLabel).modal('show') ; 
    $('.modal-title').text('Tambah Data'); // Set title to Bootstrap modal title  
    
     
    //$('.modal-title').text('Tambah data'); 
});


function action_btn(){
    $('.EditBtn').click(function() {
    save_method = 'update';
   

    console.log('edit cliked');
    console.log(save_method);
    var dataLabel = $(this).data('label');
    var dataValue = $(this).data('value');
    
    $('.parentStruktur').exists(function(){
         loadParentStruktur('edit',dataValue)    
    })

    formID = 'form_'+dataLabel;
    
    $('#btnSave').text('Simpan'); 
    $('#btnSave').attr('disabled',false); 
    
    
    $('#'+formID)[0].reset();
    $('#'+formID+' input[name=nik]').val($('#NikSdm').val());
    $('#'+formID+' input[name=namasdm]').val($('#NamaSdm').val());
    
   
    
    $('.form-group').removeClass('has-error has-success'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url : site_url+ class_url +"/edit_"+dataLabel+"/"+dataValue,
        type: "GET",
        dataType: "JSON",
        success: function(resp)
        {
            if (resp.status) {
                for(var prop in resp.data) {
                    $("#"+formID+' [name='+prop+']').val(resp.data[prop]);        
                    }
            $('#modal_'+dataLabel).modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title  

            }
            else {
                    console.log(resp.status);
                    swal('Error','Data tidak ditemukan','error');
                    $('#btnSave').text('Simpan'); 
                    $('#btnSave').attr('disabled',false); 
            }
    
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
     });
    });


$(".DeleteBtn").click(function() {
    var dataLabel = $(this).data('label');
    var dataValue = $(this).data('value');
    dturl = currentClass+"delete_"+dataLabel;
    console.log(dturl);
    swal({
       title: 'Hapus Data',
       text: "Apakah anda yakin ingin menghapus data ini?, Data yang telah dihapus tidak dapat dikembalikan lagi",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya',
       cancelButtonText: 'Batal',
       showLoaderOnConfirm: true,
       preConfirm: function() {
          return new Promise(function(resolve) {
      $.ajax({
         url: dturl,
         data: {id:dataValue},
         type: 'POST',
         dataType: 'json'
      })
      .done(function(response){
        if (response.status) {
              swal('Berhasil', response.msg, "success");
              reloadTable($('#table_'+dataLabel)); 
        }
        else {
          swal('Gagal', response.msg, "error");
        }
           
        })
      .fail(function(){
         swal('Uppss...', 'Terjadi kesalahan pada proses', 'error');
      });
          });
       },
       allowOutsideClick: false     
       }); 
    });
}


$('.ReloadBtn').click(function() {
  /* Act on the event */
    var dataLabel = $(this).data('label');
    //var dataValue = $(this).data('value');

  if($('#NikSdm').val()){
    
    $('#table_'+dataLabel).DataTable().ajax.reload(null,false);
  }
  else{
    $('#table_'+dataLabel).DataTable();
  }
});

$('.SaveBtn').click(function()
{
    var dataLabel = $(this).data('label');
  var nik = $('#'+formID+' input[name=nik]').val();
    if(save_method && nik ){
      
      console.log('urlSave = '+urlSave);
      //$('#btnSave').text('saving...'); //change button text
      //$('#btnSave').attr('disabled',true); //set button disable 
      var formData = new FormData($('#'+formID)[0]);
        // ajax adding data to database
      $.ajax({
              url: site_url+class_url+'/'+save_method+'_'+dataLabel,
              type: 'POST',
              data: formData,
              contentType: false,
            processData: false,
            dataType: "JSON",
              success: function(resp) {
                  if (resp.status == true) {
                      
                      $('#btnSave').text('Simpan');
                      $('#modal_'+dataLabel).modal('hide');
                      Swal('Berhasil', resp.msg, 'success');
                      reloadTable($('#table_'+dataLabel));
                        $('#'+formID)[0].reset();
                  }
                  else {
                     
                      for(var prop in resp.msg) {
            $("#"+prop+"").next('span').html(resp.msg[prop]);     
            }

                      $('#btnSave').text('Simpan'); 
              $('#btnSave').attr('disabled',false); 
                  }
              },
            error: function (jqXHR, textStatus, errorThrown)
              {
                  swal("Error", "Terjadi kesalahan pada proses", "error");
                   $('#btnSave').text('Simpan'); 
              $('#btnSave').attr('disabled',false); 
              }

          });

    }

    else {
      swal("Error", "URL target belum diset", "error");
    }  

  
    
});


$(".BulkDeleteBtn").click(function() 
{
    var dataLabel = $(this).data('label');
    dturl = site_url +class_url+"/bulkdelete_"+dataLabel
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: dturl,
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                       reloadTable($('#table_'+dataLabel));
                    }
                    else
                    {
                        alert('Failed.');
                    }
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   
                    alert('Error deleting data');
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
})

$(".ExportexcelBtn").click(function() {
    /* Act on the event */
     var dataLabel = $(this).data('label');
     var nik = $('#NikSdm').val();
     console.log('nik = '+nik);
     if (nik){
        location.href = site_url+class_url+'/export_excel/'+dataLabel+'/'+nik;   
     }
     else{
         swal("Error", "SDM belum dipilih", "error");
     }
});

$(".ImportexcelBtn").click(function() {

     var dataLabel = $(this).data('label');
     var nik = $('#NikSdm').val();
     var importUrl = site_url+class_url+'/import_excel/'+dataLabel+'/'+nik;
     var formId = $('#formImportData')[0];
     if (!nik){ swal("Error",'nik belum dipilih', "error"); return false;} 
     
      
    formId.reset(); // reset form on modals
    formId.style.display = 'block';
    $('.form-group').removeClass('has-error'); // clear error class
    $("#upload_result").empty();
    $('#berkas').attr('disabled', false);

     $('#btncancel').text('Cancel');
     $('#berkas').removeClass('d-none');
     $('#btnUpload').removeClass('d-none');
     $("#processing").addClass('d-none').empty();
     
     $('#btnUpload').text('Unggah'); //change button text
     $('#btnUpload').attr('disabled',false); //set button disable
     $("#modalImportData").modal('show');

    $('#btnUpload').click(function(e) {
        e.preventDefault();
        $(this).text('Meng-Unggah...'); //change button text
        $(this).attr('disabled',true); //set button disable
        var formData = new FormData(formId);
            $.ajax({
                url: importUrl,
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData:false,
                contentType:false,
                cache:false,
                async:true,
            })
            .done(function(resp) {
                console.log("success");
                if (resp.status == true) {
                                
                                //$('#btnUpload').text('Unggah');
                                //$('#modal_'+dataLabel).modal('hide');
                                Swal('Berhasil', resp.msg, 'success');
                                //reloadTable(table);
                                $('#berkas').addClass('d-none');
                                $('#btnUpload').addClass('d-none');
                                formId.reset();
                                formId.style.display = 'none';
                                //$('#berkasId').val(resp.fileName);
                                $("#upload_result").empty();   
                                $("#upload_result").html('<div class="alert alert-success"> <span> File ID :  '+resp.fileName+ ' berhasil diupload  </span> <span style="float:right;" > <button class="btn btn-sm btn-primary" data-file="'+resp.fileName+'" id="btnproses" onclick="proses()"> Proses Data </button> </span> </div>');
                                $("#upload_result").data('label',dataLabel);
                            }
                            else {
                               
                                for(var prop in resp.msg) {
                                $("#"+prop+"").next('span').html(resp.msg[prop]);       
                                }

                                $(this).text('Unggah'); //change button text
                                $(this).attr('disabled',false); //set button disable 
                            }
            })
            .fail(function() {
                console.log("error");
                Swal('Gagal', 'Ada sesuatu yang salah diantara kita', 'error');
                $(this).text('Unggah'); //change button text
                $(this).attr('disabled',false); //set button disable 
            })
            .always(function() {
                console.log("complete");
            });
        });
})




function proses(){
var fileName = $("#btnproses").data('file');
var dataLabel = $("#upload_result").data('label');
var tableid = $('#table_'+dataLabel);
var dturl = site_url +class_url+'/proses_file_data/'+dataLabel+'/'+fileName;
console.log(dturl);
//$("#btnproses").text('Processing').attr('disabled',true);
$("#processing").removeClass('d-none');
$("#btnCancel").text('Tutup');
//$.post( dturl, { v: "10"} );
var w = new EventSource(dturl);

   w.onopen = function(e) {
               console.log("The connection to your server has been opened");       
            }
    console.log('-- START --');
     
   w.addEventListener("message", function(e) {
       var r=document.getElementById("processing");
            r.innerHTML +=  e.data + '<br>';   
            r.scrollTop = r.scrollHeight;               
    }, false);

   w.addEventListener("ending", function(e) {
       var object= JSON.parse(e.data);
       if (e.data == '1'){
            w.close();
            $("#btnproses").attr('disabled', true);
           reloadTable(tableid);
        }               
    }, false);

    w.onerror = function(e) {
       console.log("The server connection has been closed due to some errors");
       var r=document.getElementById("processing");
            r.innerHTML += 'The server connection has been closed due to some errors <br>';
    }
    
}