<div class="container">
    <div class="jumbotron">
  <div class="container">
    <h1>Welcome to fruity questions! A place where you can ask and answer questions about fruit!</h1>
  </div>
</div>
<div class="row">

    <div class="col-md-8">
        <h1>Latest questions</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Posted</th>
                <th>Votes up</th>
                <th>Votes down</th>
                <th>Score</th>
                <th>Answered</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($questions as $question):?>
                <?php foreach($answers as $answer):?>
                    <?php if($answer->id_question == $question->id_question):?>
                        <?php $answered = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>'; ?>
                    <?php endif;?>
                <?php endforeach;?>

                <tr>
                    <td><a href="<?= $this->url->create("question/view/$question->id_question") ?>"><?= $question->title ?></a></td>
                    <td><?=$question->created_post?></td>
                    <td><?=$question->up_vote == NULL ? '<span class="badge">0</span>' : "<span class='badge'>$question->up_vote</span>"  ?></td>
                    <td><?=$question->down_vote == NULL ? '<span class="badge">0</span>' : "<span class='badge'>$question->down_vote</span>"  ?></td>
                    <td><?=$question->score == NULL ? '<span class="badge">0</span>' : "<span class='badge'>$question->score</span>"  ?></td>

                    <td><?=$answered?></td>
                </tr>
                <?php $answered = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'; ?>
            <?php endforeach;?>
            </tbody>
        </table>

    </div>

<div class="col-md-4">
    <h1>Most used tags</h1>
        <ul class="list-group">
            <?php foreach($most_popular_tags as $tags):?>
            <li class="list-group-item">
                <span class="badge">Times used <?=$tags->number_of_tags?></span>

                <a href="<?= $this->url->create("tag/list-questions/$tags->name") ?>"><?= $tags->name ?></a>
            </li>
            <?php endforeach;?>
        </ul>

    <h1>Most active users</h1>
    <ul class="list-group">
        <?php foreach($rank as $key => $value):?>
            <?php foreach($users as $user):?>

                <?php if($value["id_user"] == $user->id):?>

                    <li class="list-group-item">
                        <span class="badge">Rank <?=$value["total_sum"]?></span>
                        <img src="<?=get_gravatar($user->email)?>" width="20">
                        <a href="<?= $this->url->create("user/profile/$user->acronym") ?>"><?= $user->name ?></a>
                    </li>


                <?php endif;?>
            <?php endforeach;?>
        <?php endforeach;?>
    </ul>

    </div>
</div>
</div>
