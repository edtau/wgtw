<div class="row">
    <div class="col-md-12">
        <a href="<?= $this->url->create("question/view/$id_question") ?>">Go back</a>

        <table class="table">
            <thead>
            <tr>
                <th>Answer</th>
                <th>Asked</th>
                <th>Name</th>
                <th>Gravatar</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($answer as $a):?>
                <tr>
                    <td><?=$a->content?></td>
                    <td><?=$a->created_post?></td>
                    <td><?=$a->name?></td>
                    <td><?=$a->email?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?=$content?>
    </div>
</div>
