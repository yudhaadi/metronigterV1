<div class="kt-portlet kt-portlet--height-fluid">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Edit Grup
			</h3>
		</div>
	</div>
	<div class="kt-portlet__body">
		<form id="form" method="post" action="<?php echo base_url('administrator/system/groups_save') ?>">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<label>Nama Grup</label>
					<input required="" value="<?php echo $groups->group_label ?>" type="text" autocomplete="off" class="form-control" name="group_label">
					<input required="" value="<?php echo $groups->group_id ?>" type="hidden" autocomplete="off" class="form-control" name="group_id">
				</div>
			</div>
			<hr>
			<?php foreach ($sidebars as $key => $var): ?>
				<?php $groups_access = $this->db->where('sidebar_access_group_id', $groups->group_id)->where('sidebar_access_sidebar_id', $var['sidebar_id'])->get('_sys_sidebar_access')->row() ?>
				<div class="row mt-3">
					<div class="col-sm-4 col-md-4 col-lg-4">
						<label><?php echo $var['sidebar_label'] ?></label>
						<input type="hidden" autocomplete="off" class="form-control" value="<?php echo $var['sidebar_id'] ?>" name="sidebar_access_sidebar_id[]">
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2">
						<label>Lihat</label>
						<input <?php echo (@$groups_access->sidebar_access_read == "1") ? 'checked' : '' ?> type="checkbox" autocomplete="off" class="form-control" style="width: 22px" value="1" name="sidebar_access_read[<?php echo $var['sidebar_id'] ?>]">
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2">
						<label>Buat</label>
						<input <?php echo (@$groups_access->sidebar_access_create == "1") ? 'checked' : '' ?> type="checkbox" autocomplete="off" class="form-control" style="width: 22px" value="1" name="sidebar_access_create[<?php echo $var['sidebar_id'] ?>]">
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2">
						<label>Perbarui</label>
						<input <?php echo (@$groups_access->sidebar_access_update == "1") ? 'checked' : '' ?> type="checkbox" autocomplete="off" class="form-control" style="width: 22px" value="1" name="sidebar_access_update[<?php echo $var['sidebar_id'] ?>]">
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2">
						<label>Hapus</label>
						<input <?php echo (@$groups_access->sidebar_access_delete == "1") ? 'checked' : '' ?> type="checkbox" autocomplete="off" class="form-control" style="width: 22px" value="1" name="sidebar_access_delete[<?php echo $var['sidebar_id'] ?>]">
					</div>
				</div>
			<?php endforeach ?>
			<hr>
			<div class="row mt-3">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="reset" class="btn btn-google">Reset</button>
				</div>
			</div>
			<div class="clearfix"></div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": false,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		};
	});
</script>

<script type="text/javascript">
	var form = $('#form');

	form.submit(function(event) {
		$.post(form.attr('action'), form.serialize(), function(response, textStatus, xhr) {
			console.log(response.msg);
			if (response.status == true) {
				toastr.success(response.msg);
				setTimeout(function() {
					window.location.href = "<?php echo base_url('administrator/system/groups') ?>";
				}, 2000);
			} else {
				toastr.error(response.msg);
			}
		}, "json");
		return false;
	});
</script>