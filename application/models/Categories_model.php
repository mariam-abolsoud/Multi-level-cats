<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*
*/

class Categories_model extends CI_Model
{
    public function get_categories($parent_id=0)
    {
        $this->db->where('parent_id', $parent_id);
        
        $query = $this->db->get('categories');
        
        if($query)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    
    public function get_cat_name($cat_id)
    {
        $this->db->where('id', $cat_id);
        
        $query = $this->db->get('categories');
        
        if($query)
        {
            return $query->row()->name;
        }
        else
        {
            return false;
        }
    }
}