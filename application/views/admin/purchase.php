<div class="col-sm-12">
        <div class="panel panel-default"> 
        <div class="panel-heading">
		<i class="icon-external-link-sign"></i>
            <h3 class="panel-title">SMS Purchases History </h3>

            <div class="panel-tools">
               <div class="btn-group">
              <?php echo anchor( 'admin/sms' , '<i class="icon-list"></i> <span>'.lang('web_list_all', array(':name' => 'SMS')).'</span>', 'class="btn btn-info"');?> 
              </div>
            </div>
        </div>             
               <div class="panel-body" style="display: block;">   
               <div class="widget-main">
                
                                  
                <?php $hs = $this->portal_m->purchase_hostory(); if ($hs): ?>
                 <div class='clearfix'></div>
 <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">     	
	 <thead>
                <th>#</th>
				<th>Date</th>
				<th>Purchased</th>
				<th>Processed on</th>
				<th>Processed By</th>
				
		</thead>
		<tbody>
		<?php 
				 $i = 0;
					
                
            foreach ($hs as $p ): 
                 $i++;
				 $u = $this->ion_auth->get_user($p->created_by);
                     ?>
	 <tr>
                <td><?php echo $i . '.'; ?></td>					
				<td><?php echo date('d M Y',$p->date);?></td>
				<td><?php echo number_format($p->total);?> SMS</td>
				<td><?php echo date('d M Y',$p->created_on);?></td>
				<td><?php echo $u->first_name.' '.$u->last_name;?></td>

				</tr>
 			<?php endforeach ?>
		</tbody>

	</table>

  </div>
            </div>
        </div>
    </div>
 
<?php else: ?>
 	<p class='text'><?php echo lang('web_no_elements');?></p>
 <?php endif ?>