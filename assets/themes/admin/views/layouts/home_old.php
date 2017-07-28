 <!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		 <title><?php echo $template['title']; ?></title>
         <?php echo $template['partials']['top']; ?>	
		 
		<!-- end: HEADER -->
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<div class="navbar-content">
				<!-- start: SIDEBAR -->
				 <?php echo $template['partials']['sidebar']; ?>
				<!-- end: SIDEBAR -->
			</div>
			<!-- start: PAGE -->
			<div class="main-content">
				<!-- start: PANEL CONFIGURATION MODAL FORM -->
				<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title">Panel Configuration</h4>
							</div>
							<div class="modal-body">
								Here will be a configuration form
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Close
								</button>
								<button type="button" class="btn btn-primary">
									Save changes
								</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
							<!-- start: STYLE SELECTOR BOX -->
							<div id="style_selector">
								<div id="style_selector_container" style="display:block">
									<div class="style-main-title">
										Contribution For
										<?php echo date('M Y',time());?>
									</div>
									
								<div class="col-sm-12">
									<div class="easy">
										<a href="<?php echo site_url('admin/offerings')?>">
										<div class="label-chart col-sm-7">
											Total Offerings <br><br>
											<span class="added">KES <?php echo number_format($total_offering->total)?></span>
										</div>
										<br>
										
										<div class="sparkline_bar_good col-sm-5 spkx">
										
											<span>
											<?php foreach($offerings as $p){
												echo $p->amount.',';
												
											}?>
											</span>
										</div>
										
										</a>
									</div>
								</div>
								<div class="clearfix"></div>
								
								<div class="col-sm-12">
									<div class="easy">
										<a href="<?php echo site_url('admin/tithes')?>">
										<div class="label-chart col-sm-7">
											Total Tithes <br><br>
											<span class="added">KES <?php echo number_format($total_tithes->total)?></span>
										</div>
										<br>
										
										<div class="sparkline_bar_good col-sm-5 spkx">
										
											<span><?php foreach($tithes as $p){
												echo $p->totals.',';
												
											}?></span>
										</div>
										</a>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-12">
									<div class="easy">
										<a href="<?php echo site_url('admin/thanks_giving')?>">
										<div class="label-chart col-sm-7">
											Total Thanks Giving <br><br>
											<span class="added">KES <?php echo number_format($total_thanks->total)?></span>
										</div>
