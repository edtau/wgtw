<?php

require __DIR__ . '/config_with_app.php';


//<editor-fold desc="Config initial setup">

//Start the session
$app->session();


//To get clean url. Notice it must be before navbar to work as expected
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);


$app->user = new \Anax\User\User();
$app->user->setDI($di);


##########################################
#
#   Navbar -- check if user is logged in and add user variables to view navbar
#
###########################################

$logged_in = $app->user->isLoggedIn();

$app->views->add('navbar/navbar_default', [
    'logged_in' => $logged_in,
    'acronym' => $app->user->getAcronym(),
    'id_user' => $app->user->getId(),
], 'navbar', $sort = 0);

//Set the navbar and theme
$app->theme->configure(ANAX_APP_PATH . 'config/theme.php');

$di->set('PageController', function () use ($di) {
    $controller = new Anax\Page\PageController();
    $controller->setDI($di);

    return $controller;
});
 
$di->set('QuestionController', function () use ($di) {
    $controller = new Anax\Question\QuestionController();
    $controller->setDI($di);

    return $controller;
});
$di->set('CommentController', function () use ($di) {
    $controller = new Anax\Comment\CommentController();
    $controller->setDI($di);

    return $controller;
});

$di->set('TagController', function () use ($di) {
    $controller = new Anax\Tag\TagController();
    $controller->setDI($di);

    return $controller;
});
$di->set('VoteController', function () use ($di) {
    $controller = new Anax\Vote\VoteController();
    $controller->setDI($di);

    return $controller;
});
$di->set('AnswerController', function () use ($di) {
    $controller = new Anax\Answer\AnswerController();
    $controller->setDI($di);

    return $controller;
});
$di->set('UserController', function () use ($di) {
    $controller = new Anax\User\UserController();
    $controller->setDI($di);

    return $controller;
});
$app->router->add('user', function () use ($app) {
    $app->dispatcher->forward([
        'controller' => 'User',
    ]);
});
$app->router->add('', function () use ($app) {
    $app->dispatcher->forward([
        'controller' => 'page',
        'action' => 'home',
    ]);
});
$app->router->add('home', function () use ($app) {
    $app->dispatcher->forward([
        'controller' => 'page',
        'action' => 'home',
    ]);
});
$di->set('InstallController', function () use ($di) {
    $controller = new Anax\Install\InstallController();
    $controller->setDI($di);

    return $controller;
});

 

//</editor-fold>
####################################### [about]
//<editor-fold desc="about controller">
$app->router->add('about', function () use ($app) {
    $app->theme->setTitle("About");
    $content = $app->fileContent->get('about.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    $app->views->add('default/page', [
        'content' => $content,
        'title' => "About",
    ]);
});
//</editor-fold>
$app->router->handle();
$app->theme->render();
