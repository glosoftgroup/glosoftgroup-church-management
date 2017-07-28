
<div class="row">
    <div class="col-sm-12">
        <div class="row space12">
            <ul class="mini-stats col-sm-12">
                <li class="col-sm-2 ">
                    <a href="<?php echo base_url('admin/permissions/assign'); ?>">
                        <div class="values alert 
                             <?php echo preg_match('/^(admin\/permissions\/assign)$/i', $this->uri->uri_string()) ? ' btn-primary ' : 'btn-green'; ?> ">
                            Select Modules 
                        </div>
                    </a>	
                </li>
                <li class="col-sm-2">
                    <a href="<?php echo base_url('admin/permissions/view'); ?>" >
                        <div class="values alert 
                             <?php echo preg_match('/^(admin\/permissions\/view)$/i', $this->uri->uri_string()) ? ' btn-primary ' : 'btn-green'; ?> ">
                            Assign  Permissions
                        </div>
                    </a>
                </li>
                <li class="col-sm-2">
                    <a href="<?php echo base_url('admin/permissions/fix_resources'); ?>">
                        <div class="values alert 
                             <?php echo preg_match('/^(admin\/permissions\/fix_resources)$/i', $this->uri->uri_string()) ? ' btn-primary ' : 'btn-green'; ?> ">
                            Configure Modules
                        </div>
                    </a>
                </li>
                <li class="col-sm-2">
                    <a href="<?php echo base_url('admin/permissions/fix_routes'); ?>">
                        <div class="values alert 
                             <?php echo preg_match('/^(admin\/permissions\/fix_routes)$/i', $this->uri->uri_string()) ? ' btn-primary ' : 'btn-green'; ?> ">
                            Configure Routes
                        </div>
                    </a>
                </li>

                <li class="col-sm-2">
                    <a href="<?php echo base_url('admin/permissions/generate_routes'); ?>">
                        <div class="values alert 
                             <?php echo preg_match('/^(admin\/permissions\/generate_routes)$/i', $this->uri->uri_string()) ? ' btn-primary ' : 'btn-green'; ?> ">
                            Update Routes
                        </div>
                    </a>
                </li>
                <li class="col-sm-2">
                    <a href="<?php echo base_url('admin/permissions/generate_resources'); ?>">
                        <div class="values alert 
                             <?php echo preg_match('/^(admin\/permissions\/generate_resources)$/i', $this->uri->uri_string()) ? ' btn-primary ' : 'btn-green'; ?> ">
                            Update Modules
                        </div>
                    </a>
                </li>

            </ul>
        </div> 
    </div>

</div>
<style>a:hover {text-decoration: none;    }</style>