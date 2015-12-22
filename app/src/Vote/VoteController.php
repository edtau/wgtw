<?php
namespace Anax\Vote;

/**
 * A controller for users and admin related events.
 *
 */
class VoteController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;
    private $vote_type;
    private $id;

    public function initialize()
    {
        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);

        $this->vote = new \Anax\Vote\Vote();
        $this->vote->setDI($this->di);

        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);

    }
    public function testAction($post,$id){
        $id_user = $this->user->getId();

        if($post == "comment"){
            $result = $this->vote->allowedToVote($id_user, false,$id);
        } elseif($post == "post") {
            $result =  $this->vote->allowedToVote($id_user, $id);
        }
        var_dump($result);

    }

    public function upAction($post,$id){

        $id_user = $this->user->getId();
        $result = false;
         if($post == "comment"){
            $result =   $this->vote->save(["id_user" => $id_user, "id_comment" => $id, "up_vote" => 1, "created" => gmdate('Y-m-d H:i:s')]);
        } elseif($post == "post") {
            $result =    $this->vote->save(["id_user" => $id_user, "id_post" => $id, "up_vote" => 1, "created" => gmdate('Y-m-d H:i:s')]);
        }
        $this->redirectTo("question/list");
    }
    public function downAction($post,$id){
        $id_user = $this->user->getId();
        $result = false;
        if($post == "comment"){
           $result =  $this->vote->save(["id_user" => $id_user, "id_comment" => $id, "down_vote" => 1, "created" => gmdate('Y-m-d H:i:s')]);
        } elseif($post = "post") {
            $result ==    $this->vote->save(["id_user" => $id_user, "id_post" => $id, "down_vote" => 1, "created" => gmdate('Y-m-d H:i:s')]);
        }
          $this->redirectTo("question/list");

    }

}