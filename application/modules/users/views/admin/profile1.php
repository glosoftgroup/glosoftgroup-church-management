<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->
        <?php $me = $this->ion_auth->get_user($id); ?>
        <div>
            <div id="user-profile-1" class="user-profile row-fluid">
                <div class="span3 center">
                    <div>
                        <span class="profile-picture">
                             <?php echo theme_image('avatars/avatar6.png', array('class' => 'editable',)); ?>
                        </span>

                        <div class="space-4"></div>

                        <div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
                            <div class="inline position-relative">
                                <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-circle light-green middle"></i>
                                    &nbsp;
                                    <span class="white middle bigger-120">
                                        <?php echo $me->first_name . ' ' . $me->last_name; ?></span>
                                </a>

                                <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                                    <li class="nav-header"> Change Status </li>

                                    <li>
                                        <a href="#">
                                            <i class="icon-circle green"></i>
                                            &nbsp;
                                            <span class="green">Available</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="icon-circle red"></i>
                                            &nbsp;
                                            <span class="red">Busy</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="icon-circle grey"></i>
                                            &nbsp;
                                            <span class="grey">Invisible</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="space-6"></div>

                    <div class="profile-contact-info">
                        <div class="profile-contact-links align-left">

                            <a class="btn btn-link" href="#">
                                <i class="icon-globe bigger-125 blue"></i>
                                <?php echo $this->ion_auth->is_in_group($id, 1) ? 'Administrator' : 'Member'; ?>
                            </a>
                        </div>

                        <div class="space-6"></div>

                        <div class="profile-social-links center">
                            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
                                <i class="middle icon-facebook-sign icon-2x blue"></i>
                            </a>

                            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
                                <i class="middle icon-twitter-sign icon-2x light-blue"></i>
                            </a>

                            <a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
                                <i class="middle icon-pinterest-sign icon-2x red"></i>
                            </a>
                        </div>
                    </div>

                    <div class="hr hr16 dotted"></div>
                </div>

                <div class="span9">
                     <?php /* <div class="center">
                           <span class="btn btn-app btn-small btn-light no-hover">
                           <span class="bigger-150 blue">  411 </span>

                           <br />
                           <span class="smaller-90"> Views </span>
                           </span>

                           <span class="btn btn-app btn-small btn-yellow no-hover">
                           <span class="bigger-175"> 32 </span>

                           <br />
                           <span class="smaller-90"> TV </span>
                           </span>

                           <span class="btn btn-app btn-small btn-pink no-hover">
                           <span class="bigger-175"> 4 </span>

                           <br />
                           <span class="smaller-90"> Radio </span>
                           </span>

                           <span class="btn btn-app btn-small btn-grey no-hover">
                           <span class="bigger-175"> 23 </span>

                           <br />
                           <span class="smaller-90"> Print </span>
                           </span>

                           <span class="btn btn-app btn-small btn-success no-hover">
                           <span class="bigger-175"> 7 </span>

                           <br />
                           <span class="smaller-90"> Uploads </span>
                           </span>

                           <span class="btn btn-app btn-small btn-primary no-hover">
                           <span class="bigger-175"> 55 </span>

                           <br />
                           <span class="smaller-90"> Contacts </span>
                           </span>
                           </div> */ ?>

                    <div class="space-12"></div>

                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Username </div>

                            <div class="profile-info-value">
                                <span class="editable" id="username">
                                    <?php echo $me->username; ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Joined </div>

                            <div class="profile-info-value">
                                <span class="editable" id="signup"><?php echo date('d M Y', $me->created_on); ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Last Online </div>

                            <div class="profile-info-value">
                                <span class="editable" id="login"><?php echo date('d M Y', $me->last_login); ?></span>
                            </div>
                        </div>

                    </div>

                    <div class="space-20"></div>

                    <div class="widget-box transparent">
                        <div class="widget-header widget-header-small">
                            <h4 class="blue smaller">
                                <i class="icon-rss orange"></i>
                                Recent Activities
                            </h4>

                            <div class="widget-toolbar action-buttons">
                                <a href="#" data-action="reload">
                                    <i class="icon-refresh blue"></i>
                                </a>

                                &nbsp;
                                <a href="#" class="pink">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-8">
                                <div id="profile-feed-1" class="profile-feed">

                                    <div class="profile-activity clearfix">
                                        <div>
                                            <i class="pull-left thumbicon icon-off btn-inverse no-hover"></i>
                                            <a class="user" href="#"><?php echo $me->first_name . ' ' . $me->last_name; ?> </a>
                                            logged out.
                                            <div class="time">
                                                <i class="icon-time bigger-110"></i>
                                                16 hours ago
                                            </div>
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="icon-pencil bigger-125"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="icon-remove bigger-125"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="profile-activity clearfix">
                                        <div>
                                            <i class="pull-left thumbicon icon-camera btn-pink no-hover"></i>
                                            <a class="user" href="#"> <?php echo date('d M Y', $me->last_login); ?> </a>
                                            Looking Around
                                            <a href="#">View now</a>
                                            <div class="time">
                                                <i class="icon-time bigger-110"></i>
                                                13 hours ago
                                            </div>
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="icon-pencil bigger-125"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="icon-remove bigger-125"></i>
                                            </a>
                                        </div>
                                    </div> 


                                    <div class="profile-activity clearfix">
                                        <div>
                                            <i class="pull-left thumbicon icon-key btn-info no-hover"></i>
                                            <a class="user" href="#"> <?php echo $me->first_name . ' ' . $me->last_name; ?> </a>
                                            logged in.
                                            <div class="time">
                                                <i class="icon-time bigger-110"></i>
                                                12 hours ago
                                            </div>
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="icon-pencil bigger-125"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="icon-remove bigger-125"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr hr2 hr-double"></div>

                    <div class="space-6"></div>

                    <div class="center">
                        <!-- <a href="#" class="btn btn-small btn-primary">
                             <i class="icon-rss bigger-150 middle"></i>

                             View more activities
                             <i class="icon-on-right icon-arrow-right"></i>
                         </a>-->
                    </div>
                </div>
            </div>
        </div>

        <!--PAGE CONTENT ENDS-->
    </div><!--/.span-->
</div><!--/.row-fluid-->