<form action="/" method="POST">
    <input type="hidden" name="cl" value="chat" />
    <input type="hidden" name="fnc" value="AddMessage" />
    <input type="hidden" name="token" value="<?= Session::getInstance()->get('new_sess_token') ?>">

    <textarea name="message_text" placeholder="Write your message"></textarea>
    <input type="submit" value="Send" />
</form>
<?php
$this->_writeJs('(function($){'
        . '     $(".msg-form").on("submit", "form", function(e){'
        . '         e.preventDefault();'
        . '         $.ajax({'
        . '             url: "/",'
        . '             data: $(this).serializeArray(),'
        . '             dataType: "JSON",'
        . '             type: "POST",'
        . '             success: function(res){'
        . '                 document.location.href = document.location.href;'
        . '             }'
        . '         });'
        . '     });'
        . '})(jQuery)');
?>

