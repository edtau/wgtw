<?php
namespace Anax\Page;

/**
 * A controller for users and admin related events.
 *
 */
class PageController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    public function initialize()
    {
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);

        $this->tag = new \Anax\Tag\Tag();
        $this->tag->setDI($this->di);

        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);

        $this->answer = new \Anax\Answer\Answer();
        $this->answer->setDI($this->di);

        $this->di->theme->setTitle("Page");
    }

    public function indexAction(){
        $this->homeAction();
    }
    public function homeAction(){

        $this->di->theme->setTitle("Welcome");
        $users = $this->user->findAll();


        $rank = $this->user->topThreeUsers($users);

        $latest_question = $this->question->findLatestQuestions(10);
        $answers = $this->answer->findAll();
        $most_popular_tags = $this->tag->mostPopularTags();
        $this->di->views->add('home/welcome', [
            'title' => "Profile",
            'most_popular_tags' =>$most_popular_tags,
            'questions' => $latest_question,
            'answered' => '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
            'answers' => $answers,
            'rank' => $rank,
            'users' => $users
        ]);
        /*
         *
         *
         * Förstasidan skall ge en översikt av senaste frågor
         * tillsammans med de mest populära taggarna o
     ch de mest aktiva användarna.
         */
        /*
        $questions = $this->question->latestQuestions();
        $tags = $this->tag->tags2question();
        $popularTags = $this->tag->mostUsedTags();
        $most_active_user = $this->user->topUser();
        
        $this->di->views->add('page/home', [
            'title' => "home",
            'questions' => $questions,
            'tags' => $tags,
            'popularTags' =>$popularTags,
            'most_active_user' =>$most_active_user
        ]);*/
    }
    public function aboutAction(){
        $this->di->theme->setTitle("About");
        $this->di->views->add('default/empty', [
            'title' => "questions",
            'content' => "sdf",
        ]);
    }
}
