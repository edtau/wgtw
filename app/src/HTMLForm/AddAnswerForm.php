<?php

namespace Anax\HTMLForm;

    /**
     * Anax base class for wrapping sessions.
     *
     */
/**
 * Class AddComment
 * @package Anax\HTMLForm
 */
class AddAnswerForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor need param page to keep track
     * of the right page to save comments to
     * @param  $page
     */
    public function __construct($id_question)
    {


        parent::__construct([], [

            'id_question' => [
                'type' => 'hidden',
                'value' => $id_question,
                'required' => true,
                'validation' => ['not_empty'],
            ],
            'content' => [
                'type' => 'textarea',
                'label' => 'Answer:',
                'required' => true,
                'validation' => ['not_empty'],
            ],

            'submit' => [
                'type' => 'submit',
                'callback' => [$this, 'callbackSubmit'],
                'value' => 'Save',
                'class' => 'btn btn-primary'
            ],
        ]);
    }

    /**
     * Customise the check() method
     * @param callable $callIfSuccess handler to call if function returns true.
     * @param callable $callIfFail handler to call if function returns true.
     * @return bool|null
     */
    public function check($callIfSuccess = null, $callIfFail = null)
    {
        return parent::check([$this, 'callbackSuccess'], [$this, 'callbackFail']);
    }

    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmit()
    {

        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);

        $this->post = new \Anax\Post\Post();
        $this->post->setDI($this->di);

        $this->answer = new \Anax\Answer\Answer();
        $this->answer->setDI($this->di);


         $this->post->save(["id_user"=> $this->user->getId(), "content" => $this->value("content"), "created" =>gmdate('Y-m-d H:i:s')]);
       $post  =  $this->post->getProperties();


        $answer = $this->answer->save(["id_question"=> $this->value("id_question"), "id_post" => $post["id"] ]);

        return $answer;

    }

    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail()
    {

        return false;
    }


    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        return true;

    }

    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
       return false;

    }
}
