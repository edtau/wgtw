<div class="row">

    <h1>Installation</h1>
    <div class="col-md-8">

        <?php foreach($output as $key => $value):?>
            <div class="alert alert-success" role="alert">
                <?=$value?>
            </div>
        <?php endforeach;?>
    </div>
    <div class="col-md-4">
        <h3>After Installation it is highly recommended to comment out the install controller
        for security reasons</h3>
        <ol>
            <li>Open folder app/arc/install</li>
            <li>Open file InstallController.php</li>
            <li>Comment out the file</li>
        </ol>
        <p>If you want to refresh the database to the original state uncomment the file and run the installation again.</p>
    </div>
</div>
