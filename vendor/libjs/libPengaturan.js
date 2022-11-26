var table  = $(".table");
var save_method;
var urlSave  = ''; 

var currentClass = site_url+class_url+'/';

$.fn.exists = function(callback) {
        if (this.length) {
          var args = [].slice.call(arguments, 1);
          callback.call(this, args);
        }
        return this;
      };
  


$(document).ready(function() {

    loadDataTable(table);
    
    $("#check-all").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });
    /* $('.parentStruktur').exists(function(){
         loadParentStruktur('add') ;   
    })*/

    
});




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
            "ordering": false, 

          
            "ajax": {
                "url": currentClass+ds,
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
    $("#"+formID+' [name="id"]').val('')
    
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
    console.log('reload '+ dataLabel);
    $('#table_'+dataLabel).DataTable().ajax.reload(null,false);
    
});

$('.SaveBtn').click(function()
{
   
    $(".help-block").html('');
    var dataLabel = $(this).data('label');
    var formID = 'form_'+dataLabel;
    var dataID = $('#'+formID+' input[name=id]').val();
    console.log(dataID);
    var formData = new FormData($('#form_'+dataLabel)[0]);
    save_method = dataID > 0 ? 'update' : 'add';
 
  
      
   if(save_method  ){
        console.log('savemethod = '+save_method);
        console.log('urlSave = '+urlSave);
        //$('#btnSave').text('saving...'); //change button text
        //$('#btnSave').attr('disabled',true); //set button disable 
        
          // ajax adding data to database
        $.ajax({
                url: currentClass+save_method+"_"+dataLabel,
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
                       //console.log(resp);
                        for(var prop in resp.msg) {
                                  $("#"+formID+ " [name= "+prop+"] " ).next('span').html(resp.msg[prop]);
                            
                                }
                        Swal('Proses Gagal', 'Terdapat kesalahan pada form', 'error');
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
        swal("Error", "Terdapat kesalahan pada form", "error");
    }  

  
    
});


$(".BulkDeleteBtn").click(function() 
{
    var dataLabel = $(this).data('label');
    dturl = currentClass+"delete_"+dataLabel;
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



$(".ImportexcelBtn").click(function(e) {
    e.preventDefault();
    var dataLabel = $(this).data('label');
    var importUrl = site_url+class_url+'/import_excel/'+dataLabel;
    $('#form_import_'+dataLabel)[0].reset(); // reset form on modals
    $('#form_import_'+dataLabel)[0].style.display = 'block';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); 
    $("#upload_result").empty();
    $('#berkas').attr('disabled', false);

             $('#btncancel').text('Cancel');
             $('#berkas').removeClass('d-none');
             $('#btnUpload').removeClass('d-none');
             $("#processing").addClass('d-none').empty();
     
     $('#btnUpload').text('Unggah'); //change button text
     $('#btnUpload').attr('disabled',false); //set button disable


    $("#modal_import_"+dataLabel).modal('show');

});

 $('#btnUpload').click(function(e) {
        e.preventDefault();
        var dataLabel = $(this).data('label');
        var importUrl = site_url+class_url+'/import_excel/'+dataLabel;
        $(this).text('Meng-Unggah...'); //change button text
        $(this).attr('disabled',true); //set button disable
        var formData = new FormData($('#form_import_'+dataLabel)[0]);
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
                                $('#form_import_'+dataLabel)[0].reset();
                                $('#form_import_'+dataLabel)[0].style.display = 'none';
                                //$('#berkasId').val(resp.fileName);
                                $("#upload_result").empty();   
                                $("#upload_result").html('<div class="alert alert-success"> <span> File ID :  '+resp.fileName+ ' berhasil diupload  </span> <span style="float:right;" > <button class="btn btn-sm btn-primary" data-file="'+resp.fileName+'" id="btnproses" onclick="proses()"> Proses Data </button> </span> </div>');
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
                formData = null;
            });
        });

function proses(e){
    
var fileName = $("#btnproses").data('file');
var dataLabel = $('.ImportexcelBtn').data('label');
var dturl = site_url +class_url+'/proses_file_data/'+dataLabel+'/'+fileName;
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
            reloadTable($("#table_"+dataLabel));
        }               
    }, false);

    w.onerror = function(e) {
       console.log("The server connection has been closed due to some errors");
       var r=document.getElementById("processing");
            r.innerHTML += 'The server connection has been closed due to some errors <br>';
     w.close();
    }
    
}

