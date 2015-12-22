 <div class="container">
    <?php foreach ($comments as $comment) : ?>

       <?php if($comment->id_user == $id_user):?>
       <?php $allowed_to_vote = false ?>
       <?php endif;?>
 
        <!-- Check if the user is allowed to vote -->
        <?php foreach($votes as $vote) :?>
             
            <?php if($vote->id_comment == $comment->id_comment AND $vote->id_user == $id_user OR $comment->id_user == $id_user):?>
                <?php $allowed_to_vote = false?>
            <?php endif;?>

        <?php endforeach;?>

        <!-- Print the comments to the right post -->

        <?php foreach ($posts as $post) : ?>

            <?php if ($post->id_post == $comment->id_post): ?>
                <div class="row">

                    <!-- Votes and score -->
                    <div class="col-md-12">

                        <small><?= $this->di->textFilter->doFilter($comment->content, 'shortcode, markdown'); ?></small>

                        <!-- if user is allowed to vote print vote tags -->
                        <ul class="list-inline">
                            <?php if ($allowed_to_vote): ?>
                                <li>
                                    <a href="<?= $this->url->create("vote/up/comment/$comment->id_comment") ?>"><span
                                            class="glyphicon  glyphicon glyphicon-menu-up" aria-hidden="true"></span></a>
                                </li>
                                <li>
                                    <a href="<?= $this->url->create("vote/up/comment/$comment->id_comment") ?>">
                                    <span class="glyphicon  glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
                                </li>
                            <?php endif; ?>
                            <?php $allowed_to_vote = true; ?>

                            <!-- Print score and info about user, time of comment posted -->
                            <li>Score <span class="badge"><?= $comment->score ?></span></li>
                            <li>Commented <?= $comment->comment_created ?></li>
                            <li>
                                <a href="<?= $this->url->create("user/profile/$comment->acronym") ?>"><?= $comment->name ?></a>
                            </li>
                        </ul>

                    <!-- End column -->
                    </div>
                    <!-- End row -->
                </div>

            <?php endif; ?>
        <?php endforeach; ?>

    <?php endforeach; ?>
<!-- End container -->
</div>
