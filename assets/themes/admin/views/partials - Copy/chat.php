<!-- start: Chat Section -->
<div id="chat" class="fixed">

    <div class="chat-inner">

        <h2 class="chat-header">
            <a href="#" class="chat-close" data-toggle="chat">
                <i class="fa-plus-circle rotate-45deg"></i>
            </a>

            Chat
            <span class="badge badge-success is-hidden">0</span>
        </h2>

        <div class="chat-group">
            <strong>Work</strong>
            <?php
            foreach ($this->contacts as $cc)
            {
                ?>
                <a href="#" onclick="loadChat(1, '<?php echo $cc->email;?>', 1)"><span class="user-status"></span> <em><?php echo $cc->first_name . ' ' . $cc->last_name ?></em></a>
<?php } ?>

        </div>

    </div>

    <!-- conversation Window -->
    <div class="chat-conversation">

        <div class="conversation-header">
            <a href="#" class="conversation-close">
                &times;
            </a>

            <span class="user-status is-online"></span>
            <span class="display-name">Arlind Nushi</span> 
            <small>Online</small>
        </div>

        <ul class="conversation-body">	

            <li>
                <span class="user">Brandon S. Young</span>
                <span class="time">09:26</span>
                <p>Whohoo!</p>
            </li>

        </ul>

        <div class="chat-textarea">
            <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
        </div>

    </div>

</div>
<!-- end: Chat Section -->

<script type="text/javascript">
    //  open chat conversation box
    jQuery(document).ready(function($)
    {
        var $chat_conversation = $(".chat-conversation");

        $(".chat-groupppppp a").on('click', function(ev)
        {
            ev.preventDefault();

            $chat_conversation.toggleClass('is-open');

            $(".chat-conversation textarea").trigger('autosize.resize').focus();
        });

        $(".conversation-close").on('click', function(ev)
        {
            ev.preventDefault();
            $chat_conversation.removeClass('is-open');
        });
    });
</script>