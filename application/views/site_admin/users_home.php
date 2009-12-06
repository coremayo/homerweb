<?php 
	include 'table_constants.php';
	$data['breadcrumb'] = 'Users &raquo; Home';
	$this->load->view('site_admin/header', $data); 
?>
<script>
	var usersTable;

	$(document).ready(function() 
	{
		var button1 = $('#addNewUserFromFileButton');
		<?php echo 'var loc = \''.base_url().'uploader\';' ?>
		new AjaxUpload(button1,{
		action: loc,
		data: {type: 'excel'},
		onSubmit : function(){
			this.disable();
		},
		onComplete: function(file, response){
			this.enable();
			window.location = 'users';
		}
	});
		
		usersTable = $('#usersTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});

		
		$("#usersTable input[name='select_user_all']").change
		(
			function()
			{
				if ($("#usersTable input[name='select_user_all']").attr('checked'))
				{
					$('td input', usersTable.fnGetNodes()).attr({checked: 'checked'});
				}
				else
				{
					$('td input', usersTable.fnGetNodes()).attr({checked: ''});
				}
			}
		)
	});
</script>

<div id="content">
	<h2>All Users</h2>
	<hr>
	<br>
	
	<button type="button" class="addButton" id="addNewUserFromFileButton">Add Users From Excel File</button>
	<button type="button" class="addButton" id="addNewUserButton" onclick="window.location.href='<?php echo base_url();?>site_admin/users/add_user'">Add New User</button>
	
	<?php
		$data['ID'] = 'usersTable';
		$data['TABLE'] = array(SHOW_ALL_USERS, null);
		$data['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD | REGDATE_FIELD | ACTIVE_FIELD;
		$this->load->view('site_admin/table', $data);
	?>
</div>

<?php $this->load->view('site_admin/footer'); ?>