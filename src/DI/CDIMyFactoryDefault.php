<?php

namespace Anax\DI;

/**
 * My own set of extended services.
 *
 */
class CDIMyFactoryDefault extends CDIFactoryDefault
{
    /**
     * Construct.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->setShared('db', function () {
            $db = new \Mos\Database\CDatabaseBasic();
            $db->setOptions(require ANAX_APP_PATH . 'config/database/config_mysql.php');
            $db->connect();
            return $db;
        });

        $this->setShared('auth', function () {
            $auth = new \Anax\Auth\Auth();
            return $auth;
        });
        $this->setShared('form', function () {
            $form = new \Mos\HTMLForm\CForm();
            return $form;
        });
        $this->setShared('gravatar', function () {
            $gravatar = new \Anax\User\Gravatar();
            return $gravatar;
        });
        $this->setShared('user', function () {
            $form = new \Anax\User\User();
            return $form;
        });
        $this->setShared('tags', function () {
            $tags = new \Anax\Tag\Tag();
            return $tags;
        });


    }
}