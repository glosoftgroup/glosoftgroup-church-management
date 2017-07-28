<!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-primary sidebar-fixed">
                <div class="sidebar-content ">

                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">

                             <li <?php echo preg_match('/^(admin)$/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>
            <?php echo preg_match('/^(admin\/task_manager)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
            <a href="<?php echo base_url('/') ?>"><i class="icon-dashboard"></i>
                <span class="title"> Dashboard </span><span class="selected"></span>
            </a>
        </li>
        <?php $set = array('members', 'relatives', 'cfd_parents', 'ss_parents', 'dedications', 'committee', 'sunday_school', 'baptism', 'visitors'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active"' : ''; ?>>

            <a href="javascript:void(0)"><i class="icon-group"></i>
                <span class="title"> Members Management </span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <li <?php echo preg_match('/^(admin\/members)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>
                    <?php echo preg_match('/^(admin\/relatives)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/members'); ?>">
                        <i class="clip-users-2"></i>
                        <span class="title"> Church Members </span>
                    </a>
                </li>

                <li <?php echo preg_match('/^(admin\/sunday_school)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> 
                    <?php echo preg_match('/^(admin\/ss_parents)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/sunday_school'); ?>">
                        <i class="clip-user-2"></i>
                        <span class="title"> Sunday School Register </span>
                    </a>
                </li>

                <li <?php echo preg_match('/^(admin\/visitors)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> >
                    <a href="<?php echo base_url('admin/visitors'); ?>">
                        <i class="clip-user-5"></i>
                        <span class="title"> Visitors Management </span>
                    </a>
                </li>

                <li <?php echo preg_match('/^(admin\/dedications)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>
                    <?php echo preg_match('/^(admin\/cfd_parents)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/dedications'); ?>">
                        <i class="clip-user-3"></i>
                        <span class="title"> Children For Dedication </span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/baptism)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/baptism'); ?>">
                        <i class="clip-user-3"></i>
                        <span class="title"> Baptism Registration </span>
                    </a>
                </li>

            </ul>
        </li>
        <?php $set = array('offerings', 'allocations', 'allocations_expenditure', 'tithes', 'contribution_types', 'thanks_giving', 'pledges', 'donations', 'expenses', 'expenses_category', 'expenses_items', 'petty_cash', 'other_contributions', 'purchase_order', 'bank_accounts', 'ministry_support', 'seed_planting', 'tax_config', 'book_of_accounts', 'other_revenues'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
            <a href="javascript:void(0)"><i class="icon-briefcase"></i>
                <span class="title"> Church Accounts </span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <?php $acc = array('offerings', 'contribution_types', 'other_revenues', 'tithes', 'pledges', 'donations', 'thanks_giving', 'ministry_support', 'seed_planting', 'other_contributions'); ?>
                <li <?php echo in_array($this->uri->segment(2), $acc) ? 'class="active open inner-li"' : ''; ?>>
                    <a href="javascript:;">
                        <i class="icon-suitcase"></i>
                        Church Finance <i class="icon-arrow"></i>
                    </a>
                    <ul class="sub-menu">
                        <li  <?php echo preg_match('/^(admin\/offerings)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> >
                            <a href="<?php echo base_url('admin/offerings'); ?>">
                                <i class="clip-banknote"></i>
                                <span class="title">Offerings </span>
                            </a>
                        </li>
                        <li  <?php echo preg_match('/^(admin\/tithes)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> >
                            <a href="<?php echo base_url('admin/tithes'); ?>">
                                <i class="clip-note"></i>
                                <span class="title">Tithe</span>
                            </a>
                        </li>
                        <li  <?php echo preg_match('/^(admin\/thanks_giving)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> >
                            <a href="<?php echo base_url('admin/thanks_giving'); ?>">
                                <i class="clip-thumbs-up"></i>
                                <span class="title">Thanks Giving</span>
                            </a>
                        </li>
                        <li  <?php echo preg_match('/^(admin\/ministry_support)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> >
                            <a href="<?php echo base_url('admin/ministry_support'); ?>">
                                <i class="icon-thumbs-up"></i>
                                <span class="title">Ministry Support</span>
                            </a>
                        </li>
                        <li  <?php echo preg_match('/^(admin\/seed_planting)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> >
                            <a href="<?php echo base_url('admin/seed_planting'); ?>">
                                <i class="clip-leaf"></i>
                                <span class="title">Seed Planting</span>
                            </a>
                        </li>

                        <li  <?php echo preg_match('/^(admin\/other_contributions)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> 
                        <?php echo preg_match('/^(admin\/contribution_types)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> 
                            >
                            <a href="<?php echo base_url('admin/other_contributions'); ?>">
                                <i class="clip-list-4"></i>
                                <span class="title">Other Contributions</span>
                            </a>
                        </li>
                        <li  <?php echo preg_match('/^(admin\/pledges)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> >
                            <a href="<?php echo base_url('admin/pledges'); ?>">
                                <i class="clip-stack-2"></i>
                                <span class="title">Pledges</span>
                            </a>
                        </li>
                        <li <?php echo preg_match('/^(admin\/other_revenues)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                            <a href="<?php echo site_url('admin/other_revenues'); ?>">
                                <i class="icon-list-alt"></i>
                                <span class="title">Other Revenue</span>
                            </a>
                        </li>


                        <li  <?php echo preg_match('/^(admin\/donations)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> >
                            <a href="<?php echo base_url('admin/donations'); ?>">
                                <i class="icon-gift"></i>
                                <span class="title">Donations</span>
                            </a>
                        </li>

                        <li><hr /></li>
                    </ul>

                </li>

                <li <?php echo preg_match('/^(admin\/allocations)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/allocations'); ?>">
                        <i class="clip-cube-2"></i>
                        <span class="title">Budget Allocations</span>
                    </a>
                </li>

                <li <?php echo preg_match('/^(admin\/expenses)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/expenses'); ?>">
                        <i class="icon-shopping-cart"></i>
                        <span class="title">Expenses</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/petty_cash)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/petty_cash'); ?>">
                        <i class="icon-edit"></i>
                        <span class="title">Petty Cash</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/purchase_order)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/purchase_order'); ?>">
                        <i class="icon-file-alt"></i>
                        <span class="title">Purchase Orders</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/bank_accounts)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/bank_accounts'); ?>">
                        <i class="icon-building"></i>
                        <span class="title">Bank Accounts</span>
                    </a>
                </li>
                <!--
                <li <?php echo preg_match('/^(admin\/tax_config)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                        <a href="<?php echo site_url('admin/tax_config'); ?>">
                        <i class="clip-vynil"></i>
                                <span class="title">Tax Configuration</span>
                        </a>
                </li>
                -->
            </ul>
        </li>
        <?php $pay = array('deductions', 'allowances', 'salaries', 'advance_salary', 'record_salaries'); ?>

        <li <?php echo in_array($this->uri->segment(2), $pay) ? 'class="active open inner-li"' : ''; ?>>
            <a href="javascript:;">
                <i class="icon-folder-open"></i>
                <span class="title">    Payrolls Management</span> <i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <li <?php echo preg_match('/^(admin\/salaries)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/salaries'); ?>">
                        <i class="icon-credit-card"></i>
                        <span class="title">Salaried Employees </span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/record_salaries)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/record_salaries'); ?>">
                        <i class="icon-random"></i>
                        <span class="title">Process Salaries</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/advance_salary)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/advance_salary'); ?>">
                        <i class="icon-thumbs-up"></i>
                        <span class="title">Advance Salaries</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/deductions)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/deductions'); ?>">
                        <i class="icon-thumbs-down"></i>
                        <span class="title">Deductions</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/allowances)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/allowances'); ?>">
                        <i class="icon-gift"></i>
                        <span class="title">Allowance</span>
                    </a>
                </li>
            </ul>

        </li>


        <?php $set = array('sms', 'current', 'calendar', 'sms_counter', 'purchase_history', 'emails', 'sms_subscriptions', 'meetings', 'events', 'announcements'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?> <?php echo in_array($this->uri->segment(3), $set) ? 'class="active open"' : ''; ?>>
            <a href="javascript:"><i class="icon-envelope"></i>
                <span class="title"> Communication </span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <li <?php echo preg_match('/^(admin\/sms)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>
                    <?php echo preg_match('/^(admin\/current)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/sms'); ?>">
                        <i class="clip-bubbles-2"></i>
                        <span class="title">SMS Messaging</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/purchase_history)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/purchase_history'); ?>">
                        <i class="clip-balance"></i>
                        <span class="title">SMS Purchase History</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/sms_subscriptions)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>
                    >
                    <a href="<?php echo site_url('admin/sms_subscriptions'); ?>">
                        <i class="clip-notification"></i>
                        <span class="title">SMS Subscription</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/emails)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/emails'); ?>">
                        <i class="icon-envelope-alt"></i>
                        <span class="title">Email Messaging</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/meetings)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/meetings'); ?>">
                        <i class="icon-coffee"></i>
                        <span class="title">Meetings</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/events)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/events'); ?>">

                        <i class="icon-calendar"></i>
                        <span class="title">Events</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/announcements)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/announcements'); ?>">
                        <i class="icon-bullhorn"></i>
                        <span class="title">Announcements</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/admin\/calendar)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo site_url('admin/admin/calendar'); ?>">
                        <i class="clip-calendar"></i>
                        <span class="title">Full Calendar</span>
                    </a>
                </li>


            </ul>
        </li>
        

        <?php $set = array('assets_trend', 'assets', 'asset_items', 'asset_stock', 'take_stock', 'asset_category'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
            <a href="javascript:;"><i class="icon-rss"></i>
                <span class="title">Assets Management</span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">

                <li <?php echo preg_match('/^(admin\/asset_category)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/asset_category'); ?>">
                        <i class="icon-tasks"></i>
                        <span class="title">Assets Category</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/asset_items)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/asset_items'); ?>">
                        <i class="icon-list-ul"></i>
                        <span class="title">Assets Items</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/asset_stock)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/asset_stock'); ?>">
                        <i class="icon-plus"></i>
                        <span class="title">Add Asset Stock</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/take_stock)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/take_stock'); ?>">
                        <i class="clip-refresh"></i>
                        <span class="title">Take Stock</span>
                    </a>
                </li>
            </ul>
        </li>


        <li <?php echo preg_match('/^(admin\/folders)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
            <a href="<?php echo base_url('admin/folders'); ?>"><i class="icon-folder-close"></i>
                <span class="title">Files Manager</span>
                <span class="selected"></span>
            </a>

        </li>
        <li <?php echo preg_match('/^(admin\/church_projects)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
            <a href="<?php echo base_url('admin/church_projects'); ?>"><i class="icon-file"></i>
                <span class="title">Church Projects</span>
                <span class="selected"></span>
            </a>

        </li>

        <li <?php echo preg_match('/^(admin\/ministries)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
            <a href="<?php echo base_url('admin/ministries'); ?>"><i class="icon-bookmark"></i>
                <span class="title">Church Ministries</span>
                <span class="selected"></span>
            </a>

        </li>
        <?php $set = array('hbcs', 'hbc_meetings'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
            <a href="<?php echo base_url('admin/hbcs'); ?>">
                <i class="clip-list-4"></i>
                <span class="title"> All HBCs</span>
                <span class="selected"></span>
            </a>
        </li>
        <?php $set = array('weddings', 'video_sermons', 'sermons', 'hymns_manager', 'bible_quotes', 'prayer_requests', 'daily_inspirations'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
            <a href="javascript:void(0)"><i class="icon-warning-sign"></i>
                <span class="title">Resources</span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <li <?php echo preg_match('/^(admin\/weddings)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/weddings'); ?>">
                        <i class="clip-tux"></i>
                        <span class="title">Wedding Bells</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/sermons)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/sermons'); ?>">
                        <i class="icon-book"></i>
                        <span class="title">Sermons</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/video_sermons)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/video_sermons'); ?>">
                        <i class="icon-book"></i>
                        <span class="title">Video Sermons</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/hymns_manager)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/hymns_manager'); ?>">
                        <i class="clip-music-2"></i>
                        <span class="title">Hymns Manager</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/bible_quotes)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/bible_quotes'); ?>">
                        <i class="icon-book"></i>
                        <span class="title">Bible Quotes</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/prayer_requests)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/prayer_requests'); ?>">
                        <i class="clip-thumbs-up"></i>
                        <span class="title">Prayer Requests</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/daily_inspirations)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/daily_inspirations'); ?>">
                        <i class="clip-bubble-dots-2"></i>
                        <span class="title">Daily Inspirations</span>
                    </a>
                </li>

            </ul>
        </li>

        <?php $set = array('reports', 'accounts_reports', 'accounts', 'members_reports', 'assets_reports', 'wages_reports', 'other_reports'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
            <a href="javascript:;"><i class="clip-bars"></i>
                <span class="title"> Custom Reports </span><i class="icon-arrow"></i>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <?php $members = array('accounts_reports', 'filter_account', 'accounts_date', 'pledges'); ?>
                <li <?php echo in_array($this->uri->segment(3), $members) ? 'class="active open"' : ''; ?>>

                    <a href="<?php echo base_url('admin/reports/accounts_reports'); ?>">
                        <i class="icon-signal"></i>
                        <span class="title">Accounts Reports </span>
                    </a>
                </li>
                <?php $members = array('filter_members', 'members_byDate', 'baptism_byDate', 'ssSchool_byDate', 'dedications_byDate', 'members_reports', 'members', 'filter_visitors', 'filter_ssSchool', 'filter_baptism', 'filter_dedications', 'filter_hbc_members', 'filter_ministry_members'); ?>
                <li <?php echo in_array($this->uri->segment(3), $members) ? 'class="active open"' : ''; ?>>
                    <a href="<?php echo base_url('admin/reports/members_reports'); ?>">
                        <i class="clip-bars"></i>
                        <span class="title">Members Reports</span>
                    </a>
                </li>
                <?php $sms = array('filter_sms', 'sms_reports', 'current_monthSMS', 'sms_purchased', 'purchased_byDate'); ?>
                <li <?php echo in_array($this->uri->segment(3), $sms) ? 'class="active open"' : ''; ?>>
                    <a href="<?php echo base_url('admin/reports/sms_reports'); ?>">
                        <i class="clip-bars"></i>
                        <span class="title">SMS Reports</span>
                    </a>
                </li>

                <?php $set = array('assets_reports', 'filter_assets'); ?>
                <li <?php echo in_array($this->uri->segment(3), $set) ? 'class="active open"' : ''; ?>>
                    <a href="<?php echo base_url('admin/reports/assets_reports'); ?>">
                        <i class="icon-th-list"></i>
                        <span class="title">Assets Reports</span>
                    </a>
                </li>

                <?php $set = array('expenses'); ?>
                <li <?php echo in_array($this->uri->segment(3), $set) ? 'class="active open"' : ''; ?>>
                    <a href="<?php echo base_url('admin/reports/expenses'); ?>">
                        <i class="icon-th-list"></i>
                        <span class="title">Expenses Reports</span>
                    </a>
                </li>
                <?php $set = array('petty_cash'); ?>
                <li <?php echo in_array($this->uri->segment(3), $set) ? 'class="active open"' : ''; ?>>
                    <a href="<?php echo base_url('admin/reports/petty_cash'); ?>">
                        <i class="icon-th-list"></i>
                        <span class="title">Petty Cash Reports</span>
                    </a>
                </li>

                <li <?php echo preg_match('/^(admin\/reports\/wages)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/reports/wages'); ?>">
                        <i class="clip-grid"></i>
                        <span class="title">Wages Reports</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/other_reports)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/reports/'); ?>">
                        <i class="icon-align-left"></i>
                        <span class="title">Other Reports</span>
                    </a>
                </li>
                <!---
                        <li <?php echo preg_match('/^(admin\/accounts)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                        <a href="javascript:;">
                        <i class="icon-folder-open-alt"></i>
                                Book of Accounts <i class="icon-arrow"></i>
                        </a>
                                <ul class="sub-menu">
                                <li <?php echo preg_match('/^(admin\/accounts)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?> >
                                                <a href="<?php echo base_url('admin/accounts'); ?>">
                                                <i class="icon-list-alt"></i>
                                                        <span class="title">Chart of Accounts </span>
                                                </a>
                                        </li>
                                        <li <?php echo preg_match('/^(admin\/trial_balance)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                                                <a href=<?php echo base_url('admin/trial_balance'); ?>>
                                                <i class="icon-file"></i>
                                                        <span class="title">Trial Balance</span>
                                                </a>
                                        </li>
                                        <li <?php echo preg_match('/^(admin\/balance_sheet)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                                                <a href="<?php echo base_url('admin/balance_sheet'); ?>">
                                                <i class="icon-retweet"></i>
                                                        <span class="title">Balance Sheet</span>
                                                </a>
                                        </li>
                                        <li <?php echo preg_match('/^(admin\/ledger_account)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                                                <a href="<?php echo base_url('admin/ledger_account'); ?>">
                                                <i class="icon-reorder"></i>
                                                        <span class="title">Ledger Account</span>
                                                </a>
                                        </li>
                                </ul>
                                
                </li>
                -->
            </ul>

        </li>
        <?php $set = array('address_book', 'contacts', 'customers', 'suppliers', 'others'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
            <a href="javascript:"><i class=" clip-file-2"></i>
                <span class="title"> Contacts Directory </span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <li  <?php echo preg_match('/^(admin\/address_book\/create)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>
                <?php echo preg_match('/^(admin\/address_book)$/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>
                    <?php echo preg_match('/^(admin\/address_book\/edit)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/address_book'); ?>">
                        <i class="icon-book"></i>
                        <span class="title">Address Book </span>
                    </a>
                </li>
                <li  <?php echo preg_match('/^(admin\/address_book\/customers)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/address_book/customers'); ?>">
                        <i class="icon-list-alt"></i>
                        <span class="title">Customers</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/address_book\/suppliers)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/address_book/suppliers'); ?>">
                        <i class="icon-list"></i>
                        <span class="title">Suppliers</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/address_book\/others)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/address_book/others'); ?>">
                        <i class="icon-th-list"></i>
                        <span class="title">Others</span>
                    </a>
                </li>
            </ul>

        </li>

        <?php $set = array('users', 'groups'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
            <a href="javascript:void(0)"><i class="clip-users"></i>
                <span class="title">User Management</span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <li <?php echo preg_match('/^(admin\/users\/admin)$/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/users'); ?>">
                        <i class="icon-user"></i>
                        <span class="title">Administrators</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/users)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/users'); ?>">
                        <i class="icon-list-alt"></i>
                        <span class="title">All Users</span>
                    </a>
                </li>
                <li <?php echo preg_match('/^(admin\/groups)/i', $this->uri->uri_string()) ? 'class="active open" ' : ''; ?>>
                    <a href="<?php echo base_url('admin/groups'); ?>">
                        <i class="icon-group"></i>
                        <span class="title">User Groups</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php $set = array('settings', 'backup'); ?>
        <li <?php echo in_array($this->uri->segment(2), $set) ? 'class="active open"' : ''; ?>>
            <a href="<?php echo base_url('admin/settings'); ?>"><i class="icon-cogs"></i>
                <span class="title">Church Settings</span>
                <span class="selected"></span>
            </a>
        </li>

        <li>
            <a href="#"></a>
        </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
            <!-- /main sidebar -->
