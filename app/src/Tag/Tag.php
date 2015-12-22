<?php

namespace Anax\Tag;

/**
 * Model for Users.
 *
 */
class Tag extends \Anax\Database\Database
{

	public function findAllTags2Question(){
		$this->db->select("*")
				->from("tag as t")
				->join("tag2question as t2q", "t2q.id_tag = t.id");
		$result = $this->db->executeFetchAll();
		return $result;
	}
	public function findTags(){
		$this->db->select("
		u.id as id_user,
		u.acronym,
		u.name as user_name,
		t.id as id_tag,
		t.description as description,
		t.created as tag_created,
		t.name
		")
		->from("tag as t")
		->join("user as u", "u.id = t.id_user");
		$result = $this->db->executeFetchAll();
		return $result;
	}
	public function tag2question($tag){

		$this->db->select("
		p.content,
		q.title,
		p.content,
		p.created as created_post,
		p.created,
		q.id as id_question,
		p.id as id_post,
		u.id as id_user,
		u.acronym,
		u.name as name,
		u.email,
		t.description,
		t.name as tag_name ")
		->from("question as q")
		->join("post as p", "p.id = q.id_post")
		->join("tag2question as t2q", "t2q.id_question = q.id")
		->join("tag  as t", "t.id = t2q.id_tag")
		->join("user as u", "u.id = p.id_user")
		->where("t.name = ?");
		$result = $this->db->executeFetchAll([$tag]);
		return $result;
	}
	public function mostPopularTags(){
		$this->db->select("
		t.id,
		t.name,
		t.description,
		t.created,
		count(id_tag) as number_of_tags")
				->from("tag2question as t2q")
				->join("tag  as t", "t.id = t2q.id_tag")
				->groupBy("t.id")
				->orderBy("number_of_tags desc");
		$result = $this->db->executeFetchAll();
		return $result;
	}
	public function findTagByName($tag_name){
		$this->db->select("t.*")
				->from("tag as t")
				->where("t.name =?");

		$res = $this->db->executeFetchAll([$tag_name]);
		return $res;
	}
}