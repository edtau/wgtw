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
class EditUserForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor need param page to keep track
     * of the right page to save comments to
     * @param  $page
     */
    public function __construct( $id_user,$acronym, $name, $email)
    {

        parent::__construct([], [

            'id_user' => [
                'type' => 'hidden',
                'required' => true,
                'value' => $id_user,
                'validation' => ['not_empty'],
            ],
            'acronym' => [
                'type' => 'text',
                'label' => 'Acronym:',
                'required' => true,
                'value' => $acronym,
                'validation' => ['not_empty'],
            ],
            'name' => [
                'type' => 'text',
                'label' => 'Name:',
                'required' => true,
                'value' => $name,
                'validation' => ['not_empty'],
            ],
            'email' => [
                'type' => 'text',
                'label' => 'Email:',
                'required' => true,
                'value' => $email,
                'validation' => ['not_empty'],
            ],
            'password' => [
                'type' => 'text',
                'label' => 'Password:',
                'required' => false,

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

        if(empty($password)){
            $result =      $this->user->save([
                "id" => $this->value('id_user'),
                "acronym" => $this->value("acronym"),
                "name" => $this->value("name"),
                "email" => $this->value("email")
            ]);
        } else{
            $result =   $this->user->save([
                "id" => $this->value('id_user'),
                "acronym" => $this->value("acronym"),
                "name" => $this->value("name"),
                "email" => $this->value("email"),
                'password' =>password_hash($this->Value('password'), PASSWORD_DEFAULT),
            ]);
        }
        if($result){
            $this->user->updateSessionAcronym($this->value("acronym"));
            return $this->value("acronym");
        }
        return false;
    }

    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail()
    {

    }


    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {

    }

    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {

    }
}
