<article >
    <div class = "background">
    </div>
<div class="content_article mail_art">
    <div class="mail_top">
      <input type="hidden" name="theme" value="<?php echo $data['theme'][0]?>">
      <div class="row" style="align-items: center;">
            <img src="<?php echo URL_BASE.$data['theme'][3];?>" class="mail_photo" id="avatar">
                <div class="row mail_hat">
                    <div>
                        <input type="text" name="chat_name" placeholder="Вы создали чат. Как назовем?" value="<?php echo $data['theme'][2];?>">
                            <div class="cab_full row">
                                <i id = "cab_icon" class="fas fa-file-upload"></i>
                                <label for="files" >Загрузить аватарку</label>
                            </div>
                                    <div class="cab_full row">
                                <i class="fas fa-times-circle cab_icon" style="display: none;" id="cross" onclick='cross()'></i>
                                <input type="text" class="unvis" id="cab_file" readonly>
                                <input id="files" class="unvis" type="file" name="avatar" onchange="file_name(id)">
                            </div>
                    </div>
                </div>
              </div>
                <div class="mail_right">
                  <a href="#" id="saveTheme">
                      <i class="fas fa-save" aria-hidden="true"></i>
                 </a>
                  <a href="<?php echo URL_BASE;?>/main">
                   <i class="fas fa-arrow-alt-circle-left" aria-hidden="true"></i>
                  </a>
              </div>
    </div>


    <div class="mail_all">
        <hr>
        <button id="inchat" class="selected">В чате <?php echo $data['theme'][5];?> человек</button>
        <button id="outchat">Остальные</button>
        <div class="mail_list">
        <?php for($i=0;$i<count($data['list']);$i++):?>
                   <div class="mail_dialog">
                       <img src="<?php echo URL_BASE."/".$data['list'][$i][4];?>" class="mail_photo">
                       <div>
                           <div class="row mail_hat">
                               <p><?php echo $data['list'][$i][1]?></p>
                               <input type="hidden" name="id" value="<?php echo $data['list'][$i][0]?>">
                               <div class="mail_right">
                               <?php

                               switch($data['list'][$i][9]){
                                  case '1': echo "<a href=\"#\"> <i class=\"fas fa-spinner\"></i></a>";break;
                                  case '2': echo "<a href=\"#\">
                                    <i class=\"fas fa-user\"></i>
                                    </a><a onclick=\"updateInList(".$data['list'][$i][0].",1)\">
                                    <i class=\"fas fa-thumbs-up\"></i>
                                    </a>";break;
                                  case '3': echo "<a href=\"#\">
                                            <i class=\"fas fas fa-crown\"></i>
                                          </a>
                                          <a onclick=\"updateInList(".$data['list'][$i][0].",2)\">
                                            <i class=\"fas fa-thumbs-down\"></i>
                                          </a>";break;
                                  case '4': echo "<a href=\"#\">
                                            <i class=\"fas fa-pen-fancy\"></i>
                                          </a>";break;
                };?>
                <a href="#"><i class="fas fa-times-circle"></i></a>
                               </div>
                           </div>
                       </div>
                   </div>
        <?php endfor;?>
        <hr id="end_id">
      </div>
    </div>
</div>
</article>