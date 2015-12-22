<div class="row">

    <div class="col-md-6">
        <h3>Profile for <?=$user[0]->name?></h3>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Acronym</th>
                <th>email</th>
                <th>Registrered</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><img src="<?=get_gravatar($user[0]->email)?>" width="20"></td>
                <td><?=$user[0]->name?></td>
                <td><?=$user[0]->acronym?></td>
                <td><?=$user[0]->email?></td>
                <td><?=$user[0]->created?></td>
            </tr>
            </tbody>
        </table>
        <hr/>

        <h2>Rank</h2>

        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge"><?=$calculation["sum_vote"]?></span>
                Points votes
            </li>

            <li class="list-group-item">
                <span class="badge"><?=$calculation["number_comments"]?></span>
                Comments posted
            </li>

            <li class="list-group-item">
                <span class="badge"><?=$calculation["number_questions"]?></span>
                Questions posted
            </li>

            <li class="list-group-item">
                <span class="badge"><?=$calculation["number_answers"]?></span>
                Answers posted
            </li>
            <li class="list-group-item">
                <span class="badge"><?=$calculation["total_sum"]?></span>
                Rank
            </li>
        </ul>

    </div>
    <?php if($form != null):?>
        <div class="col-md-6">
            <h3>Edit profile</h3>
            <?=$form?>
        </div>
    <?php endif;?>
</div>




<div class="row">
    <h1>Posted questions</h1>
    <div class="col-md-8">
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Posted</th>
            <th>up_vote</th>
            <th>down_vote</th>
            <th>score</th>
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
                <td><a href="<?= $this->url->create("question/view/$question->title") ?>"><?= $question->title ?></a></td>
                <td><?=$question->created_post?></td>
                <td><?=$question->up_vote?></td>
                <td><?=$question->down_vote?></td>
                <td><?=$question->score?></td>
                <td><?=$answered?></td>
            </tr>
            <?php $answered = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'; ?>
        <?php endforeach;?>
        </tbody>
    </table>
    </div>
</div>