<br>
										
										<div class="sparkline_bar_good col-sm-5 spkx">
										
											<span><?php foreach($thanks as $p){
												echo $p->totals.',';
												
											}?></span> 
										</div>
										</a>
									</div>
								</div>
							<div class="clearfix"></div>
							
							<div class="col-sm-12">
									<div class="easy">
										<a href="<?php echo site_url('admin/ministry_support')?>">
											<div class="label-chart col-sm-7">
												Total Ministry Support <br><br>
												<span class="added">KES <?php echo number_format($total_support->total)?></span>
											</div>
											<br>
											
											<div class="sparkline_bar_good col-sm-5 spkx">
											
												<span><?php foreach($support as $p){
												echo $p->totals.',';
												
											}?></span>
											</div>
										</a>
									</div>
								</div>
							<div class="clearfix"></div>
							
							<div class="col-sm-12">
									<div class="easy">
										<a href="<?php echo site_url('admin/seed_planting')?>">
										<div class="label-chart col-sm-7">
											Total Seed Planting <br><br>
											<span class="added">KES <?php echo number_format($total_seeds->total)?></span>
										</div>
										<br>
										
										<div class="sparkline_bar_good col-sm-5 spkx">
										
											<span><?php foreach($seeds as $p){
												echo $p->totals.',';
												
											}?></span>
										</div>
										</a>
									</div>
							</div>
							<div class="clearfix"></div>
							
							<div class="col-sm-12">
									<div class="easy">
										<a href="<?php echo site_url('admin/other_contributions')?>">
										<div class="label-chart col-sm-7">
											Other Contributions <br><br>
											<span class="added">KES <?php echo number_format($total_others->total)?></span>
										</div>
										<br>
										
										<div class="sparkline_bar_good col-sm-4 spkx">
										
											<span><?php foreach($others as $p){
												echo $p->totals.',';
												
											}?></span>
										</div>
										</a>
									</div>
								</div>
							<div class="clearfix"></div>
							  <hr>
								<div class="col-sm-12">
									<div class="easy">
										
										<div class="label-chart col-sm-7">
											Subtotal <br><br>
											<span class="added">
											KES
											<?php 
											$totals = ($total_offering->total+$total_tithes->total+$total_thanks->total+$total_support->total+$total_seeds->total+$total_others->total);
											echo number_format($totals,2);
											?>
											</span>
										</div>
										<span class="cpu number col-sm-5" data-percent="90"> <span class="icon-thumbs-up"></span>
										 <span class="clip-data"></span> </span>
										
									</div>
								</div>
									
									
								</div>
								<div class="style-toggle open"></div>
							</div>
							<!-- end: STYLE SELECTOR BOX -->
							<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								<li>
									<i class="clip-home-3"></i>
									<a href="#">
										Home
									</a>
								</li>
								<li class="active">
									Dashboard
								</li>
								<li class="search-box">
									<form class="sidebar-search">
										<div class="form-group">
											<input type="text" placeholder="Start Searching...">
											<button class="submit">
												<i class="clip-search-3"></i>
											</button>
										</div>
									</form>
								</li>
							</ol>
							<div class="page-header">
								<h1>Dashboard <small>overview &amp; stats </small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-sm-12">
							<div class="row space12">
								<ul class="mini-stats col-sm-12">
									<li class="col-sm-2 ">
									<a href="<?php echo base_url('admin/members');?>">
										<i class="icon-group circle-icon circle-green col-sm-5 "></i>
										<div class="values alert alert-success col-sm-7">
											<strong><?php echo number_format($members_count);?></strong>
											All Members
										</div>
									</a>	
									</li>
									<li class="col-sm-2">
									<a href="<?php echo base_url('admin/visitors');?>">
										<i class="clip-thumbs-up circle-icon circle-green col-sm-5"></i>
										<div class="values alert alert-success fade in col-sm-7">
											<strong><?php echo number_format($visitors_count);?></strong>
											All Visitors
										</div>
									</a>
									</li>
									<li class="col-sm-2">
									<a href="<?php echo base_url('admin/sunday_school');?>">
										<i class="clip-users circle-icon circle-green col-sm-5"></i>
										<div class="values alert alert-success col-sm-7">
											<strong><?php echo number_format($ss_count);?></strong>
											Sunday School
										</div>
									</a>
									</li>
									<li class="col-sm-2">
										<i class="icon-list-ul circle-icon circle-teal col-sm-5"></i>
										<div class="values alert alert-info col-sm-7">
											<strong><?php echo number_format($hbcs_count);?></strong>
											All HBCs
											
										</div>
									</a>
									</li>
									<li class="col-sm-2">
									<a href="<?php echo base_url('admin/ministries');?>">
										<i class="icon-list-ol circle-icon circle-teal col-sm-5"></i>
										<div class="values alert alert-info col-sm-7">
											<strong><?php echo number_format($ministries_count);?></strong>
											All Ministries
											
										</div>
									</a>
									</li>
									<li class="col-sm-2">
									<a href="<?php echo base_url('admin/users');?>">
										<i class="clip-users-2 circle-icon circle-black col-sm-5"></i>
										<div class="values alert alert-warning col-sm-7">
											<strong><?php echo number_format($users_count);?></strong>
											All Users
											
										</div>
									</a>
									</li>
									
								</ul>
							</div>
							<hr />
						</div>
						
					</div>
					<!----END LISTING----->
					
						<div class="row">
						<div class="col-md-6">
							<!-- start: CONDENSED TABLE PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="icon-external-link-sign"></i>
									Recent Collections
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="icon-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="icon-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="icon-remove"></i>
										</a>
										<a class="btn btn-xs btn-link" href="<?php echo site_url('admin/logs')?>">
											<i class="icon-list-ol"></i>
										</a>
										
									</div>
								</div>
								<div class="panel-body">
									<table class="table table-condensed table-hover" id="sample-table-3">
										<thead>
											<tr>
												<th class="center hidden-xs">
												<div class="checkbox-table">
													<label>
														<input type="checkbox" class="flat-grey">
													</label>
												</div></th>
												<th>Type</th>
												<th>Amount</th>
												<th class="hidden-xs"><i class="icon-calendar"></i> Date</th>
												<th> Recorded By </th>
												<th class="hidden-xs">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php $i=0; foreach($collection_log as $log){
											$u = $this->ion_auth->get_user($log->created_by);
											if($i==6) break;
											$i++;
											?>
											<tr>
												<td class="center hidden-xs">
												<div class="checkbox-table">
													<label>
														<input type="checkbox" class="flat-grey">
													</label>
												</div></td>
												<td>
												<a class="tooltips" data-placement="top" data-original-title="View All" href="<?php echo site_url('admin/'.$log->type); ?>">
													<?php
                                                    $tpy=$log->type	;												
													$cha =array ('_');
													$sp =array (' ');
													$tt =  str_replace($cha,$sp,$tpy);
													echo ucwords($tt);?>
												</a></td>
												<td><?php echo number_format($log->amount);?></td>
												<td class="hidden-xs">
												 <?php
														$tm = explode(' ',time_ago($log->created_on));				
														if(time_ago($log->created_on)=='Yesterday'){ echo '<span class="label label-inverse">'.time_ago($log->created_on).'</span>';}
														elseif($tm[1]=='days'){ echo '<span class="label label-orange">'.time_ago($log->created_on).'</span>';}
														else {echo '<span class="label label-info">'.time_ago($log->created_on).'</span>';}
														
														?>
												</td>
												<td><?php echo $u->first_name.' '.$u->last_name;?></td>
												<td class="hidden-xs">
													<a href="<?php echo site_url('admin/'.$log->type); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View All Collections"><i class="icon-share"></i></a>
													<a href="<?php ?>" class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Change Status"><i class="icon-cut"></i></a>
												
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</div>
							</div>
							<!-- end: CONDENSED TABLE PANEL -->
						</div>
						<div class="col-md-6">
							<!-- start: BORDERED TABLE PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="icon-external-link-sign"></i>
									Recent Registered Members
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="icon-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="icon-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="icon-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="icon-remove"></i>
										</a>
										<a class="btn btn-xs btn-link" href="<?php echo site_url('admin/members')?>">
											<i class="icon-list-ol"></i>
										</a>
									</div>
								</div>
									<div class="panel-body">
									<table class="table table-condensed table-hover" id="sample-table-3">
										<thead>
											<tr>
												<th class="center hidden-xs">
												
												#
												</th>
												<th>Photo</th>
												<th>Name</th>
												<th class="hidden-xs"><i class="icon-calendar"></i> Date</th>
												<th> Phone </th>
												<th class="hidden-xs">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php $i=0; foreach($members as $p){
											$u = $this->ion_auth->get_user($p->created_by);
											if($i==6) break;
											$i++;
											?>
											<tr>
												<td class="center hidden-xs">
												
													
														<?php echo $i;?>
													
												</td>
												<td>
												   <?php if(empty($p->passport)){?>
												   <div class="fileupload-new thumbnail" style="width: 28px; height: 28px;">
													<img src="<?php echo base_url('uploads/files/m1.png');?>" alt="">
													</div>
												   <?php }else{?>
												   
									<img alt="" src="<?php echo base_url('uploads/files/'.$p->passport);?>" style="" class="circle-img" height="28" width="28">
												   <?php }?>
													</td>
												<td><a class="tooltips" data-placement="top" data-original-title="View <?php echo $p->first_name?>'s Profile" href="<?php echo site_url('admin/members/profile/'.$p->id); ?>"><?php  echo $p->first_name.' '.$p->last_name;?></a></td>
												<td class="hidden-xs">
												 <?php
														$tm = explode(' ',time_ago($p->created_on));				
														if(time_ago($p->created_on)=='Yesterday'){ echo '<span class="label label-inverse">'.time_ago($p->created_on).'</span>';}
														elseif($tm[1]=='days'){ echo '<span class="label label-orange">'.time_ago($p->created_on).'</span>';}
														else {echo '<span class="label label-info">'.time_ago($p->created_on).'</span>';}
														
														?>
												</td>
												<td><?php echo $p->phone1;?></td>
												<td class="hidden-xs">
													<a href="<?php echo site_url('admin/members/profile/'.$p->id); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View <?php echo $p->first_name?>'s Profile"><i class="icon-share"></i></a>
													<a href="<?php echo site_url('admin/members/edit/'.$p->id); ?>" class="btn btn-xs btn-info tooltips" data-placement="top" data-original-title="Edit Details"><i class="icon-edit"></i></a>
												
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</div>
							
							</div>
							<!-- end: BORDERED TABLE PANEL -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
						  <div class="panel panel-default">
								<div class="panel-heading">
									<i class="icon-external-link-sign"></i>
									Pending Pledges
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="icon-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="icon-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="icon-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="icon-remove"></i>
										</a>
										<a class="btn btn-xs btn-link" href="<?php echo site_url('admin/pledges')?>">
											<i class="icon-list-ol"></i>
										</a>
									</div>
								</div>
									<div class="panel-body">
									<table class="table table-condensed table-hover" id="sample-table-3">
										<thead>
											<tr>
												<th class="center hidden-xs">
												
												#
												</th>
												<th>Pledge</th>
												<th>Member</th>
												<th> Amount </th>
												<th class="hidden-xs">Status</th>
												
												<th class="hidden-xs">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php $i=0; foreach($pledges as $p){
											if($i==5) break;
											$i++;
											?>
											<tr>
												<td class="center hidden-xs">
												
													
														<?php echo $i;?>
													
												</td>
												<td>
												  <?php echo $p->title;?>
													</td>
												<td><a class="tooltips" data-placement="top" data-original-title="View <?php echo $single_member[$p->member]?>'s Profile" href="<?php echo site_url('admin/members/profile/'.$p->member); ?>"><?php  echo $single_member[$p->member];?></a></td>
												<td class="hidden-xs">
												 <?php echo number_format($p->amount,2);?>
												</td>
												<td>
												  <?php 
													   echo '<span class="label label-warning"> Pending</span> ';														
														$now = time(); // or your date as well
														$p_date = date('Y-m-d',$p->expected_pay_date);
														$act_date = strtotime($p_date);
														$datediff =$act_date - $now;
														$days = floor($datediff/(60*60*24));
														if($days<0){echo ' <span class="label label-danger"> Overdue </span>';}
														elseif(0==$days){echo ' <span class="label label-info"> '.$days.' Days to go  </span>';}
														else{echo ' <span class="label label-info">'.$days.' Day(s) to go </span>';}
														
														
														?>
												
												</td>
												<td class="hidden-xs">
													<a href="<?php echo site_url('admin/pledges/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View All Pledges"><i class="icon-share"></i></a>
													
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</div>
							
							</div>
							
						</div>
						
						<div class="col-md-6">
						<div class="panel panel-default">
								<div class="panel-heading">
									<i class="icon-external-link-sign"></i>
									Recent Expenses
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="icon-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="icon-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="icon-remove"></i>
										</a>
										<a class="btn btn-xs btn-link" href="<?php echo site_url('admin/expenses')?>">
											<i class="icon-list-ol"></i>
										</a>
									</div>
								</div>
									<div class="panel-body">
									<table class="table table-condensed table-hover" id="sample-table-3">
										<thead>
											<tr>
												<th class="center hidden-xs">
												#
													</th>
												<th>Title</th>
												<th>Amount</th>
												<th class="hidden-xs"><i class="icon-calendar"></i> Date</th>
												<th> Recorded By </th>
												<th class="hidden-xs">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php $i=0; foreach($expenses as $p){
											$u = $this->ion_auth->get_user($p->person_responsible);
											if($i==5) break;
											$i++;
											?>
											<tr>
												<td class="center hidden-xs">
												
														<?php echo $i;?>
													</td>
												<td>
												<a class="tooltips" data-placement="top" data-original-title="View All" href="<?php echo site_url('admin/expenses'); ?>">
													<?php echo $expenses_items[ucwords($p->item)];?>
												</a></td>
												<td><?php echo number_format($p->amount);?></td>
												<td class="hidden-xs">
												 <?php
														$tm = explode(' ',time_ago($p->created_on));				
														if(time_ago($p->created_on)=='Yesterday'){ echo '<span class="label label-inverse">'.time_ago($p->created_on).'</span>';}
														elseif($tm[1]=='days'){ echo '<span class="label label-orange">'.time_ago($p->created_on).'</span>';}
														else {echo '<span class="label label-info">'.time_ago($p->created_on).'</span>';}
														
														?>
												</td>
												<td><?php echo $u->first_name.' '.$u->last_name;?></td>
												<td class="hidden-xs">
													<a href="<?php echo site_url('admin/expenses'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View All Expenses"><i class="icon-share"></i></a>
													<a href="<?php echo site_url('admin/expenses/create'); ?>" class="btn btn-xs btn-primary tooltips" data-placement="top" data-original-title="Add Expense"><i class="icon-plus"></i></a>
													<a href="<?php ?>" class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Void This"><i class="icon-cut"></i></a>
												
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									</div>
							</div>
							
						</div>
					</div>
					<!----END TABLES---------------->
					
					<div class="row">
						<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="clip-stats"></i>
									Contribution Flow For The Year <?php echo date('Y')?>
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="icon-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="icon-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="icon-remove"></i>
										</a>
									</div>
								</div>
								<div class="panel-body">
									<div class="flot-medium-container">
										<div id="placeholder-h1" class="flot-placeholder"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
						   <div class="panel-heading">
											<i class="clip-pie"></i>
											Acquisition
											<div class="panel-tools">
												<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
												</a>
												<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
													<i class="icon-wrench"></i>
												</a>
												<a class="btn btn-xs btn-link panel-refresh" href="#">
													<i class="icon-refresh"></i>
												</a>
												<a class="btn btn-xs btn-link panel-close" href="#">
													<i class="icon-remove"></i>
												</a>
											</div>
										</div>
										<div class="panel-body">
											<div class="flot-mini-container">
												<div id="placeholder-h2" class="flot-placeholder"></div>
											</div>
										</div>
									</div>
						</div>
					</div>
					<div class="row">
					<div class="col-sm-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="clip-calendar"></i>
									Calendar
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="icon-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="icon-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="icon-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="icon-remove"></i>
										</a>
									</div>
								</div>
								<div class="panel-body">
									<div id='calendar'></div>
								</div>
							</div>
						</div>
					</div>
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="footer clearfix">
			<div class="footer-inner">
				<?php echo date('Y')?> &copy; M-Shamba Limited.
			</div>
			<div class="footer-items">
				<span class="go-top"><i class="clip-chevron-up"></i></span>
			</div>
		</div>
		<!-- end: FOOTER -->
		<div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title">Event Management</h4>
					</div>
					<div class="modal-body"></div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-light-grey">
							Close
						</button>
						<button type="button" class="btn btn-danger remove-event no-display">
							<i class='icon-trash'></i> Delete Event
						</button>
						<button type='submit' class='btn btn-success save-event'>
							<i class='icon-ok'></i> Save
						</button>
					</div>
				</div>
			</div>
		</div>
		
		
		
		
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<![endif]-->
		 <?php echo theme_js('jquery-1.11.1.min.js'); ?>
		 <script src="<?php echo plugin_path('jquery-ui/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script src=" <?php echo plugin_path('blockUI/jquery.blockUI.js'); ?>"></script>
		<script src=" <?php echo plugin_path('iCheck/jquery.icheck.min.js'); ?>"></script>
		 <script src="<?php echo plugin_path('perfect-scrollbar/src/jquery.mousewheel.js'); ?>"></script>
		 <script src="<?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.js'); ?>"></script>
		
		 <?php echo theme_js('main.js'); ?> 

		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		 <script src="<?php echo plugin_path('flot/jquery.flot.js'); ?>"></script>
		 <script src="<?php echo plugin_path('jquery.flot.pie.js'); ?>"></script>
		 <script src="<?php echo plugin_path('flot/jquery.flot.resize.min.js'); ?>"></script>
		 <script src="<?php echo plugin_path('jquery.sparkline/jquery.sparkline.js'); ?>"></script>
		 <script src="<?php echo plugin_path('jquery-easy-pie-chart/jquery.easy-pie-chart.js'); ?>"></script>
		 <script src="<?php echo plugin_path('jquery-ui-touch-punch/jquery.ui.touch-punch.min.js'); ?>"></script>
		 <script src="<?php echo plugin_path('fullcalendar/fullcalendar/fullcalendar.js'); ?>"></script>
		  <?php echo theme_js('index.js'); ?> 
		
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		 
	

		
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Index.init();

				   // function to initiate Chart 1
    var runChart1 = function () {
        function randValue() {
            return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        };
        var tithes = [
           
		  <?php 
			$i=0; 
			  $chrts = array();
			  foreach($tithes_chart as $tc){
				  $i++;?>
           
           [<?php echo $i?>, <?php echo (int)$tc->totals;?>],
			
		<?php } ?>
        ];
        var offerings = [
            <?php 
			$i=0; 
			  $chrts = array();
			  foreach($offerings_chart as $tc){
				  $i++;?>
           
           [<?php echo $i?>, <?php echo (int)$tc->amount;?>],
			
		<?php } ?>
           
        ];
		var thanks = [
            <?php 
			$i=0; 
			  $chrts = array();
			  foreach($thanks_chart as $tc){
				  $i++;?>
           
           [<?php echo $i?>, <?php echo (int)$tc->totals;?>],
			
		<?php } ?>
           
        ];
		var support = [
            <?php 
			$i=0; 
			  $chrts = array();
			  foreach($support_chart as $tc){
				  $i++;?>
           
           [<?php echo $i?>, <?php echo (int)$tc->totals;?>],
			
		<?php } ?>
           
        ];
		var seeds = [
            <?php 
			$i=0; 
			  $chrts = array();
			  foreach($seeds_chart as $tc){
				  $i++;?>
           
           [<?php echo $i?>, <?php echo (int)$tc->totals;?>],
			
		<?php } ?>
           
        ];
		var others = [
            <?php 
			$i=0; 
			  $chrts = array();
			  foreach($others_chart as $tc){
				  $i++;?>
           
           [<?php echo $i?>, <?php echo (int)$tc->totals;?>],
			
		<?php } ?>
           
        ];
        var plot = $.plot($("#placeholder-h1"), [
		{
            data: tithes,
            label: "Tithes "
        }, 
		{
            data: offerings,
            label: "Offerings"
        },
		{
            data: thanks,
            label: "Thanks Giving"
        },
		{
            data: support,
            label: "Ministry Support"
        },
		{
            data: seeds,
            label: "Seeds Planting"
        },
		{
            data: others,
            label: "Other Contributions"
        }
		], {
            series: {
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.05
                        }, {
                            opacity: 0.01
                        }]
                    }
                },
                points: {
                    show: false
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#eee",
                borderWidth: 0
            },
            colors: ["#d12610","#37b7f3","#52e136","#000","#f0ad4e","#ffff00"],
            xaxis: {
                ticks: 11,
                tickDecimals: 0
            },
            yaxis: {
                ticks: 11,
                tickDecimals: 0
            }
        });
		
		function number_to_currency(num){
                    return parseFloat(num).toFixed(2);
                }

        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 15,
                border: '1px solid #333',
                padding: '4px',
                color: '#fff',
                'border-radius': '3px',
                'background-color': '#333',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }
        var previousPoint = null;
        $("#placeholder-h1").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    $("#tooltip").remove();
                    var x = item.datapoint[0],
                        y = item.datapoint[1].toFixed(2);
                    showTooltip(item.pageX, item.pageY, item.series.label+" " + x +" Update was KES " + y);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    };
	runChart1();
	
	 // function to initiate Full Calendar
    var runFullCalendar = function () {
        //calendar
        /* initialize the calendar
		 -----------------------------------------------------------------*/
        var $modal = $('#event-management');
        $('#event-categories div.event-category').each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 50 //  original position after the drag
            });
        });
        /* initialize the calendar
		 -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var calendar = $('#calendar').fullCalendar({
            buttonText: {
                prev: '<i class="icon-chevron-left"></i>',
                next: '<i class="icon-chevron-right"></i>'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [{
                title: 'Meeting with Boss',
                start: new Date(y, m, 1),
                className: 'label-default'
            }, {
                title: 'Bootstrap Seminar',
                start: new Date(y, m, d - 5),
                end: new Date(y, m, d - 2),
                className: 'label-teal'
            }, {
                title: 'Lunch with Nicole',
                start: new Date(y, m, d - 3, 12, 0),
                className: 'label-green',
                allDay: false
            }],
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                var $categoryClass = $(this).attr('data-class');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                if ($categoryClass)
                    copiedEventObject['className'] = [$categoryClass];
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                $modal.modal({
                    backdrop: 'static'
                });
                form = $("<form></form>");
                form.append("<div class='row'></div>");
                form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>New Event Name</label><input class='form-control' placeholder='Insert Event Name' type=text name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='label-default'>Work</option>").append("<option value='label-green'>Home</option>").append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
                $modal.find('.remove-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                    form.submit();
                });
                $modal.find('form').on('submit', function () {
                    title = form.find("input[name='title']").val();
                    $categoryClass = form.find("select[name='category'] option:checked").val();
                    if (title !== null) {
                        calendar.fullCalendar('renderEvent', {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay,
                                className: $categoryClass
                            }, true // make the event "stick"
                        );
                    }
                    $modal.modal('hide');
                    return false;
                });
                calendar.fullCalendar('unselect');
            },
            eventClick: function (calEvent, jsEvent, view) {
                var form = $("<form></form>");
                form.append("<label>Change event name</label>");
                form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success'><i class='icon-ok'></i> Save</button></span></div>");
                $modal.modal({
                    backdrop: 'static'
                });
                $modal.find('.remove-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.remove-event').unbind('click').click(function () {
                    calendar.fullCalendar('removeEvents', function (ev) {
                        return (ev._id == calEvent._id);
                    });
                    $modal.modal('hide');
                });
                $modal.find('form').on('submit', function () {
                    calEvent.title = form.find("input[type=text]").val();
                    calendar.fullCalendar('updateEvent', calEvent);
                    $modal.modal('hide');
                    return false;
                });
            }
        });
    };
     runFullCalendar();
  //********************************************END CALENDAR***************************************************//	 
	 
// ********************************************* START PIE CHART **************************************************//
     // function to initiate EasyPieChart
    var runEasyPieChart = function () {
        if (isIE8 || isIE9) {
            if (!Function.prototype.bind) {
                Function.prototype.bind = function (oThis) {
                    if (typeof this !== "function") {
                        // closest thing possible to the ECMAScript 5 internal IsCallable function
                        throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
                    }
                    var aArgs = Array.prototype.slice.call(arguments, 1),
                        fToBind = this,
                        fNOP = function () {}, fBound = function () {
                            return fToBind.apply(this instanceof fNOP && oThis ? this : oThis, aArgs.concat(Array.prototype.slice.call(arguments)));
                        };
                    fNOP.prototype = this.prototype;
                    fBound.prototype = new fNOP();
                    return fBound;
                };
            }
        }
        $('.easy-pie-chart .bounce').easyPieChart({
            animate: 1000,
            size: 70
        });
        $('.easy-pie-chart .cpu').easyPieChart({
            animate: 1000,
            lineWidth: 3,
            barColor: '#35aa47',
            size: 70
            
        });
    };
	runEasyPieChart();
	
			});
		</script>
	
		
		</body>
	<!-- end: BODY -->
</html>