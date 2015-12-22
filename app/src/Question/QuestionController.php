<?php
namespace Anax\Question;

/**
 * A controller for users and admin related events.
 *
 */
class QuestionController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    public function initialize()
    {
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);

        $this->tag = new \Anax\Tag\Tag();
        $this->tag->setDI($this->di);

        $this->answer = new \Anax\Answer\Answer();
        $this->answer->setDI($this->di);

        $this->vote = new \Anax\Vote\Vote();
        $this->vote->setDI($this->di);

        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);

        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);

        $this->di->theme->setTitle("Questions");
    }
    public function listAction(){
        $questions = $this->question->findAllQuestions();
        $answers = $this->answer->findAllAnswers();
        $tags = $this->tag->findAllTags2Question();
        $id_user = $this->user->getId();
        foreach($questions as $q){
            $q->up_vote = ($q->up_vote == null) ? 0 : $q->up_vote;
            $q->down_vote = ($q->down_vote == null) ? 0 : $q->down_vote;
            $q->score = ($q->score == null) ? 0 : $q->score;
        }

        $this->di->views->add('question/list_questions', [
            'title' => "questions",
            'questions' => $questions,
            'answers' =>$answers,
            'tags' => $tags,
            'counter' => 0,
            'id_user' => $id_user
        ]);
    }

    public function viewAction($id_question){
        $questions = $this->question->findQuestion($id_question);
        $answers = $this->answer->findAnswer($id_question);
        $comments = $this->comment->findAllComments();

        $tags = $this->tag->findAllTags2Question();
        $id_user = $this->user->getId();
        $votes = $this->vote->findAll();


        foreach($questions as $q){
            $q->up_vote = ($q->up_vote == null) ? 0 : $q->up_vote;
            $q->down_vote = ($q->down_vote == null) ? 0 : $q->down_vote;
            $q->score = ($q->score == null) ? 0 : $q->score;
        }

        foreach($answers as $a){
            $a->up_vote = ($a->up_vote == null) ? 0 : $a->up_vote;
            $a->down_vote = ($a->down_vote == null) ? 0 : $a->down_vote;
            $a->score = ($a->score == null) ? 0 : $a->score;
        }

        foreach($comments as $c){
            $c->up_vote = ($c->up_vote == null) ? 0 : $c->up_vote;
            $c->down_vote = ($c->down == null) ? 0 : $c->down;
            $c->score = ($c->score == null) ? 0 : $c->score;
        }
        $allowed_vote = true;

        if($id_user == null){
            $allowed_vote = false;
        }

        //Questions
        $this->di->views->add('question/list_question', [
            'title' => "questions",
            'questions' => $questions,
            'answers' =>$answers,
            'tags' => $tags,
            'counter' => 0,
            'id_user' => $id_user,
            'votes' => $votes,
            'allowed_to_vote' => $allowed_vote
        ]);


        //comments to question
        $this->di->views->add('comment/list_comment', [
            'title' => "questions",
            'comments' => $comments,
            'posts' =>  $questions,
            'id_user' => $id_user,
            'votes' => $votes,
            'allowed_to_vote' => $allowed_vote
        ]);


        //answers to question
        $this->di->views->add('answer/list_answers', [
            'title' => "questions",
            'questions' => $questions,
            'answers' =>$answers,
            'id_user' => $id_user,
            'allowed_to_vote' => $allowed_vote,
            'votes' => $votes
        ]);


        //comments to answer
        $this->di->views->add('comment/list_comment', [
            'title' => "questions",
            'comments' => $comments,
            'posts' =>  $answers,
            'id_user' => $id_user,
             'votes' => $votes,
            'allowed_to_vote' => $allowed_vote
        ]);
    }
    public function setToSolvedAction($id_question){
        $this->question->save(["id" => $id_question, "solved" => 1]);
        $this->viewAction($id_question);
    }
    public function askAction(){
        $tags = $this->tag->findAll();

        $form = new \Anax\HTMLForm\AddQuestionForm($tags);
        $form->setDI($this->di);

        if ($this->user->isLoggedIn()) {
            $result_save = $form->check();
            if ($result_save) {
                $this->di->views->add('default/page', [
                    'title' => "Ask Question",
                    'content' => "question saved"
                ]);
            } else {
                $this->di->theme->setTitle("Ask Question");
                $this->di->views->add('default/page', [
                    'title' => "Ask Question",
                    'content' => $form->getHTML()
                ]);
            }
        }
    }
}
