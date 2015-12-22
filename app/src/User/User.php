<?php

namespace Anax\User;

/**
 * Model for Users.
 *
 */
class User extends \Anax\Database\Database
{

    private $result_question = false;
    private $result_answer = false;
    private $result_comment = false;

    public function setRankQuestion(){
        $this->result_question = $this->calculateRankQuestions();
    }
    public function setRankAnswer(){
        $this->result_answer = $this->calculateRankAnswers();
    }
    public function setRankComments(){
        $this->result_comment = $this->calculateRankComments();
    }

    public function getId()
    {
        if ($this->session->get("id") != null) {
            $id = ($this->session->get("id"));
            return $id;
        }
        return null;
    }
    public function getAcronym()
    {

        if ($this->session->get("acronym") != null) {
            $acronym = ($this->session->get("acronym"));
            return $acronym;
        }
        return null;
    }
    public function isLoggedIn()
    {
        if ($this->session->get("logged_in") != null) {
            return $this->session->get('logged_in');
        }
        return false;
    }
    public function login($acronym, $password)
    {

        $this->db->select("u.*")
            ->from("user as u")
            ->where("u.acronym = ?");
        $res = $this->db->executeFetchAll([$acronym]);
        if ($res) {
            foreach ($res as $user) {
                if (password_verify($password, $user->password)) {

                    $this->session->set('acronym', $user->acronym);
                    $this->session->set('id', $user->id);
                    $this->session->set('logged_in', true);
                    return true;
                }
            }

        }
        return false;
    }

    public function findUserById($id_user){
        $this->db->select("u.*")
            ->from("user as u")
            ->where("u.id = ?");
        return $this->db->executeFetchAll([$id_user]);
    }
    public function findUserByAcronym($acronym){
        $this->db->select("u.*")
            ->from("user as u")
            ->where("u.acronym = ?");
        return $this->db->executeFetchAll([$acronym]);
    }

    public function updateSessionAcronym($acronym)
    {
        $this->session->set('acronym', $acronym);
    }

    public function logout()
    {
        $this->session->set('logged_in', false);
        $this->session->set('acronym', null);
        $this->session->set('id', null);
        return true;
    }

    public function postedMostComments($limit = 1)
    {
        $this->db->select("c.*")
            ->from("v_user_action_comment as c")
            ->limit($limit);
        $res = $this->db->executeFetchAll();
        return $res;
    }

    public function calculateRank($id_user){

        if($this->result_question == false){
            $result_question = $this->calculateRankQuestions();
        } else {
            $result_question = $this->result_question;
        }


        $sum_questions = 0;
        $number_questions = 0;
        foreach($result_question as $rq){
            if($rq->id_user == $id_user){
                $sum_questions +=  $rq->score;
                $number_questions++;
            }
        }

        if($this->result_question == false){
            $result_answer = $this->calculateRankAnswers();
        } else {
            $result_answer = $this->result_answer;
        }


        $sum_answer= 0;
        $number_answers = 0;
        foreach($result_answer as $rq){
            if($rq->id_user == $id_user){
                $sum_answer +=  $rq->score;
                $number_answers++;
            }
        }

        if($this->result_question == false){
            $result_comment = $this->calculateRankComments();
        } else {
            $result_comment = $this->result_comment;
        }


        $sum_comment= 0;
        $number_comments = 0;
        foreach($result_comment as $rq){
            if($rq->id_user == $id_user){
                $sum_comment +=  $rq->score;
                $number_comments++;
            }
        }
        $sum_vote=  $sum_comment + $sum_answer + $sum_questions;
        $total_sum = $sum_vote;
        $total_sum += $number_comments * 1;
        $total_sum += $number_questions * 2;
        $total_sum += $number_answers * 3;
        $array = [
            "id_user" => $id_user,
            "sum_vote" => $sum_vote,
            "total_sum" => $total_sum,
            "number_comments" => $number_comments,
            "number_questions" => $number_questions,
            "number_answers" => $number_answers];
        return $array;
    }
    public function calculateRankQuestions(){
        $this->db->select("
            q.id as id_question,
            p.id_user,
            sum(v.up_vote)  as up_vote,
            sum(v.down_vote)  as down_vote,
            sum(v.up_vote - v.down_vote) as score")
            ->from("vote as v")
            ->join("post as p", "p.id = v.id_post")
            ->join("question as q", "q.id_post = p.id")
            ->groupBy("q.id;");
        $result_question = $this->db->executeFetchAll();
        return $result_question;
    }
    public function calculateRankAnswers(){
        $this->db->select("
            a.id as id_answer,
            p.id_user,
            sum(v.up_vote)  as up_vote,
            sum(v.down_vote)  as down_vote,
            sum(v.up_vote - v.down_vote) as score")
            ->from("vote as v")
            ->join("post as p", "p.id = v.id_post")
            ->join("answer as a", "a.id_post = p.id")
            ->groupBy("a.id;");
        $result_answer = $this->db->executeFetchAll();
        return $result_answer;
    }

    public function calculateRankComments(){

        $this->db->select("
            c.id as id_comment,
            c.id_user,
            sum(v.up_vote)  as up_vote,
            sum(v.down_vote)  as down_vote,
            sum(v.up_vote - v.down_vote) as score")
            ->from("vote as v")
            ->join("comment as c", "c.id = v.id_comment")
            ->groupBy("c.id;");
        $result_comment = $this->db->executeFetchAll();
        return $result_comment;
    }
    public function topThreeUsers($users){
        $rank = [];
        foreach($users as $u){
            $rank[] = $this->calculateRank($u->id);
        }

        usort($rank, function($a, $b) {
            return $a['total_sum'] - $b['total_sum'];
        });
        $rank = array_reverse($rank, true);
        array_splice($rank, 3);
        return $rank;

    }
    public function calculateRankAllUsers($users){

        $rank = [];
        foreach($users as $user){
            $rank[] = $this->calculateRank($user->id);
        }
        return $rank;

    }
}
