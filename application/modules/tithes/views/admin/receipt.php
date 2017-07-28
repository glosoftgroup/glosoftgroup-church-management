<div class="col-sm-12">
    <div class=" panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Member Receipt </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <button onClick="window.print();return false" class="btn btn-success" type="button"><span class="icon-print"></span> Print </button>

                    <?php echo anchor('admin/tithes/view_members/' . $post->tithe_id . '/1', '<i class="icon-list">
                </i> ' . lang('web_list_all', array(':name' => ' List Member')), 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/tithes', '<i class="icon-list">
                </i> ' . lang('web_list_all', array(':name' => ' Tithes')), 'class="btn btn-info"'); ?> 

                </div>
            </div>
        </div>

        <div class="panel-body receipt"> 

            <div class="col-sm-12">
                <div class="col-sm-8">

                    <span >
                         <?php
                             $ch = $this->settings;
                         ?>
                        <img src="<?php echo site_url('uploads/files/' . $ch->file); ?>">

                    </span>
                    <span class="receipt-title">

                        Tithe Receipt </span>
                </div>
                <div class="col-sm-4 ref">
                    Receipt No. <abbr ><?php echo '00' . $post->id; ?></abbr ><br>
                    Date <abbr ><?php echo date('d M Y', $post->created_on); ?></abbr >
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="col-sm-12">
                Received From <abbr ><?php echo $member->title . ' ' . $member->first_name . ' ' . $member->last_name . ' [ Code: ' . $member->member_code . ' ]'; ?></abbr> The Amount of KES <abbr  ><?php echo number_format($post->amount, 2) ?></abbr > 
                Being a Contribution For Tithe

            </div>

            <div class="clearfix"></div>
            <div class="col-sm-12">
                <br>
                Amount in words: <abbr  ><?php
                         $words = convert_number_to_words($post->amount);
                         echo ucwords($words);
                     ?> Kenyan Shilling Only </abbr>

            </div>

            <div class="col-sm-12 center">
                <hr>				
                <span class="center" style="font-size:0.8em !important;text-align:center !important;">
                    Thank you for supporting the ministry<br>
                    <?php echo $ch->address . ' Tel ' . $ch->phone . ' Email ' . $ch->email; ?></span>
            </div>


        </div>

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

         .col-sm-3 {
              width: 180px !important;
              float: left !important;
         }
         .col-sm-6 {
              width: 250px !important;
              float: left !important;
         }
         .col-sm-7 {
              width: 400px !important;
              float: left !important;
         }
         .col-sm-9 {
              width: 550px !important;
              float: left !important;
         }

         .col-sm-8 {
              width: 400px !important;
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

         .print{
              display:none !important;
         }

         .header{display:none}

         .smf .content {
              margin-left: 0px;
         }
         .content {
              margin-left: 0px;
              padding: 0px;
         }
    }
</style>     

