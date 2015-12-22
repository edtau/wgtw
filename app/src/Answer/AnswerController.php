<?php
namespace Anax\Answer;

/**
 * A controller for users and admin related events.
 *
 */
class AnswerController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    public function initialize()
    {
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);

        $this->t2q = new \Anax\Tag\Tag();
        $this->t2q->setDI($this->di);

        $this->db = new \Anax\Database\Database();
        $this->db->setDI($this->di);

        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);

        $this->tag = new \Anax\Tag\Tag();
        $this->tag->setDI($this->di);

    }
    public function writeAction($id_post){

        $title = "Write Answer";
        $this->di->theme->setTitle($title);

        $question = $this->question->findQuestion($id_post);


        $form  = new \Anax\HTMLForm\AddAnswerForm($question[0]->id_question);
        $form->setDI($this->di);


        if($this->user->isLoggedIn()) {
            $result_save =  $form->check();
            if($result_save){
                $this->di->views->add('default/page', [
                    'title' => $title,
                    'content' => "Answer saved"
                ]);
            } else {

                $this->di->views->add('question/question', [
                    'title' => "Write answer",
                    'form' => $form->getHTML(),
                    'question' =>$question
                ]);
            }

        }
    }

}
