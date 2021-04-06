<article >
    <div class = "background">
    </div>
<div class="content_article mail_art">
    <div class="mail_top"> 
        <p id="dialog_main">Сообщения</p>
            <a href="<?php echo URL_BASE;?>/main">
               <i class="fas fa-arrow-alt-circle-left" aria-hidden="true"></i>
            </a>
    </div>

    <div class="mail_all">
    <hr id="hr_id">
    </div>
        <div class="mail_send">
            <input type="hidden" name="idm" value="<?php echo $data['idm'];?>">
            <textarea type="text" class="mail_ss" name="message" placeholder="Сообщение"></textarea>
            <input type="submit" id="sendMess" class="add_button mail_small" value="Отправить сообщение">
    </div>
</div>
</article>