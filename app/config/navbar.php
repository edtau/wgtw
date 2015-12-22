<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'kuk',

    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home' => [
            'text' => 'home',
            'url' => $this->di->get('url')->create('home'),
            'title' => 'home'

        ],
        // This is a menu item
        'questions' => [
            'text' => 'Questions',
            'url' => $this->di->get('url')->create('question'),
            'title' => 'Questions'

        ],

        // This is a menu item
        'tags' => [
            'text' => 'Tag2Question',
            'url' => $this->di->get('url')->create('tag'),
            'title' => 'Tag2Question'
        ],
        // This is a menu item
        'users' => [
            'text' => 'Users',
            'url' => $this->di->get('url')->create('users'),
            'title' => 'Users'
        ],
        // This is a menu item
        'unanwsered' => [
            'text' => 'Unanswered',
            'url' => $this->di->get('url')->create('unanwsered'),
            'title' => 'Unanswered'
        ],
        // This is a menu item
        'setup' => [
            'text' => 'Setup',
            'url' => $this->di->get('url')->create('setup/setup'),
            'title' => 'Setup'
        ],
        // This is a menu item
        'ask' => [
            'text' => 'Ask Question',
            'url' => $this->di->get('url')->create('ask'),
            'title' => 'Ask Question'
        ],
        // This is a menu item
        'login' => [
            'text' => 'login',
            'url' => $this->di->get('url')->create('auth/login'),
            'title' => 'Questions'

        ],
        // This is a menu item
        'register' => [
            'text' => 'register',
            'url' => $this->di->get('url')->create('auth/register'),
            'title' => 'Questions'

        ],
        // This is a menu item
        'logout' => [
            'text' => 'logout',
            'url' => $this->di->get('url')->create('auth/logout'),
            'title' => 'Questions'

        ],

        // This is a menu item
        'about' => [
            'text' => 'About',
            'url' => $this->di->get('url')->create('about'),
            'title' => 'About'
        ],
    ],


    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },


    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },


    /**
     * Callback to create the url, if needed, else comment out.
     *
     */
    /*
     'create_url' => function ($url) {
         return $this->di->get('url')->create($url);
     },
     */
];
