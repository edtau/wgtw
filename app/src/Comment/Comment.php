<?php

namespace Anax\Comment;

/**
 * Model for Users.
 *
 */
class Comment extends \Anax\Database\Database
{


    public function findAllComments(){

        $this->db->select("
            c.id as id_comment,
            c.id_post as id_post,
            c.created as comment_created,
            c.content,
            u.name,
            u.email,
            u.acronym,
            sum(v.up_vote) as up_vote,
            sum(v.down_vote) as down,
            sum(v.up_vote - v.down_vote) as score,
            u.id as id_user,
            u.email,
            u.password,
            u.acronym,
            u.created as created_user")
            ->from("comment as c")
            ->leftJoin("vote as v","v.id_comment = c.id")
            ->join("user as u", "u.id = c.id_user")
            ->groupBy("c.id");
        $result = $this->db->executeFetchAll();
        return $result;

    }
    public function findAllCommentsByIdUser($id_user){

        $this->db->select("
            c.id as id_comment,
            c.id_post as id_post,
            c.created as comment_created,
            c.content,
            u.name,
            u.email,
            u.acronym,
            sum(v.up_vote) as up_vote,
            sum(v.down_vote) as down,
            sum(v.up_vote - v.down_vote) as score,
            u.email,
             u.id as id_user,
            u.password,
            u.acronym,
            u.created as created_user")
            ->from("comment as c")
            ->leftJoin("vote as v","v.id_comment = c.id")
            ->join("user as u", "u.id = c.id_user")
            ->where("u.id = ?")
            ->groupBy("c.id");
        $result = $this->db->executeFetchAll([$id_user]);
        return $result;

    }
}