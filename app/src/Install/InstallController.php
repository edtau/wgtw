<?php
namespace Anax\Install;

/**
 * A controller for users and admin related events.
 *
 */
class InstallController implements \Anax\DI\IInjectionAware
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


    }

    public function indexAction(){
        $this->install = new \Anax\Install\Install();
        $this->install->setDI($this->di);

        $output = $this->install->setupTables();

        $this->di->theme->setTitle("Installation");
        $this->di->views->add('install/install_view', [
            'title' => "Result Installation",
            'output' => $output
        ]);
    }

}
