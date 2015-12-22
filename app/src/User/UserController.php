<?php
namespace Anax\User;

/**
 * A controller for users and admin related events.
 *
 */
class UserController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;
    public function isLoggedIn(){
        return $this->session->get('logged_in');
    }
    public function initialize()
    {
        $this->user = new \Anax\User\User();
        $this->user->setDI($this->di);

        $this->answer = new \Anax\Answer\Answer();
        $this->answer->setDI($this->di);

        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);



        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);
        $this->di->theme->setTitle("User");


    }
    //list all the questions
    public function indexAction(){

        $users = $this->user->findAll();

        $rank = [];
        foreach($users as $u){
            $rank[] = $this->user->calculateRank($u->id);
        }

        $this->user->calculateRankAllUsers($users);
        $this->di->views->add('user/users', [
            'title' => "Users",
            'users' => $users,
            'rank' => $rank

        ]);
    }

    public function myProfileAction(){
        $id_user = $this->user->getId();
        $user = $this->user->findUserById($id_user);
        $calculation =  $this->user->calculateRank($user[0]->id);
        $questions = $this->question->findAllQuestionsByIdUser($user[0]->id);
        $answers  = $this->answer->findAllAnswers( );




        $form  = new \Anax\HTMLForm\EditUserForm($user[0]->id, $user[0]->acronym, $user[0]->name, $user[0]->email);

        $this->di->views->add('user/profile', [
            'title' => "Profile",
            'user' => $user,
            'calculation' => $calculation,
            'form' => $form->getHTML(),
            'questions' => $questions,
            'answered' => null,
            'answers' => $answers,
        ]);

    }
    public function profileAction($acronym){
        $user = $this->user->findUserByAcronym($acronym);
        $calculation =  $this->user->calculateRank($user[0]->id);
        $questions = $this->question->findAllQuestionsByIdUser($user[0]->id);
        $answers  = $this->answer->findAllAnswers( );

        $this->di->views->add('user/profile', [
            'title' => "Profile",
            'user' => $user,
            'calculation' => $calculation,
            'form' => null,
            'questions' => $questions,
            'answered' => null,
            'answers' => $answers,
        ]);


    }
    //list one question with answers
    public function loginAction(){


        $form  = new \Anax\HTMLForm\LoginForm();
        $form->setDI($this->di);

        $result = $form->check();

            $this->di->theme->setTitle("Login");
            $this->di->views->add('default/page', [
                'title' => "Login",
                'content' => $form->getHTML()
            ]);

        if($result){
            $acronym = $this->user->getAcronym();
            $this->redirectTo("user/profile/$acronym");
        }

    }

    public function logoutAction(){
        $this->user->logout();
        $this->redirectTo("home");
    }
    public function registerAction(){
        $form  = new \Anax\HTMLForm\RegisterForm();
        $form->setDI($this->di);
        $this->di->theme->setTitle("Register");
        $result = $form->check();

        if(($result)){
            $this->redirectTo("user/login/");
        } else {
            $this->di->views->add('default/page', [
                'title' => "Registration",
                'content' => $form->getHTML()
            ]);
        }

    }

}
