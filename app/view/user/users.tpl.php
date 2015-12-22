<div class="container">
  <h1 class="text-center">Users</h1>
  <hr/>
  <div class="row">
    <div class="col-md-12">

      <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Joined</th>
            <th>Rank</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($users as $user):?>
            <tr>
              <td><img src="<?=get_gravatar($user->email)?>" width="20"></td>
              <td><a href="<?= $this->url->create("user/profile/$user->acronym") ?>"><?=$user->name?></a></td>
              <td><?=$user->created?></td>
              <?php foreach($rank as $key => $value):?>

                  <?php if($value["id_user"] == $user->id):?>
                    <td><span class="badge"><?=$value["total_sum"]?></span></td>
                  <?php endif;?>
               <?php endforeach;?>

            </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>