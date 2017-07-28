<div class="main-navigation navbar-collapse collapse">
    <!-- start: MAIN MENU TOGGLER BUTTON -->
    <div class="navigation-toggler">
        <i class="clip-chevron-left"></i>
        <i class="clip-list"></i>
        <i class="clip-chevron-right"></i>
    </div>
    <!-- start: MAIN NAVIGATION MENU -->
    <ul class="main-navigation-menu">
        <li <?php echo preg_match('/^(admin)$/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>
            <?php echo preg_match('/^(admin\/task_manager)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
            <a href="<?php echo base_url('/') ?>"><i class="fa fa-dashboard"></i>
                <span class="title"> Dashboard </span><span class="selected"></span>
            </a>
        </li>
        <?php
        foreach ($this->scope as $us_grp => $ss)
        {
                foreach ($ss as $group => $mods)
                {
                        $set = array();
                        $temp = '';
                        $multp = FALSE;
                        if (count($mods) > 1)
                        {
                                $multp = TRUE;
                        }

                        foreach ($mods as $rw_link)
                        {  
                                $link = (object) $rw_link;
                                $set[] = $link->module;
                                $method = $link->method == 'index' ? '' : $link->method;
                                $suff = $link->method == 'index' ? '' : '\/';
                                $preg = preg_match('/^(admin\/' . $link->module . $suff . $method . ')/i', $this->uri->uri_string()) ? 'class = "active open" ' : '';
                                $ico = empty($link->icon) ? 'clip-folder-2' : $link->icon;
                                $temp .= '<li ' . $preg . '>
                                                        <a href="' . base_url('admin/' . $link->module . '/' . $method) . '">
                                                        <i class="' . $ico . '"></i>
                                                        <span class="title"> ' . $link->title . '</span>
                                                        </a>
                                               </li>';
                        }
                        if ($multp)
                        {
                                ?>
                                <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
                                    <a href="javascript:void(0)"><i class="fa fa-group"></i>
                                        <span class="title"> <?php echo $group; ?> </span><i class="icon-arrow"></i>
                                        <span class="selected"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <?php echo $temp; ?>
                                    </ul>
                                </li>
                                 <?php
                        }
                        else
                        {
                                ?>
                                <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
                                    <a href="<?php echo base_url('admin/' . $link->module . '/' . $method); ?>"><i class="icon-group"></i>
                                        <span class="title"> <?php echo $group; ?> </span>
                                        <span class="selected"></span>
                                    </a>
                                 </li>
                        <?php
                        }
                }
        }
        ?> 
    </ul>
    <!-- end: MAIN NAVIGATION MENU -->
</div>