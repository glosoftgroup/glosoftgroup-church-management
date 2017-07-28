<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 

        <title><?php echo $template['title']; ?></title>
        <?php echo theme_css('jquery-ui-1.10.3.custom.min.css', array('id' => 'style-resource-1')); ?>
        <?php echo theme_css('font-icons/entypo/css/entypo.css', array('id' => 'style-resource-2')); ?>
        <?php echo theme_css('font-icons/entypo/css/animation.css', array('id' => 'style-resource-3')); ?>

        <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"  id="style-resource-4">-->
        <?php echo theme_css('neon.css'); ?>
        <?php echo theme_css('custom.css', array('id' => 'style-resource-6')); ?>

        <?php echo theme_js('jquery-1.10.2.min.js'); ?>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<?php echo theme_js('jquery.sparkline.min.js'); ?>
        <!-- TS1387506872: Neon - Responsive Admin Template created by Laborator -->
    </head>
    <body class="page-body page-fade">

        <div class="page-container">	

           <?php echo $template['partials']['sidebar']; ?>	
            <div class="main-content">

                <?php echo $template['partials']['top']; ?>	

                <hr />
 
                 <?php
                            if ($this->session->flashdata('warning'))
                            {
                                ?>
                                <div class="alert">
                                    <button type="button" class="close" data-dismiss="alert">                                    
                                        <i class="icon-remove"></i>                                </button>
                                    <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
                                </div>
                            <?php } ?>
                            <?php
                            if ($this->session->flashdata('success'))
                            {
                                ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">  <i class="icon-remove"></i>                                </button>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?>
                            <?php
                            if ($this->session->flashdata('info'))
                            {
                                ?>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">                                    
                                        <i class="icon-remove"></i>                                </button>
                                    <?php echo $this->session->flashdata('info'); ?>
                                </div>
                            <?php } ?>
                            <?php
                            if ($this->session->flashdata('message'))
                            {
                                $message = $this->session->flashdata('message');
                                $str = is_array($message) ? $message['text'] : $message;
                                ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">                                   
                                        <i class="icon-remove"></i>                                </button>
                                    <?php echo $str; //$this->session->flashdata('message'); ?>
                                </div>
                            <?php } ?>
                            <?php
                            if ($this->session->flashdata('error'))
                            {
                                ?>
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">                                    
                                        <i class="icon-remove"></i>      </button>
                                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php } ?>

                            <div class="space-6"></div>

                            <?php echo $template['body']; ?>
                <!-- Footer -->
                <footer class="main">

                    <div class="pull-right">
                         
                    </div>

                       &copy; <?php echo date('Y');?>  

                </footer>	</div>


            <div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">

                <div class="chat-inner">


                    <h2 class="chat-header">
                        <a href="#" class="chat-close" data-animate="1"><i class="entypo-cancel"></i></a>

                        <i class="entypo-users"></i>
                        Chat
                        <span class="badge badge-success is-hidden">0</span>
                    </h2>


                    <div class="chat-group" id="group-1">
                        <strong>Favorites</strong>

                        <a href="#" id="sample-user-123" data-conversation-history="#sample_history"><span class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
                        <a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
                        <a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
                        <a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
                        <a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
                    </div>


                    <div class="chat-group" id="group-2">
                        <strong>Work</strong>

                        <a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
                        <a href="#" data-conversation-history="#sample_history_2"><span class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
                        <a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
                    </div>


                    <div class="chat-group" id="group-3">
                        <strong>Social</strong>

                        <a href="#"><span class="user-status is-busy"></span> <em>Velma G. Pearson</em></a>
                        <a href="#"><span class="user-status is-offline"></span> <em>Margaret R. Dedmon</em></a>
                        <a href="#"><span class="user-status is-online"></span> <em>Kathleen M. Canales</em></a>
                        <a href="#"><span class="user-status is-offline"></span> <em>Tracy J. Rodriguez</em></a>
                    </div>

                </div>

                <!-- conversation template -->
                <div class="chat-conversation">

                    <div class="conversation-header">
                        <a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>

                        <span class="user-status"></span>
                        <span class="display-name"></span> 
                        <small></small>
                    </div>

                    <ul class="conversation-body">	
                    </ul>

                    <div class="chat-textarea">
                        <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
                    </div>

                </div>

            </div>


            <!-- Chat Histories -->
            <ul class="chat-history" id="sample_history">
                <li>
                    <span class="user">Art Ramadani</span>
                    <p>Are you here?</p>
                    <span class="time">09:00</span>
                </li>

                <li class="opponent">
                    <span class="user">Catherine J. Watkins</span>
                    <p>This message is pre-queued.</p>
                    <span class="time">09:25</span>
                </li>

                <li class="opponent">
                    <span class="user">Catherine J. Watkins</span>
                    <p>Whohoo!</p>
                    <span class="time">09:26</span>
                </li>

                <li class="opponent unread">
                    <span class="user">Catherine J. Watkins</span>
                    <p>Do you like it?</p>
                    <span class="time">09:27</span>
                </li>
            </ul>




            <!-- Chat Histories -->
            <ul class="chat-history" id="sample_history_2">
                <li class="opponent unread">
                    <span class="user">Daniel A. Pena</span>
                    <p>I am going out.</p>
                    <span class="time">08:21</span>
                </li>

                <li class="opponent unread">
                    <span class="user">Daniel A. Pena</span>
                    <p>Call me when you see this message.</p>
                    <span class="time">08:27</span>
                </li>
            </ul></div>

        <!-- Sample Modal (Default skin) -->
        <div class="modal fade" id="sample-modal-dialog-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Widget Options - Default Modal</h4>
                    </div>

                    <div class="modal-body">
                        <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-blue">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sample Modal (Skin inverted) -->
        <div class="modal invert fade" id="sample-modal-dialog-2">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Widget Options - Inverted Skin Modal</h4>
                    </div>

                    <div class="modal-body">
                        <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-blue">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sample Modal (Skin gray) -->
        <div class="modal gray fade" id="sample-modal-dialog-3">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Widget Options - Gray Skin Modal</h4>
                    </div>

                    <div class="modal-body">
                        <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-blue">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
 
         <?php echo theme_css("jquery-jvectormap-1.2.2.css"); ?>
         <?php echo theme_css("/rickshaw.min.css"); ?>
         <?php echo theme_js("gsap/main-gsap.js"); ?>
        <?php echo theme_js("jquery-ui/js/jquery-ui-1.10.3.js"); ?>
        <?php echo theme_js('bootstrap.min.js'); ?>
        <?php echo theme_js('joinable.js'); ?>
        <?php echo theme_js('resizeable.js'); ?>
        <?php echo theme_js('neon-api.js'); ?>
        <?php echo theme_js('jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>
        <?php echo theme_js('jvectormap/jquery-jvectormap-europe-merc-en.js'); ?>
        
        <?php //echo theme_js('rickshaw/vendor/d3.v3.js'); ?>
        <?php //echo theme_js('rickshaw/rickshaw.min.js'); ?>
        <?php //echo theme_js('raphael-min.js'); ?>
        <?php //echo theme_js('morris.min.js'); ?>
        <?php //echo theme_js('toastr.js'); ?>
        <?php echo theme_js('neon-chat.js'); ?>
        <?php   echo theme_js('neon-custom.js'); ?>
        <?php echo theme_js('neon-demo.js'); ?>
        
         
    </body>
</html>