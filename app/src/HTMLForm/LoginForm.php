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
class LoginForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor need param page to keep track
     * of the right page to save comments to
     * @param  $page
     */
    public function __construct()
    {
        parent::__construct([], [

            'acronym' => [
                'type' => 'text',
                'required' => true,
                'validation' => ['not_empty'],
            ],

            'password' => [
                'type' => 'password',
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
        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);
        $acronym =  $this->value('acronym');
        $password = $this->value('password');

        $result = $this->user->login($acronym,$password);

        if($result){
            return true;
        }
          $this->callbackFail();
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
        //$this->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");

        return true;
    }

    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {

      //  $this->AddOutput("<p><i>DoSubmitFail(): You entered the wrong username or password please try again</i></p>");
        return false;
    }
}
