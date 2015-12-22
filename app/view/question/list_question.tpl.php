<div class="container">
    <h1 class="text-center">Questions</h1>
    <hr/>

    <?php foreach($questions as $question) :?>

        <?php foreach($votes as $vote) :?>
            <?php if($vote->id_post == $question->id_post AND $vote->id_user == $id_user OR $question->id_user == $id_user ):?>
                <?php $allowed_to_vote = false?>
            <?php endif;?>

        <?php endforeach;?>
    <div class="row">

            <!-- Votes and score -->
            <div class="col-md-1">
                <ul class="list-unstyled">
                    <?php if($question->id_user  != $id_user AND $allowed_to_vote):?>

                    <li><a  href="<?= $this->url->create("vote/up/post/$question->id_post") ?>">
                            <span class="glyphicon  glyphicon glyphicon-menu-up" aria-hidden="true"></span></a></li>
                    <li><a  href="<?= $this->url->create("vote/down/post/$question->id_post") ?>">
                            <span class="glyphicon  glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></li>

                    <?php endif;?>
                    <?php $allowed_to_vote = true; ?>
                    <li><span class="badge"><?=$question->score == null ? 0 :    $question->score?></span></li>
                    <li>Score </li>
                </ul>
            </div>

            <!-- Question -->
            <div class="col-md-7">
                <h5>
                    <a href="<?= $this->url->create("question/view/$question->id_question") ?>">
                        <?= $this->di->textFilter->doFilter($question->title, 'shortcode, markdown'); ?></a>
                </h5>

                <small><?= $this->di->textFilter->doFilter($question->content, 'shortcode, markdown'); ?></small>

                <ul class="list-inline">
                    <?php foreach($tags as $tag) :?>
                        <?php if($tag->id_question == $question->id_question):?>
                            <li><a  href="<?= $this->url->create("tag/list-questions/$tag->name")?>"><?=$tag->name?></a></li>

                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
                <?php if($question->solved  == false):?>
                <ul class="list-inline">
                    <li><a  href="<?= $this->url->create("comment/question/$question->id_post")?>">Comment</a></li>
                    <li><a href="<?= $this->url->create("answer/write/$question->id_question") ?>">Write answer</a></li>
                </ul>
                <?php endif;?>
            </div>

            <!-- User information -->
            <div class="col-md-4">
                <ul class="list-inline">
                    <li>Asked <?=$question->created_post?></li>
                </ul>
                <ul class="list-inline">
                    <li> <a href="<?= $this->url->create("user/profile/$question->acronym") ?>">
                            <img  src=" <?= get_gravatar($question->email) ?>" alt="gravatar" width="20"></a>
                    </li>
                    <li> <a href="<?= $this->url->create("user/profile/$question->acronym") ?>">
                            <?= $this->di->textFilter->doFilter($question->name, 'shortcode, markdown'); ?></a>
                    </li>
                    <?php if($question->solved == 1):?>
                        <li>Solved</li>
                    <?php elseif($question->id_user == $id_user):?>
                        <li><a href="<?= $this->url->create("question/set-to-solved/$question->id_question") ?>">Set to solved</a></li>
                    <?php else:?>
                        <li>Not Solved</li>
                    <?php endif;?>
                </ul>
            </div>
        </div>

        <div class="row">
            <?php foreach($answers as $answer) :?>
                <?php if($answer->id_question == $question->id_question):?>
                    <?php $counter++; ?>
                <?php endif;?>
            <?php endforeach;?>
            <blockquote>
                <p>Answers <span class="badge"><?=$counter?></span></p>
            </blockquote>
        </div>
        <hr/>
    <?php endforeach;?>
</div>
