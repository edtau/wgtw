<?php
namespace Anax\Comment;

/**
 * A controller for users and admin related events.
 *
 */
class CommentController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;


    public function initialize()
    {
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);

        $this->answer = new \Anax\Answer\Answer();
        $this->answer->setDI($this->di);


        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);

        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);

    }

    public function answerAction($id_post)
    {
        $form = new \Anax\HTMLForm\AddCommentForm($id_post);
        $answer = $this->answer->findAnswer(false, $id_post);

        $form->setDI($this->di);
        $result = $form->check();
          $allowed_to_vote = false;
        if($result){
            $this->di->theme->setTitle("Ask Question");
            $this->di->views->add('default/page', [
                'title' => "Comment",
                'content' => "<p>Comment saved</p>"
            ]);
        } else {
            $this->di->theme->setTitle("Comment to Answer");
            $this->di->views->add('answer/answer', [
                'title' => "Write comment",
                'content' => $form->getHTML(),
                'id_question' => $answer[0]->id_question,
                'answer' => $answer,
                'allowed_to_vote' => $allowed_to_vote
            ]);
        }
    }
    public function questionAction($id_post)
    {
        $form = new \Anax\HTMLForm\AddCommentForm($id_post);
        $question = $this->question->findQuestion(false, $id_post);

        $form->setDI($this->di);
        $result = $form->check();
        if($result){
            $this->di->theme->setTitle("Ask Question");
            $this->di->views->add('default/page', [
                'title' => "Comment",
                'content' => "<p>Comment saved</p>"
            ]);
        } else {
            $this->di->theme->setTitle("Comment to Question");
            $this->di->views->add('question/question', [
                'title' => "Write comment",
                'form' => $form->getHTML(),
                'id_question' => $question[0]->id_question,
                'question' => $question
            ]);
        }
    }
}
