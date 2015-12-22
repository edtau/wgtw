<div class="container">
    <h1 class="text-center">Questions</h1>
    <hr/>
    <?php foreach($questions as $question) :?>

    <div class="row">

        <!-- Votes and score -->
        <div class="col-md-1">
            <ul class="list-unstyled">
                <li><span class="badge"><?=$question->score?></span></li>
                <li>Score </li>

                <?php foreach($answers as $answer) :?>
                    <?php if($answer->id_question == $question->id_question):?>
                            <?php $counter++; ?>
                    <?php endif;?>
                <?php endforeach;?>
                <li><span class="badge"><?=$counter?></span></li>
                <li>Answers</li>
                <?php $counter = 0;?>
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
                    <li><?=$tag->name?></li>
                <?php endif;?>
            <?php endforeach;?>
            </ul>
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
                <li> <a href="<?= $this->url->create("\"user/profile/$question->acronym") ?>">
                        <?= $this->di->textFilter->doFilter($question->name, 'shortcode, markdown'); ?></a>
                </li>
            </ul>
        </div>
    </div>
    <hr/>
    <?php endforeach;?>
</div>
