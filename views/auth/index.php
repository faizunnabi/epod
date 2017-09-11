<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users List
        <small>Control panel</small>
      </h1>
      
          <?php echo $this->breadcrumbs->show();?>
      
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box">
            
            <div class="box-body">

<div id="infoMessage"><?php echo $message;?></div>

<table class="table table-bordered table-striped dtable">
    <thead>
	<tr>
		<th>User Id</th>
		<th>Thumbnail</th>
		<th><?php echo lang('index_fname_th');?></th>
		<th><?php echo lang('index_lname_th');?></th>
		<th><?php echo lang('index_email_th');?></th>
		<th><?php echo lang('index_groups_th');?></th>
		<th><?php echo lang('index_status_th');?></th>
		<th><?php echo lang('index_action_th');?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo $user->id;?></td>
            <td><?php echo '<img class="img-responsive img-thumbnail" src="'.base_url()."assets/img/profile/".$user->profile_pic.'" alt="User profile picture" width="45">';?></td>
            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
			<td><?php echo '<a href="'.site_url("auth/single_user/$user->id").'"><i class="fa fa-search"></i></a> '.anchor("auth/edit_user/".$user->id, '<i class="fa fa-edit"></i>') ;?></td>
		</tr>
	<?php endforeach;?>
        </tbody>
</table>

</div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <a href="user_view.php"></a>
  </div>
<script type="text/javascript">
    
</script>
<?php include APPPATH . 'views/footer.php'; ?>