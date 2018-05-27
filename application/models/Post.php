<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post extends CI_Model{

    function getRows($table, $order, $params = array())
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,'desc');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

}