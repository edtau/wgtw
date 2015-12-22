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
class AddCommentForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor need param page to keep track
     * of the right page to save comments to
     * @param  $page
     */
    public function __construct($id_post)
    {


        parent::__construct([], [

            'id_post' => [
                'type' => 'hidden',
                'value' => $id_post,
                'required' => true,
                'validation' => ['not_empty'],
            ],
            'comment' => [
                'type' => 'textarea',
                'label' => 'Comment:',
                'required' => true,
                'validation' => ['not_empty'],
            ],

            'submit' => [
                'type' => 'submit',
                'callback' => [$this, 'callbackSubmit'],
                'value' => 'Spara',
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

        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);

        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);

        $result =  $this->comment->save(["
                id_post" => $this->Value("id_post"),
                "id_user" => $this->user->getId(),
                "content"=> $this->value("comment"),
                "created" => gmdate('Y-m-d H:i:s')
        ]);

        if($result){
            $this->callbackSuccess();

               return $this->comment->getProperties();

        }else {

            return false;
        }

    }

    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail()
    {
        //$this->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
        return false;
    }


    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
      //  $this->AddOutput("<p><i>Form was submitted and the callback method returned true.</i></p>");
    return true;
    }

    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        //$this->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
        return false;
    }
}
