<?php

namespace Anax\Answer;

/**
 * Model for Answers.
 *
 */
class Answer extends \Anax\Database\Database
{
    /**
    *  Method to retrive all answers joins votes and users
     * @return mixed
     */
    public function findAllAnswers(){
        $this->db->select("
            a.id as id_answer,
            a.id_question,
            p.id as id_post,
            u.name,
            p.created as created_post,
            p.content,
            u.id as id_user,
            u.email,
            u.password,
            u.acronym,
            u.created as created_user,
            sum(v.up_vote) as up_vote,
            sum(v.down_vote) as down_vote,
            sum(v.up_vote - v.down_vote) as score")
            ->from("post as p")
            ->join("answer as a", "a.id_post = p.id")
            ->leftJoin("vote as v","v.id_post = p.id")
            ->join("user as u", "u.id = p.id_user")
            ->groupBy("p.id");
        $result = $this->db->executeFetchAll();
        return $result;
    }
    /**
     * Method to retrive all answers by id for the user
     * @param $id_user
     * @return mixed
     */
    public function findAllAnswersByIdUser($id_user){
        $this->db->select("
            a.id as id_answer,
            a.id_question,
            p.id as id_post,
            u.name,
            p.created as created_post,
            p.content,
            u.id as id_user,
            u.email,
            u.password,
            u.acronym,
            u.created as created_user,
            sum(v.up_vote) as up_vote,
            sum(v.down_vote) as down_vote,
            sum(v.up_vote - v.down_vote) as score")
            ->from("post as p")
            ->join("answer as a", "a.id_post = p.id")
            ->leftJoin("vote as v","v.id_post = p.id")
            ->join("user as u", "u.id = p.id_user")
            ->where("u.id = ?")
            ->groupBy("p.id");
        $result = $this->db->executeFetchAll([$id_user]);
        return $result;
    }

     /**
     * Method to retrive answer either on id_question or id_post 
     * @param bool|false $id_question
     * @param bool|false $id_post
     * @return mixed
     */
    public function findAnswer($id_question = false, $id_post = false){

        if($id_post){
            $id_question = $id_post;
        }
        $this->db->select("
            a.id as id_answer,
            a.id_question,
            p.id as id_post,
            u.name,
            p.created as created_post,
            p.content,
            u.id as id_user,
            u.email,
            u.password,
            u.acronym,
            u.created as created_user,
            sum(v.up_vote) as up_vote,
            sum(v.down_vote) as down_vote,
            sum(v.up_vote - v.down_vote) as score")
            ->from("post as p")
            ->join("answer as a", "a.id_post = p.id")
            ->leftJoin("vote as v","v.id_post = p.id")
            ->join("user as u", "u.id = p.id_user")
            ->groupBy("p.id")
            ->where(($id_post ? "a.id_post = ?" : "a.id_question = ?"));
        $result = $this->db->executeFetchAll([$id_question]);
        return $result;
    }
}
