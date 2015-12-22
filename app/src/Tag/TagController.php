<?php
namespace Anax\Tag;

/**
 * A controller for users and admin related events.
 *
 */
class TagController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    public function initialize()
    {
        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);  

        $this->tag = new \Anax\Tag\Tag();
        $this->tag->setDI($this->di);
    }
    public function indexAction(){

        $form  = new \Anax\HTMLForm\AddTagForm();
        $form->setDI($this->di);

        $result = $form->check();
        $this->di->theme->setTitle("Tags");
        $tags =  $this->tag->findTags();

        //get the tags
        $tags =  $this->tag->findTags();

        //add the view for the tags
        $this->di->views->add('tag/tags', [
            'title' => "Tags",
            'tags' => $tags,
        ]);
        //if user logged in display the form to add new tags

        if($this->user->isLoggedIn()){


            if($result === true){
                $this->di->views->add('default/page', [
                    'title' => "Add Tag",
                    'content' => "Tag saved"
                ]);
            }
            if($result === false){
                $this->di->views->add('default/page', [
                    'title' => "Add Tag",
                    'content' => "Tag could not be saved"
                ]);

            }
            $this->di->views->add('default/empty', [
                'title' => "Add Tag",
                'content' => $form->getHTML()
            ]);

        }
    }
    public function listQuestionsAction ($tag){
            $question2tag = $this->tag->tag2question($tag);
            $this->di->views->add('question/question', [
            'title' => "Questions that is tagged with: $tag",
            'form' => null,
            'question' =>$question2tag
        ]);
    }

}
