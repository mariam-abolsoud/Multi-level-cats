<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
     
    public function __construct()
    {
        parent::__construct();

        $this->load->model('categories_model');
    }
    
	public function index()
	{
	   
	    $main_categories = $this->categories_model->get_categories(0);
        $cats_array = array();
        $cats_array[NULL] = '---SELECT CATEGORY---';
        foreach($main_categories as $cat)
        {
            $cats_array[$cat->id] = $cat->name;
        }
        $this->data['main_categories'] = $cats_array;
       
		$this->load->view('cats', $this->data);
	}
    
    public function get_sub_cats()
    {
        $parentId        = intval($this->input->post('parentId', true));
        if($parentId == 0)
        {
            echo '';
        }
        else
        {
            $cats            = $this->categories_model->get_categories($parentId);
            $parent_cat_name = $this->categories_model->get_cat_name($parentId);
            
            if(count($cats) != 0)
            {
                $result = '<label class="control-label col-md-3"> SUB Category OF ('.$parent_cat_name.') </label>
                <div class="col-md-4">
                    <select class="cat form-control" id="catsDiv'.$parentId.'">';
                    
                    $result .= '<option>---SELECT SUB CATEGORY ---</option>';
                    
                    foreach($cats as $cat)
                    {
                        $result .= '<option value="'.$cat->id.'">'.$cat->name.'</option>';
                    }
                    
                    $result .= '</select>
                    </div>
                
                    <div class="sub_cat"></div>'; 
                
                echo $result;
            }
            else{
                echo 'No available sub cats';
            }
        }
    }
}
