<article>
<div class="enter_form">
<div class = "background">
</div>
<div class="enter content_article">
    <form method="post" action="<?php echo URL_BASE;?>/enter/action">
        <h1 class = "auth_header">Вход</h1>
        <div class="ent_field">
            <label class="ent_text">Логин</label><br>
            <input class="ent_ent" type="text" name="login" placeholder="Пользователь">
        </div>
        <div class="ent_field">
            <label class="ent_text">Пароль</label><br>
            <input class="ent_ent" type="password" name="password" placeholder="Пароль">
        </div>
        <?php if($data['mode']=='reg'):?>
        <div class="ent_field">
            <label class="ent_text">Повторите пароль</label><br>
            <input class="ent_ent" type="password" name="pass_repeat" placeholder="Повторите пароль">
        </div>
        <div class="ent_field">
            <label class="ent_text">Почта</label><br>
            <input class="ent_ent" type="text" name="email" placeholder="Почта">
        </div>
        <?php endif;?>

        <?php if(isset($data['error'])):?>
        <div class=" ent_field ent_atten"><?php echo $data['error'];?></div>
        <?php endif;?>
        <div class="ent_field ent_butt_stock">
            <?php if($data['mode']!='reg'):?>
                <input type="submit" class="ent_butt" name="enter" value="Продолжить">
                <a href="<?php echo URL_BASE;?>/enter/index/reg"><input class="ent_butt" type="button" value="Регистрация"></a>
            <?php else:?>
                <a href="<?php echo URL_BASE;?>/enter/index/ent"><input class="ent_butt" type="button" value="Войти"></a>
                <input type="submit" class="ent_butt" name="register" value="Продолжить">
            <?php endif;?>
        </div>

    </form>
</div>
</div>
</article>





