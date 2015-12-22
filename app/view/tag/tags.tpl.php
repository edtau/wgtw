<div class="container">
    <h1 class="text-center">Tags</h1>
    <hr/>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>Tag</th>
                <th>Description</th>
                <th>Created</th>
                <th>Created by</th>
            <tr>
            </thead>
            <tbody>
            <?php foreach ($tags as $tag): ?>
                <tr>
                    <td><a href="<?= $this->url->create("tag/list-questions/$tag->name") ?>"><?= $tag->name ?></a></td>
                    <td><?= $tag->description ?></td>
                    <td><?= $tag->tag_created ?></td>
                    <td><a href="<?= $this->url->create("user/profile/$tag->acronym") ?>"><?= $tag->user_name ?></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
