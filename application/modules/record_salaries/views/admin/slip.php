<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Employee Payslip </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <button onClick="window.print();return false" class="btn btn-success" type="button"><span class="icon-print"></span> Print </button>
                    <?php if ($this->ion_auth->is_in_group($this->user->id, 3))
                        {
                             ?>
                        <?php
                        }
                        else
                        {
                             ?>
         <?php echo anchor('admin/record_salaries', '<i class="icon-list">
                </i> ' . lang('web_list_all', array(':name' => ' Salaries')), 'class="btn btn-primary"'); ?> 
    <?php } ?>
                </div>
            </div>
        </div>

<?php
    $st = $this->ion_auth->get_user($post->employee);
?>

        <div class="panel-body" style="display: block;"> 

            <div class="col-sm-12 center">

<?php
    $ch = $this->settings;
?>
                <img src="<?php echo site_url('uploads/files/' . $ch->file); ?>">
                <br>

<?php
    echo ucwords($ch->name);
?><br>
                <span class="center" style="font-size:1.5em;">
                    Payslip For The Period Of <abbr title="Date"  ><?php echo date('F, Y', $post->salary_date); ?></abbr>

                </span>
                <hr>
            </div>

            <div class="clearfix"></div>


            <div class="col-sm-12">
                <div class="col-sm-4">
                    <address>
                        <strong>Employee: </strong><?php echo $st->first_name . ' ' . $st->last_name; ?><br>
                        <abbr title="Phone"><b>P: </b></abbr><?php echo $st->phone; ?><br>
                        <abbr title="Email"><b>E: </b></abbr><?php echo $st->email; ?><br>

                    </address>
                </div>


                <div class="col-sm-4">

                    <address>
                        <strong>EMP ID: </strong><?php echo $st->id ?><br>
                        EMP Date: <?php echo date('d M Y', $st->created_on); ?><br>
                        Salary Type: <?php echo $post->salary_method; ?><br>

                    </address>  
                </div>

                <div class="col-sm-4">

                    <strong>Date:</strong> <?php echo date('l d F, Y', $post->salary_date); ?>
                    <br>

                    <div class="highlight">
                        <strong>Basic Salary: </strong><?php echo number_format($post->basic_salary, 2); ?> <em>KES</em>
                    </div>
                </div>



            </div>


            <div class="clearfix"></div>

            <div class="col-sm-12">


                <table width="100%" >
                    <tr>
                        <td class="col-sm-6"> <b> Earnings </b><div class="right"><b style="margin-right:10px;"> Amount (KES)</b> </div></td>
                        <td class="col-sm-6"> <b> Deductions  </b><div class="right"><b style="margin-right:10px;"> Amount (KES)</b></div> </td>
                    </tr>
                    <tr>
                        <td  class="col-sm-6">

                            <div class="inner_items">
                                <div class="item">

                                    Basic Salary
                                    <div class="right"><?php echo number_format($post->basic_salary, 2); ?></div>
                                </div>
                                <?php if (!empty($post->allowances)): ?>
                                         <?php
                                         $all = array();
                                         $all = explode(',', $post->allowances);
                                         foreach ($all as $l):
                                              $vals = explode(':', $l);
                                              ?>
                                              <div class="item">

                                              <?php echo $vals[0]; ?>
                                                  <div class="right"> <?php echo number_format($vals[1], 2); ?></div>
                                              </div>
         <?php endforeach; ?> 
    <?php endif; ?> 
                            </div>
                        </td>
                        <td  class="col-sm-6">

                            <div class="inner_items">
                                <div class="item">

                                    Tax (<?php echo $tax->amount; ?>%)
                                    <div class="right"><?php $tax_ded = ($post->basic_salary * $tax->amount) / 100;
    echo number_format($tax_ded, 2);
?></div>
                                </div>
<?php if (!empty($post->advance)): ?>
                                         <div class="item">

                                             Advance Salary
                                             <div class="right"><?php echo number_format($post->advance, 2); ?></div>
                                         </div>
    <?php endif; ?>
<?php if (!empty($post->nhif)): ?>
                                         <div class="item">

                                             NHIF
                                             <div class="right"><?php echo number_format($post->nhif, 2); ?></div>
                                         </div>
                                    <?php endif; ?>
                                <?php if (!empty($post->deductions)): ?>
                                         <?php
                                         $dec = array();
                                         $dec = explode(',', $post->deductions);
                                         foreach ($dec as $d):
                                              $vals = explode(':', $d);
                                              ?>
                                              <div class="item">

                                              <?php echo $vals[0]; ?>
                                                  <div class="right"> <?php echo number_format($vals[1], 2); ?></div>
                                              </div>
         <?php endforeach; ?> 
    <?php endif; ?> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td  class="col-sm-3">
                            <div class="item">
                                <b>Total Earnings</b>
                                <div class="right" style="border-bottom:1px solid #ccc;border-top:1px solid #ccc"> 
                                    <b> <?php $t_earnings = ($post->basic_salary + $post->total_allowance);
    echo number_format($t_earnings, 2);
?></b>
                                </div>
                            </div>
                        </td>
                        <td  class="col-sm-3">
                            <div class="item">
                                <b>Total Deduction</b>
                                <div class="right" style="border-bottom:1px solid #ccc; border-top:1px solid #ccc">  
                                    <b><?php $t_deductions = ($post->advance + $tax_ded + $post->total_deductions + $post->nhif);
    echo number_format($t_deductions, 2);
?></b>
                                </div>
                            </div>	
                        </td>
                    </tr>
                </table>
            </div>
            <div class="clearfix">  <hr></div>

            <div class="col-sm-12">
                <div class="col-sm-7">
                    <b style="border-bottom:1px solid #ccc"> Amount in words: </b>

<?php
    $net = ($t_earnings - $t_deductions);
    $words = convert_number_to_words($net);
    echo ucwords($words);
?> Kenyan Shilling Only
                </div>
                <div class="col-sm-4 right">

                    <strong><span class="bold"> Net Pay: </span></strong>

                    <span class="kes" style="border-bottom:1px solid #ccc">
                        KES. <b><?php echo number_format($net, 2); ?> </b> </span>


                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-12">
                <div class="col-sm-6">
                    <br>
                    <br>
                    <strong style="border-top:1px solid #000"> Employee Signature: </strong>

                </div>
                <div class="col-sm-6">
                    <br>
                    <br>
                    <strong class="right" style="border-top:1px solid #000"> Official Signature: </strong>
                </div>
            </div>
            <div class="col-sm-12 center" style="border-top:1px solid #ccc">		
                <span class="center" style="font-size:0.8em !important;text-align:center !important;"><?php echo $ch->address . ' Tel ' . $ch->phone . ' Email ' . $ch->email; ?></span>
            </div>


        </div>
        <div class="col-sm-2"></div>
    </div>
</div>

<style>
    @media print{


         .buttons-hide{
              display:none !important;
         }
         .col-sm-4 {
              width: 200px !important;
              float: left !important;
              margin:0px !important; 
         }

         .right{
              float:right;

         }
         .bold{
              font-weight:bold;
              font-size:1.5em;
              color:#000;
         }
         .kes{
              color:#000;
              font-weight:bold;
         }
         .item{
              padding:3px;
         }
         .col-sm-3 {
              width: 200px !important;
              float: left !important;
         }
         .col-sm-6 {
              width: 300px !important;
              float: left !important;
         }
         .col-sm-7 {
              width: 400px !important;
              float: left !important;
         }
         .col-sm-2 {
              width: 150px !important;
              float: left !important;
         }

         .navigation{
              display:none;
         }
         .alert{
              display:none;
         }
         .panel-heading{
              display:none !important;
         }

         .top-panel-header{
              display:none !important;
         }

         .footer {
              display:none !important;
         }
         .main-content .container{

              border:none !important;
         }


         .img{
              align:center !important;
         } 

         .print{
              display:none !important;
         }
         .bank{
              float:right;
         }
         .view-title h1{border:none !important; text-align:center }
         .view-title h3{border:none !important; }

         .split{

              float:left;
         }
         .header{display:none}
         .invoice { 
              width:100%;
              margin: auto !important;
              padding: 0px !important;
         }
         .invoice table{padding-left: 0; margin-left: 0; }

         .smf .content {
              margin-left: 0px;
         }
         .content {
              margin-left: 0px;
              padding: 0px;
         }
    }
</style>     

