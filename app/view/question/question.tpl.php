
<h3><?=$title?><small><a href="<?= $this->url->create("question/view/".$question[0]->id_question) ?>"> Go back</a></small></h3>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Question</th>
                <th>Asked</th>
                <th>Asked by</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($question as $q):?>
                <tr>

                    <td><a href="<?= $this->url->create("question/view/$q->id_question") ?>"><?= $q->title ?></a></td>
                    <td><?=$q->content?></td>
                    <td><?=$q->created_post?></td>
                    <td><a href="<?= $this->url->create("user/profile/$q->acronym") ?>"><?= $q->name ?></a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
       <?=$form?>
    </div>
</div>
