<?php

namespace Anax\Vote;

/**
 * Model for Users.
 *
 */
class Vote extends \Anax\Database\Database
{


    public function voteTest($questions = false, $answers = false, $id_user){


        $votes = $this->findAll();


        $allowed_vote = true;

        foreach($questions as $question) {

            foreach ($votes as $vote) {
                if ($vote->id_post == $question->id_post AND $vote->id_user == $id_user) {
                    $allowed_vote = false;
                }
            }
        }
        if($id_user == null){
            $allowed_vote = false;
        }

    }

    public function allowedToVote($id_user, $id_post = false, $id_comment = false){

        $this->db->select("v.*")
            ->from("vote as v")
            ->where("v.id_user = ?")
            ->andWhere($id_post == false ? "v.id_comment = ?" :"v.id_post = ?");
        $id = $id_post == false ? $id_comment : $id_post;
        $result = $this->db->executeFetchAll([$id_user,$id]);

        if(empty($result)){
            return true;
        }
        return false;

    }
    public function vote_up($id, $vote_type, $id_user)
    {

        if ($this->isUserAllowedToVote($id_user, $id)) {
            if ($vote_type == "comment") {
                return $this->save(["id_user" => $id_user, "id_comment" => $id, "up_vote" => 1, "created" => gmdate('Y-m-d H:i:s')]);
            } else {
                return $this->save(["id_user" => $id_user, "id_post" => $id, "up_vote" => 1, "created" => gmdate('Y-m-d H:i:s')]);
            }
        }
        return false;
    }

    public function vote_down($id, $vote_type, $id_user)
    {
        if ($this->isUserAllowedToVote($id_user, $id)) {
            if ($vote_type == "comment") {
                return $this->save(["id_user" => $id_user, "id_comment" => $id, "down_vote" => 1, "created" => gmdate('Y-m-d H:i:s')]);
            } else {
                return $this->save(["id_user" => $id_user, "id_post" => $id, "down_vote" => 1, "created" => gmdate('Y-m-d H:i:s')]);
            }
        }
        return false;

    }

    public function isUserAllowedToVote($id_user, $id)
    {
        $votes = $this->findAll("vote");
        foreach ($votes as $vote) {
            if ($vote->id_user == $id_user and $vote->id_post == $id) {
                return false;
            }
            if ($vote->id_user == $id_user and $vote->id_comment == $id) {
                return false;
            }
        }
        return true;
    }

}