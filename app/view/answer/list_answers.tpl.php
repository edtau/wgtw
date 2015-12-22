<div class="container">
    <h1 class="text-center">Answers</h1>
    <hr/>

    <?php foreach($answers as $answer) :?>

        <?php foreach($votes as $vote) :?>
            <?php if($vote->id_post == $answer->id_post AND $vote->id_user == $id_user OR $answer->id_user == $id_user):?>
                <?php $allowed_to_vote = false?>
                <?php endif;?>

        <?php endforeach;?>
    <div class="row">

        <!-- Votes and score -->
        <div class="col-md-1">
            <ul class="list-unstyled">

                <?php if($allowed_to_vote):?>


                <li><a  href="<?= $this->url->create("vote/up/post/$answer->id_post") ?>"  ><span class="glyphicon  glyphicon glyphicon-menu-up" aria-hidden="true"></span></a></li>
                <li><a  href="<?= $this->url->create("vote/down/post/$answer->id_post") ?>"><span class="glyphicon  glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></li>
                <?php endif;?>
                <?php $allowed_to_vote = true; ?>
                <li><span class="badge"> <?=$answer->score == null ? 0 : $answer->score?></span></li>
                <li>Score </li>
            </ul>
        </div>

        <!-- Answer -->
        <div class="col-md-7">
            <small><?= $this->di->textFilter->doFilter($answer->content, 'shortcode, markdown'); ?></small>
            <ul class="list-inline">
                <li>Answered <?=$answer->created_post?></li>
                <li> <a href="<?= $this->url->create("user/profile/$answer->acronym") ?>">
                        <img  src=" <?= get_gravatar($answer->email) ?>" alt="gravatar" width="20"></a>
                </li>
                <li> <a href="<?= $this->url->create("user/profile/$answer->acronym") ?>">
                        <?= $this->di->textFilter->doFilter($answer->name, 'shortcode, markdown'); ?></a>
                </li>
            </ul>
            <ul class="list-inline">
                <li><a  href="<?= $this->url->create("comment/answer/$answer->id_post")?>">Comment</a></li>
            </ul>
        </div>
        <!-- User information -->
    </div>
    <hr/>
<?php endforeach;?>
</div>

