<?php

/**
 * Created by PhpStorm.
 * User: 李木子
 * Date: 2018/1/13
 * Time: 下午 4:27
 */
class Article_model extends CI_Model
{
  public function  get_article_list(){
      $this->db->select('*');
      $this->db->from('t_article a');
      $this->db->join('t_article_type t', 'a.type_id = t.type_id','left');
      $query = $this->db->get();

      return $query->result();
  }
    public function get_article_type($user_id){
        $sql ="select * from
                 (select count(*) num,a.type_id
                 from t_article a where a.user_id = $user_id
                GROUP BY a.type_id) nt,
                t_article_type t
                where t.type_id = nt.type_id";

        $query = $this->db->query($sql);
        return $query->result();

    }
}