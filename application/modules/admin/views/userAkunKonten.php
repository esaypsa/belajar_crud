<div class="card">
	<div class="card-header">
		<div class="card-title">
			<p>Table Akun User</p>
			
		</div>
		
	</div>
	<div class="card-body">
		<div class="my-1">
			<?= isset($headTable) ? $headTable : '' ;?>
		</div>
		
		<table class="table table-striped" data-source="table_user_akun" id="table_user_akun">
			<thead>
				<tr>
					<td >No.</td>
					<td >Nama</td>
					<td >Username</td>
					<td >Level</td>
					<td >Aksi</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	
</div>


<!-- Modal -->
<div class="modal  fade" id="modal_user_akun">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title" name="modal-title">Form Data Akun Pengguna</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
            
                <form action="#" method="post" id="form_user_akun" name="form_data_akun" accept-charset="utf-8">
                	<input type="hidden" name="id" id="id" value="">
               


                <div class="form-line">
                  	<label for="tnkb">Nama </label>
                  	<input class="form-control" id="nama" name="nama">
                  	<span class="help-block"></span>
		         </div>
                 <div class="form-line">
                  	<label for="username">Username </label>
                  	<input class="form-control" id="username" name="username">
                  	<span class="help-block"></span>
                 </div>
                 <div class="form-line">
                  	<label for="password">Password </label>
                  	<input class="form-control" id="password" name="password">
                  	<span class="help-block"></span>
		          </div>

                  <div class="row">
                  	 <div class="col-md-6">
                  	 	<div class="form-line">
		                  	<label for="level">Level</label>
		                  	<select name="level_user_id" class="form-control" id="level_user_id">
		                  		<option value="">--PILIH--</option>
		                  		<option value="1">1</option>
		                  		<option value="2">2</option>
		                  		
		                  	</select>
		                  
		                  	<span class="help-block"></span>
		                  </div>
                  	 </div>
                  	 
                  </div>

            </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary SaveBtn" data-label="user_akun" id="btnSave">Save changes</button>
            </div>
        </div>
    </div>
</div>