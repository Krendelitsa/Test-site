<header>
    <div id="alltop"></div>
    <div class="nav_menu">
        <div class="nav_logo nav_edge">
            <a href="<?php echo URL_BASE;?>/main" class="logo_a"><img src="<?php echo URL_BASE;?>/pic/web_logo/biglogo.svg"> 
            <p>TeleXlam</p></a>
        </div>

        <div class="nav_setting nav_edge">
            <?php if(isset($_SESSION['RULES'])&&($_SESSION['RULES']!="")):?>
                <a href="<?php echo URL_BASE;?>/cabinet/view/" class="nav_one">
                    <i class="fas fa-user"></i>
                </a>
            <?php endif;?>
                <?php if(isset($_SESSION['RULES'])&&($_SESSION['RULES']!="")):?>
                    <a href="<?php echo URL_BASE;?>/enter/exit" class="nav_one">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                <?php else:?>
                    <a href="<?php echo URL_BASE;?>/enter" class="nav_one">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                <?php endif;?>
        </div>
    </div>
</header>