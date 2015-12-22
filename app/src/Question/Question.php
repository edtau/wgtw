<?php

namespace Anax\Question;

/**
 * Model for Users.
 *
 */
class Question extends \Anax\Database\Database
{
    public function findAllQuestions(){
        $this->db->select("
                p.id as id_post,
                q.id as id_question,
                u.id as id_user,
                q.title,
                q.solved,
                p.content,
                p.created as created_post,
                u.name,
                u.email,
                u.password,
                u.acronym,
                u.created as created_user,
                sum(v.up_vote) as up_vote,
                sum(v.down_vote) as down_vote,
                  sum(v.up_vote - v.down_vote) as score
                 ")
            ->from("post as p")
            ->join("question as q", "q.id_post = p.id")
            ->leftJoin("vote as v","v.id_post = p.id")
            ->join("user as u", "u.id = p.id_user")
            ->groupBy("p.id");
        $result = $this->db->executeFetchAll();
        return $result;

    }
    public function findAllQuestionsByIdUser($id_user){
        $this->db->select("
                p.id as id_post,
                q.id as id_question,
                u.id as id_user,
                q.title,
                q.solved,
                p.content,
                p.created as created_post,
                u.name,
                u.email,
                u.password,
                u.acronym,
                u.created as created_user,
                sum(v.up_vote) as up_vote,
                sum(v.down_vote) as down_vote,
                  sum(v.up_vote - v.down_vote) as score
                 ")
            ->from("post as p")
            ->join("question as q", "q.id_post = p.id")
            ->leftJoin("vote as v","v.id_post = p.id")
            ->join("user as u", "u.id = p.id_user")
            ->where("u.id = ?")
            ->groupBy("p.id");
        $result = $this->db->executeFetchAll([$id_user]);
        return $result;

    }
    public function findQuestion($id_question = false, $id_post = false){
            $this->db->select("
                p.id as id_post,
                q.id as id_question,
                u.id as id_user,
                q.title,
                q.solved,
                p.content,
                p.created as created_post,
                u.name,
                u.email,
                u.password,
                u.acronym,
                u.created as created_user,
                sum(v.up_vote) as up_vote,
                sum(v.down_vote) as down_vote,
                  sum(v.up_vote - v.down_vote) as score
                 ")
                ->from("post as p")
                ->join("question as q", "q.id_post = p.id")
                ->leftJoin("vote as v","v.id_post = p.id")
                ->join("user as u", "u.id = p.id_user")
                ->groupBy("p.id")
                ->where(($id_question) ? "q.id = ?" :"q.id_post = ?" );

            $id = ($id_question) ? $id_question : $id_post;
            $result = $this->db->executeFetchAll([$id]);
            return $result;
    }
    public function findLatestQuestions($limit){
        $this->db->select("
                p.id as id_post,
                q.id as id_question,
                u.id as id_user,
                q.title,
                q.solved,
                p.content,
                p.created as created_post,
                u.name,
                u.email,
                u.password,
                u.acronym,
                u.created as created_user,
                sum(v.up_vote) as up_vote,
                sum(v.down_vote) as down_vote,
                  sum(v.up_vote - v.down_vote) as score
                 ")
            ->from("post as p")
            ->join("question as q", "q.id_post = p.id")
            ->leftJoin("vote as v","v.id_post = p.id")
            ->join("user as u", "u.id = p.id_user")
            ->groupBy("p.id")
            ->orderBy("p.created desc")
            ->limit($limit);
        $result = $this->db->executeFetchAll();
        return $result;

    }
}