<?php

namespace Anax\HTMLForm;

use Anax\Comment\Comment;
use Anax\Tag\Tag;

class AddTagForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    public function __construct()
    {

        parent::__construct([], [

            'tag_name' => [
                'type' => 'text',
                'label' => 'Tagname:',
                'required' => true,
                'validation' => ['not_empty'],
            ],
            'description' => [
                'type' => 'text',
                'label' => 'Description:',
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

        $this->tag = new Tag();
        $this->tag->setDI($this->di);

        $tag_name_exists = $this->tag->findTagByName($this->Value("tag_name"));
        if($tag_name_exists == false){

            $result =  $this->tag->save([
                "name" => $this->Value("tag_name"),
                "id_user" => $this->user->getId(),
                "description"=> $this->value("description"),
                "created" => gmdate('Y-m-d H:i:s')

            ]);
            if($result){
                return true;
            }else{
                return false;
            }
        }
        else{
           return false;
        }

    }

    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail()
    {
        //$this->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it:(</i></p>");

    }


    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        // $this->AddOutput("<p><i>You succefully added a new tag :)</i></p>");

    }

    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        //  $this->AddOutput("<p><i>You have not entered a valid tag name:(</i></p>");

    }
}
