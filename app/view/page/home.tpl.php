 <div class="jumbotron">
        <div class="container">
            <h1>Welcome to fruity questions! A place where you can ask and answer questions about fruit!</h1>
        </div>
    </div>
<div class="container">
   
     <div class="row">
        <div class="col-md-8">
            <h3>Latest questions</h3>
            <?php foreach($questions as $question):?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-9">
                            <a href=" <?= $this->url->create("post/question/$question->id_post") ?>">
                                <?= $this->di->textFilter->doFilter($question->title, 'shortcode, markdown'); ?>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-inline">
                                <?php foreach($tags as $tag):?>
                                    <?php if($tag->id_question == $question->id_question):?>
                                        <li>
                                            <a href=" <?= $this->url->create("post/tag/$tag->name") ?>">
                                                <?= $this->di->textFilter->doFilter($tag->name, 'shortcode, markdown'); ?>
                                            </a>
                                        </li>
                                    <?php endif;?>
                                <?php endforeach;?>

                                <li>Posted <?=$question->created_post?> Asked by
                                </li>
                                <li>
                                    <a href=" <?= $this->url->create("post/tag/$question->acronym") ?>">
                                        <?= $this->di->textFilter->doFilter($question->name, 'shortcode, markdown'); ?>
                                    </a>
                                </li>
                                <li
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>


        <div class="col-md-4">
            <h3>Most popular tags</h3>
            <?php foreach($popularTags as $pop_tags):?>
                <ul class="list-inline">

                    <li><span class="badge"><?=$pop_tags->total_tags?></span></li>
                    <li><a href=" <?= $this->url->create("post/tag/$pop_tags->name") ?>">
                            <?= $this->di->textFilter->doFilter($pop_tags->name, 'shortcode, markdown'); ?>
                        </a></li>
                </ul>
            <?php endforeach;?>

            <h3>Most Active user</h3>
            <?=$most_active_user[0]->acronym?>
            <img  src=" <?= get_gravatar($most_active_user[0]->email) ?>" alt="gravatar" width="20">
        </div>
    </div>
</div>