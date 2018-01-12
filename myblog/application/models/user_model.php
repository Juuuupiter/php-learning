<?php

/**
 * Created by PhpStorm.
 * User: 李木子
 * Date: 2018/1/11
 * Time: 上午 11:21
 */
class user_model extends CI_Model
{
   public function add($user){
       return $this -> db -> insert('t_user', $user);
       return $this -> db->affected_rows();
   }

//    public function user_list(){
//        $query = $this->db->get('name');
//        return $query->result();
//    }
//    public  function  del_user($id){
//        $this->db->delete('name',array('id'=>$id));
//        return $this->db->affected_rows();
//    }
//    public function get_user_by_id($id){
//        $query = $this->db->get_where('name',array('id'=>$id));
//        return $query->row();
//    }
//    public function update($id,$name){
//        $this->db->where('id', $id);
//        $this->db->update('name', array(
//            "name" => $name,
//        ));
//        return $this->db->affected_rows();
//    }
}