$('.ImportimgBtn').click(function(event) {
    /* Act on the event */
    console.log('do import image');
    $('#fileupload')[0].reset();
    $("#fileupload").find(".files").empty();
    $('#modalImportFoto_data_biodata').modal('show');
});

$('.ExportimgBtn').click(function(event) {
    /* Act on the event */
    console.log('do export image');
});


$('#modalImportFoto_data_biodata').on('shown.bs.modal',function(){
    console.log('modal open');
    $('#fileupload').fileupload({
            dataType: 'json',
            url: site_url+class_url+'/import_image',
            filesContainer: $('#uploadFiles'),
            disableImageResize: /Android(?!.*Chrome)|Opera/.test(
                window.navigator.userAgent
              ),
            maxFileSize: 1000000,
            acceptFileTypes: /(\.|\/)(jpg)$/i,
            uploadTemplateId: null,
            downloadTemplateId: null,
            uploadTemplate: function (o) {
                var rows = $();
                $.each(o.files, function (index, file) {
                    var row = $('<tr class="template-upload fade show">' +
                        '<td><span class="preview"></span></td>' +
                        '<td><p class="name"></p>' +
                        '<div class="error"></div>' +
                        '</td>' +
                        '<td><p class="size"></p>' +
                        '<div class="progress"><div class="progress-bar"></div></div>' +
                        '</td>' +
                        '<td>' +
                        (!index && !o.options.autoUpload ?
                            '<button class="start btn btn-sm btn-success" disabled>Start</button>' : '') +
                        (!index ? '<button class="cancel btn btn-sm btn-danger">Cancel</button>' : '') +
                        '</td>' +
                        '</tr>');
                    row.find('.name').text(file.name);
                    row.find('.size').text(o.formatFileSize(file.size));
                    if (file.error) {
                        row.find('.error').text(file.error);
                    }
                    rows = rows.add(row);
                });
                return rows;
            },
            downloadTemplate: function (o) {
                var rows = $();
                $.each(o.files, function (index, file) {
                    var row = $('<tr class="template-download fade show">' +
                        '<td><span class="preview"></span></td>' +
                        '<td><p class="name"></p>' +
                        (file.error ? '<div class="error"></div>' : '') +
                        '</td>' +
                        '<td><span class="size"></span></td>' +
                        '<td><button class="delete">Delete</button></td>' +
                        '</tr>');
                    row.find('.size').text(o.formatFileSize(file.size));
                    if (file.error) {
                        row.find('.name').text(file.name);
                        row.find('.error').text(file.error);
                    } else {
                        row.find('.name').append($('<a></a>').text(file.name));
                        if (file.thumbnailUrl) {
                            row.find('.preview').append(
                                $('<a></a>').append(
                                    $('<img>').prop('src', file.thumbnailUrl)
                                )
                            );
                        }
                        row.find('a')
                            .attr('data-gallery', '')
                            .prop('href', file.url);
                        row.find('button.delete')
                            .attr('data-type', file.delete_type)
                            .attr('data-url', file.delete_url);
                    }
                    rows = rows.add(row);
                });
                return rows;
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    //$('<p/>').text(file.error).appendTo(document.body);
                    if(file.status == false){
                        data.context.find('.error').html('<small><span class="badge badge-danger">Error </span> '+file.error+'</small>');    
                    }
                    
                });

            },
            progress: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                data.context.find('.progress-bar').css('width', progress+'%').text(progress+'%');
                /*$('.progress-bar').css(
                    'width',
                    progress + '%'
                );*/
            },
            processfail: function(e, data){
                $.each(data.result.files, function (index, file) {
                    data.context.find('.error').html('<small><span class="badge badge-danger">Error</span>'+file.error+'</small>');
                })

            
            }

        

    })

})