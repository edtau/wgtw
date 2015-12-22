<?php

namespace Anax\Install;

/**
 * Model for Users.
 *
 */
class Install extends \Anax\Database\Database
{
    private $output = [];

    public function setupTables(){



        $this->db->dropTableIfExists("answer")->execute();
        $result = $this->db->createTable(
            'answer',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'id_question' => ['int(11)', 'not null'],
                'id_post' => ['int(11)'],
                'name' => ['varchar(80)']
            ]
        )->execute();

        $this->buildOutputTables($result, "answer");

        $this->db->dropTableIfExists("comment")->execute();
        $result =  $this->db->createTable(
            'comment',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'id_post' => ['int(11)', 'not null'],
                'id_user' => ['int(11)', 'not null'],
                'content' => ['varchar(500)', 'not null'],
                'created' => ['datetime', 'not null']
            ]
        )->execute();

        $this->buildOutputTables($result, "comment");

        $this->db->dropTableIfExists("post")->execute();
        $result = $this->db->createTable(
            'post',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'id_user' => ['int(11)', 'not null'],
                'content' => ['text', 'not null'],
                'created' => ['datetime', 'not null']
            ]
        )->execute();

        $this->buildOutputTables($result, "post");
        $this->db->dropTableIfExists("question")->execute();
        $result = $this->db->createTable(
            'question',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'id_post' => ['int(11)', 'not null'],
                'title' => ['varchar(250)', 'not null','UNIQUE'],
                'solved'  => ['int(11)', 'not null'],
                'created' => ['datetime', 'not null']
            ]
        )->execute();
        $this->buildOutputTables($result, "question");

        $this->db->dropTableIfExists("tag")->execute();
        $result = $this->db->createTable(
            'tag',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'name' => ['varchar(20)', 'not null'],
                'description' => ['varchar(100)', 'not null'],
                'id_user' => ['int(11)', 'not null'],
                'created' => ['datetime', 'not null']
            ]
        )->execute();
        $this->buildOutputTables($result, "tag");

        $this->db->dropTableIfExists("tag2question")->execute();
        $result = $this->db->createTable(
            'tag2question',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'id_tag' => ['int(11)', 'not null'],
                'id_question' => ['int(11)', 'not null'],
            ]
        )->execute();
        $this->buildOutputTables($result, "tag2question");
        $this->db->dropTableIfExists("user")->execute();
        $result = $this->db->createTable(
            'user',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'acronym' => ['varchar(20)', 'not null'],
                'email' => ['varchar(80)', 'not null'],
                'name' => ['varchar(80)', 'not null'],
                'password' => ['varchar(255)', 'not null'],
                'created' => ['datetime', 'not null']
            ]
        )->execute();
        $this->buildOutputTables($result, "user");

        $this->db->dropTableIfExists("vote")->execute();
        $result = $this->db->createTable(
            'vote',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'id_user' => ['int(11)', 'not null'],
                'id_user' => ['int(11)', 'not null'],
                'id_comment' => ['int(11)', 'not null','DEFAULT 0'],
                'id_post' => ['int(11)', 'not null','DEFAULT 0'],
                'up_vote' => ['int(11)', 'not null','DEFAULT 0'],
                'down_vote' => ['int(11)', 'not null','DEFAULT 0'],
                'created' => ['datetime', 'not null'],
            ]
        )->execute();
        $this->buildOutputTables($result, "vote");

        return $this->output;
    }

    private function buildOutputTables($result, $table){
        if($result){
            $this->output[] = "Table $table created : OK";
        } else{
            $this->output[] = "Table $table created FAIL";
        }
    }
}
