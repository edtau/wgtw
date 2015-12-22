<nav class="navbar navbar-default navbar-static-top">
    <div class="container">

        <ul class="nav navbar-nav navbar-left">
            <li><a href="<?=$this->di->get('url')->create('home')?>">Home</a></li>
            <li><a href="<?=$this->di->get('url')->create('question/list')?>">Questions</a></li>

            <li><a href="<?=$this->di->get('url')->create('user')?>">Users</a></li>
       <li><a href="<?=$this->di->get('url')->create('tag')?>">Tags</a></li>
            <?php if($logged_in == true):?>
         
                <li><a href="<?=$this->di->get('url')->create('question/ask')?>">Ask Question</a></li>

                <li><a href="<?=$this->di->get('url')->create('user/my-profile/')?>">My Profile <?=$acronym?></a></li>
            <?php else:?>

                <li><a href="<?=$this->di->get('url')->create('user/register')?>">Registration</a></li>
                <li><a href="<?=$this->di->get('url')->create('user/login')?>">Login</a></li>

            <?php endif;?>
            <li><a href="<?=$this->di->get('url')->create('about')?>">About us</a></li>
            <?php if($logged_in == true):?>
                <li><a href="<?=$this->di->get('url')->create('user/logout')?>">logout</a></li>
            <?php endif;?>



        </ul>
    </div>
</nav>
