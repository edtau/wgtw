<?php

namespace Anax\HTMLForm;

    /**
     * Anax base class for wrapping sessions.
     *
     */
use Anax\Post\Answer;

/**
 * Class AddComment
 * @package Anax\HTMLForm
 */
class AddQuestionForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor need param page to keep track
     * of the right page to save comments to
     * @param  $page
     */
    public function __construct($tags = null)
    {
        $array = array();
        foreach ($tags as $tag) {
            $array[] = $tag->name;
        }

        parent::__construct([], [

            'title' => [
                'type' => 'text',
                'label' => 'Title:',
                'required' => false,
                'validation' => ['not_empty'],
            ],
            'content' => [
                'type' => 'textarea',
                'label' => 'question:',
                'required' => false,
                'validation' => ['not_empty'],
            ],
            'items' => array(
                'type'        => 'checkbox-multiple',
                'values'      => $array,
            ),

            'submit' => [
                'type' => 'submit',
                'callback' => [$this, 'callbackSubmit'],
                'value' => 'save',
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
        #### User
        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);

        #### Question
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);

        #### Tag
        $this->tag = new \Anax\Tag\Tag();
        $this->tag->setDI($this->di);

        #### Post
        $this->post = new \Anax\Post\Post();
        $this->post->setDI($this->di);

        #### Tag2Question
        $this->tag2question = new \Anax\Tag2Question\Tag2Question();
        $this->tag2question->setDI($this->di);

        $tags = $this->tag->findAll();

        $check =  $this->post->save(["id_user" => $this->user->getId(), "content" => $this->value('content'), "created" => gmdate('Y-m-d H:i:s')] );

        $check = $this->question->save(["id_post" => $this->post->id, "title" => $this->value('title')] );

        $items = $this->value('items');

        foreach ($tags as $tag) {
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i] == $tag->name) {
                    $result =  $this->tag2question->save(["id_tag" => $tag->id, "id_question" =>  $this->question->id] );
                    $check = $result ? true : false;
                }
            }
        }
        return $check;
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
        return false;
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

