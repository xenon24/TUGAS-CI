<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Provinsi dan Kota</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<style type="text/css" media="screen">
		th, td{
			text-align: center;
		}
	</style>

</head>
<body>
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
		<h5 class="my-0 mr-md-auto font-weight-normal"><a href="<?php echo base_url("/"); ?>">Sistem Datatables</a></h5>
		<nav class="my-2 my-md-0 mr-md-3">
			<a class="p-2 text-dark" href="<?php echo base_url("province"); ?>">Provinsi</a>
			<a class="p-2 text-dark" href="<?php echo base_url("city"); ?>">Kota</a>
		</nav>
		<a class="btn btn-outline-primary" href="#">Sign out</a>
	</div>
	<div class="container">

		<!-- <?php echo "<h5> ".$this->session->flashdata('pesan')."</h5>"; ?> -->

		<button style="margin-bottom: 10px;" class="btn btn-primary" data-toggle="modal" data-target="#add-modal-city">
			Create
		</button>
		<table id="datatable" class="table table-hover table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Kota</th>
					<th>Kota</th>
					<th>Kode Provinsi</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 1;
				if ($data->num_rows() > 0) {
				foreach ($data->result() as $row)  {
				?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php echo $row->id ?></td>
					<td><?php echo $row->name ?></td>
					<td>
						<?php  
		                    $this->db->select('*');
		                    $this->db->from('province');
		                    $this->db->join('city', 'city.province_id = province.id');
		                    $this->db->where(array('city.province_id' => $row->province_id));
		                    
		                    $query = $this->db->get()->row();

		                    echo $query->name_province;

		                ?>
					</td>
					<td>
						<a href="" class="btn btn-warning" data-toggle="modal" data-target="#update-modal-city<?php echo $row->id; ?>">Edit</a>
						<a onclick="return confirm('Apakah anda yakin menghapus data ini?')" href="<?php  echo base_url("city/delete/{$row->id}") ?>" class="btn btn-danger">Hapus</a>
						<div id="update-modal-city<?php echo $row->id; ?>" class="modal fade"> 
							<div class="modal-dialog">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">Update Kota dan kode provinsi</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										<form action="<?php  echo base_url("city/edit/{$row->id}") ?>" method="post">
											<div class="form-group">
												<label class="col-sm-2 col-form-label">Nama</label>
												<div class="col-sm-10">
													<?php echo form_input(['name' => 'name',
																					'class' => 'form-control',
																					'placeholder' => 'Nama Kota',
																					'value' => set_value('name', $row->name)]); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 col-form-label">Kode Provinsi</label>
												<div class="col-sm-10">
													<select name="province_id" class="form-control">
									                    <?php
									                    foreach ($this->db->get('province')->result() as $r) {?>
									                      <option value="<?=$r->id?>" <?php if($r->id== $row->province_id){ echo "selected='selected'";}?>><?=$r->name_province?></option>
									                    <?php
									                    }
									                    ?>
									                </select>
												</div>
											</div>
											<div class="form-group">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-success">Simpan</button>
												<!-- <button type="button" class="btn btn-success" id="btn-update" >Update</button> -->
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<?php 
			}
		}
		?>
	</tbody>
</table>
</div>

<div id="add-modal-city" class="modal fade"> 
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Input Kota</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form action="<?php echo base_url('city/insert'); ?>" method="post">
					<div class="form-group">
						<label class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" placeholder="Nama Kota">
						</div>
					</div>
					<div class="col-md-12">
						<?php echo form_error('name', '<span class="text-danger">','</span>' ); ?>
					</div>
					<div class="form-group">
						<label class="col-sm-2 col-form-label">Kode</label>
						<div class="col-sm-10">
							<select name="province_id" class="form-control">
			                    <?php
			                    foreach ($this->db->get('province')->result() as $r) {?>
			                      <option value="<?=$r->id?>"><?=$r->name_province?></option>
			                    <?php
			                    }
			                    ?>
			                </select>
						</div>
					</div>
					<div class="col-md-12">
						<?php echo form_error('province_id', '<span class="text-danger">','</span>' ); ?>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success">Simpan</button>
						<!-- <button type="button" class="btn btn-success" id="btn-update" >Update</button> -->
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#datatable').dataTable();
	});
</script>
