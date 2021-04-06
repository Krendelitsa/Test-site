<article >
      <div class = "background">
      </div>
    <div class="content_article mail_art mail_main">
    <div class="mail_search">
      <?php switch($data['title']){
        case 'chat': echo "<p id=\"chats_main\">Чаты телехлама</p>";break;
        case 'search': echo " <p id=\"search_main\">Поиск телехлама</p>";break;
      }?>
      <div class="mail_right">
        <a  href="<?php echo URL_BASE;?>/main/search" class="list_a">
            <i  class="fas fa-search"></i>
        </a>
      <?php switch($data['title']){
        case 'chat': 
              echo "<a  href=\"".URL_BASE."/theme/addlog\" class=\"list_a\">
                      <i   class=\"fas fa-plus-circle\"></i>
                    </a>";break;
        case 'search': 
              echo "<a  href=\"".URL_BASE."/main\" class=\"list_a\">
                      <i   class=\"fas fa-arrow-alt-circle-left\"></i>
                    </a>";break;
      }?>

        <br>
      </div>
    </div>
   <div class="mail_all">
       <hr id="hr_id">
   </div>
    </div>
</article>