<article>
 <div class = "background">
      </div>
    <div class="content_article cab_article" id="cabinet_main">

<form name="addform" method="post" action="<?php echo URL_BASE."/cabinet/save/".$data['person'][0];?>" enctype="multipart/form-data">
    <div class="cab_profile row">
    <div class="cab_avatar" 
    style="background: url('<?php echo $avatar=URL_BASE.$data['person'][4];?>') no-repeat;
    background-size: cover;
    "></div>
    <div class="cab_info">
        <input type="text" class="cab_fio" name="login" placeholder="Логин" value="<?php echo $data['person'][1];?>" <?php if($data['settings']==0):?>readonly<?php endif;?>>
        <div class="cab_full row">
            <i id = "cab_icon" class="fas fa-envelope"></i>
            <input type="text" name="mail" value="<?php echo $data['person'][3];?>" <?php if($data['settings']==0):?>readonly<?php endif;?>>
        </div>

        <?php if($data['settings']!=0):?>

            <div class="cab_full row">
                <i id = "cab_icon" class="fas fa-eye" onclick="cab_vis(this,1)"></i>
                <p class="cab_pus">Пароль</p>
                <input type="text" name="password" class="cab_puss unvis" value="<?php echo $data['person'][2];?>" <?php if($data['settings']==0):?>readonly<?php endif;?>>
            </div>

        <div class="cab_full row">
            <i id = "cab_icon" class="fas fa-file-upload"></i>
            <label for="files" >Загрузить аватарку</label>
        </div>

        <div class="cab_full row">
            <i class="fas fa-times-circle cab_icon" style="display: none;" id="cross" onclick='cross()'></i>
            <input type="text" class="unvis" id="cab_file" readonly>
        <input id="files" class="unvis" type="file" name="avatar" onchange="file_name(id)">
        </div>

        <?php endif; ?>

    </div>
    <div class="cab_settings">
        <?php if($data['settings']==0):?>
        <a href="<?php echo URL_BASE."/cabinet/change/".$data['person'][0]?>"><div class="cab_full row">
                <i id = "cab_icon" class="fas fa-user-edit"></i>
            <p>Изменить профиль</p>
        </div>
        </a>
        <div class="cab_full row">
            <i id = "cab_icon" class="fas fa-eye" onclick="cab_vis(this,0)"></i>
            <p class="cab_pus">Пароль</p>
            <input type="text" name="password" class="cab_puss unvis" value="<?php echo $data['person'][2];?>" <?php if($data['settings']==0):?>readonly<?php endif;?>>
        </div>
        <?php else:?>
        <div class="cab_full row">
            <i id = "cab_icon" class="fas fa-save"></i>
            <input type="submit" name="submit" value="Сохранить изменения">
        </div>
        <a href="<?php echo URL_BASE."/cabinet/view/".$data['person'][0];?>"><div class="cab_full row">
                <i id = "cab_icon" class="fas fa-arrow-alt-circle-left"></i>
            <p>Отмена</p>
            </div></a>
        <?php endif;?>
    </div>
    </div>
    <?php if(isset($data['error'])):?>
        <div class="ent_atten center"><?php  echo $data['error'][1];?></div>
    <?php endif;?>
   <div>
            <p class="cab_his cab_fio">Последняя активность</p>
        <div class="cab_history">
           <input type="hidden" id="theme_flag">
        </div>
    </div>


</form>

</div>

</article>