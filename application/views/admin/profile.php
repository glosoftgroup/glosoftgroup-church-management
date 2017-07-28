<div class="row profile">
    <div class="col-sm-3">
        <?php echo theme_image('user-5.png', array('class' => "thumbnail img-responsive")); ?> 

        <div class="mb30"></div>

        <h5 class="subtitle">About</h5>
        <p class="mb30"><?php echo $user->bio; ?> </p>

        <h5 class="subtitle">Connect</h5>
        <ul class="profile-social-list">
            <li><i class="fa fa-twitter"></i> <a href="#">twitter.com/eileensideways</a></li>
            <li><i class="fa fa-facebook"></i> <a href="#">facebook.com/eileen</a></li>
            <li><i class="fa fa-youtube"></i> <a href="#">youtube.com/eileen22</a></li>
            <li><i class="fa fa-linkedin"></i> <a href="#">linkedin.com/4ever-eileen</a></li>
            <li><i class="fa fa-pinterest"></i> <a href="#">pinterest.com/eileen</a></li>
            <li><i class="fa fa-instagram"></i> <a href="#">instagram.com/eiside</a></li>
        </ul>

        <div class="mb30"></div>

        <h5 class="subtitle">Address</h5>
        <address>

            <abbr title="Phone">P:</abbr><?php echo $user->phone; ?> 
        </address>

    </div><!-- col-sm-3 -->
    <div class="col-sm-9">

        <div class="col-sm-6">
            <div class="profile-header">
                <h2 class="profile-name"><?php echo $user->first_name . ' ' . $user->last_name; ?></h2>
                <div class="profile-location"><i class="fa fa-map-marker"></i><?php echo $user->email; ?> </div>
                <div class="profile-position"><i class="fa fa-briefcase"></i><?php echo $user->phone; ?> </div>

                <div class="mb20"></div>
                <?php
                if ($id != $this->ion_auth->get_user()->id)
                {
                    $from = $this->ion_auth->get_user()->id;
                    ?>
                    <button class="btn btn-success mr5 request-<?php echo $id; ?> con-request" data-from="<?php echo $from; ?>" data-target="<?php echo $id; ?>"><i class="fa fa-user"></i> Connect</button>
                    <button class="btn btn-white"><i class="fa fa-envelope-o"></i> Message</button>

                    <?php
                }
                else
                {
                    ?>
                    <button class="btn btn-success mr5"><i class="fa fa-user"></i>Account</button>
                    <button class="btn btn-white"><i class="fa fa-envelope-o"></i> Message</button>
                <?php } ?>
            </div><!-- profile-header -->
        </div>
        <div class="col-sm-3">
            <div class="profile-header">
                <h2 class="profile-name">&nbsp;</h2>
                <div class="profile-location"><i class="fa fa-user-md"></i>Joined: <?php echo $user->created_on > 1000 ? date('d M Y', $user->created_on) : ''; ?></div>
                <div class="profile-position"><i class="fa fa-calendar"></i>Last Login: <?php echo $user->last_login > 1000 ? date('d M Y', $user->last_login) : ''; ?> </div>

                <div class="mb20"></div>

            </div><!-- profile-header -->
        </div>

        <div class="clearfix"></div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified nav-profile">
            <li class="active"><a href="#activities" data-toggle="tab"><strong>Activities</strong></a></li>
            <li><a href="#followers" data-toggle="tab"><strong>Connections</strong></a></li>
            <li><a href="#following" data-toggle="tab"><strong>Messages</strong></a></li>
            <li><a href="#events" data-toggle="tab"><strong>Discover</strong></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="activities">
                <div class="activity-list">

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Ray Sin</strong> started following <strong>Eileen Sideways</strong>. <br />
                            <small class="text-muted">Yesterday at 3:30pm</small>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Frank Furter</strong> started following <strong>Eileen Sideways</strong>. <br />
                            <small class="text-muted">6 days ago at 8:15am</small>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Eileen Sideways</strong> posted a new note. <br />
                            <small class="text-muted">6 days ago at 6:18am</small>
                            <h4 class="media-title"><a href="#">Consectetur Adipisicing Elit</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat... <a href="#">Read more</a></p>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Eileen Sideways</strong> posted a new blog. <br />
                            <small class="text-muted">December 25 at 3:18pm</small>

                            <div class="media blog-media">
                                <a class="pull-left" href="#">
                                    <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-title"><a href="#">Ut Enim Ad Minim Veniam</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat... <a href="#">Read more</a></p>
                                </div>
                            </div><!-- media -->
                        </div>
                    </div><!-- media -->

                </div><!-- activity-list -->


            </div>
            <div class="tab-pane" id="followers">

                <div class="follower-list">

                    <div class="media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body">
                            <h3 class="follower-name">Ray Sin</h3>
                            <div class="profile-location"><i class="fa fa-map-marker"></i> San Francisco, California, USA</div>
                            <div class="profile-position"><i class="fa fa-briefcase"></i> Software Engineer at <a href="#">SomeCompany, Inc.</a></div>

                            <div class="mb20"></div>

                            <button class="btn btn-sm btn-success mr5"><i class="fa fa-user"></i> Follow</button>
                            <button class="btn btn-sm btn-white"><i class="fa fa-envelope-o"></i> Message</button>
                        </div>
                    </div><!-- media -->


                    <div class="media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body">
                            <h3 class="follower-name">Venro Leonga</h3>
                            <div class="profile-location"><i class="fa fa-map-marker"></i> Paris, France</div>
                            <div class="profile-position"><i class="fa fa-briefcase"></i> UX Designer at <a href="#">ITCompany, Inc.</a></div>

                            <div class="mb20"></div>

                            <button class="btn btn-sm btn-success mr5"><i class="fa fa-user"></i> Follow</button>
                            <button class="btn btn-sm btn-white"><i class="fa fa-envelope-o"></i> Message</button>
                        </div>
                    </div><!-- media -->

                </div><!--follower-list -->

            </div>
            <div class="tab-pane" id="following">

                <div class="activity-list">

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Chris Anthemum</strong> liked a photos<br />
                            <small class="text-muted">Today at 12:30pm</small>

                            <ul class="uploadphoto-list">
                                <li><a href="images/photos/media5.png" data-rel="prettyPhoto"><?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?></a></li>
                                <li><a href="images/photos/media4.png" data-rel="prettyPhoto"><?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?></a></li>
                            </ul>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Ray Sin</strong> is now following to <strong>Chris Anthemum</strong>. <br />
                            <small class="text-muted">Yesterday at 1:30pm</small>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Frank Furter</strong> is now following to <strong>Ray Sin</strong>. <br />
                            <small class="text-muted">3 days ago at 1:30pm</small>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Chris Anthemum</strong> liked a photos<br />
                            <small class="text-muted">5 days ago at 12:30pm</small>

                            <ul class="uploadphoto-list">
                                <li><a href="images/photos/media6.png" data-rel="prettyPhoto"><?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?></a></li>
                                <li><a href="images/photos/media7.png" data-rel="prettyPhoto"><?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?></li>
                                <li><a href="images/photos/media2.png" data-rel="prettyPhoto"><?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?></a></li>
                            </ul>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Nusja Nawancali</strong> is now following to <strong>Zaham Sindilmaca</strong>. <br />
                            <small class="text-muted">December 25 at 1:30pm</small>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Frank Furter</strong> is now following to <strong>Zaham Sindilmaca</strong>. <br />
                            <small class="text-muted">December 24 at 1:30pm</small>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Nusja NawanCali</strong> posted a new blog. <br />
                            <small class="text-muted">December 23 at 3:18pm</small>

                            <div class="media blog-media">
                                <a class="pull-left" href="#">
                                    <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-title"><a href="#">Ut Enim Ad Minim Veniam</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat... <a href="#">Read more</a></p>
                                </div>
                            </div><!-- media -->

                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Mark Zonsion</strong> is now following to <strong>Weno Carasbong</strong>. <br />
                            <small class="text-muted">December 23 at 1:30pm</small>
                        </div>
                    </div><!-- media -->

                    <div class="media act-media">
                        <a class="pull-left" href="#">
                            <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                        </a>
                        <div class="media-body act-media-body">
                            <strong>Frank Furter</strong> is now following to <strong>Weno Carasbong</strong>. <br />
                            <small class="text-muted">December 20 at 4:30pm</small>
                        </div>
                    </div><!-- media -->

                </div><!-- activity-list -->

                <button class="btn btn-white btn-block">Show More</button>

            </div>
            <div class="tab-pane" id="events">
                <div class="events">
                    <h5 class="subtitle">Connect with Other People</h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="psearch" id="searchid" placeholder="Search for people" /> 
                            <div id="result" class="presults"> </div>
                        </div>
                        <div class="col-sm-6">&nbsp; &nbsp; <br />
                        </div>

                    </div>

                    <br />

                    <h5 class="subtitle">Friend Requests</h5>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                                </a>
                                <div class="media-body">
                                    <h3 class="follower-name">Zaham Sindilmaca</h3>
                                    <div class="profile-location"><i class="fa fa-map-marker"></i> Bangkok, Thailand</div>
                                    <div class="profile-position"><i class="fa fa-briefcase"></i> Java Developer at <a href="#">ITCompany, Inc.</a></div>

                                    <div class="mb20"></div>

                                    <button class="btn btn-sm btn-primary mr5"><i class="fa fa-check"></i> Following</button>
                                    <button class="btn btn-sm btn-white"><i class="fa fa-envelope-o"></i> Message</button>
                                </div>
                            </div><!-- media -->
                        </div>

                        <div class="col-sm-6">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <?php echo theme_image('user-4.png', array('width' => "28", 'class' => "img-circle img-inline userpic-32")); ?>
                                </a>
                                <div class="media-body">
                                    <h3 class="follower-name">Zaham Sindilmaca</h3>
                                    <div class="profile-location"><i class="fa fa-map-marker"></i> Bangkok, Thailand</div>
                                    <div class="profile-position"><i class="fa fa-briefcase"></i> Java Developer at <a href="#">ITCompany, Inc.</a></div>

                                    <div class="mb20"></div>

                                    <button class="btn btn-sm btn-primary mr5"><i class="fa fa-check"></i> Following</button>
                                    <button class="btn btn-sm btn-white"><i class="fa fa-envelope-o"></i> Message</button>
                                </div>
                            </div><!-- media -->
                        </div>

                    </div>

                </div><!-- events -->
            </div>
        </div><!-- tab-content -->

    </div><!-- col-sm-9 -->
</div>
<script type="text/javascript">
    $(function() {
        $("#searchid").keyup(function()
        {
            var searchid = $(this).val();
            var dataString = 'search=' + searchid;
            if (searchid != '')// && searchid.length > 2)
            {
                $.ajax({
                    type: "POST",
                    url: BASEPATH + "admin/users/search_around",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        data = $.parseJSON(html);
                        var content = data.content;

                        if (content == 'login') {
                            window.location = BASEPATH;
                            return false;
                        }
                        $("#result").html(content).show();
                    }
                });
            }
            return false;
        });

        jQuery("#result").on("click", function(e)
        {
            var $clicked = $(e.target);

            var $name = $clicked.find('.name').html();
            var lnk = $clicked.find('a').attr('href');

            var decoded = $("<div/>").html($name).text();
            $('#searchid').val(decoded);
            if (lnk)
            {
                window.location = lnk;
            }
        });
        jQuery(document).on("click", function(e)
        {
            var $clicked = $(e.target);
            if (!$clicked.hasClass("search")) {
                jQuery("#result").fadeOut();
            }
        });
        $('#searchid').click(function()
        {
            // jQuery("#result").fadeIn();
        });
    });
</script>
