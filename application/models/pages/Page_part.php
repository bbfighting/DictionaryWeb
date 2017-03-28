<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****
 *** Website Model ***
 *** Model Name: Page_Nanomark
 *** Description: Load the nanomark page contents
 *
 *****/
 
class Page_part extends CI_Model {
	// -------- --------
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	// -------- -------- 
	// Function get_data_list - get the data list
	public function get_data_list()
	{
		// Generate the tables
		$this->load->library('TableCreator');
		// -------- Table 1 - affairs --------
		$table_layout = array();
		$arguments_list = array('table_id' => "table-content", 'table_layout' => &$table_layout, 'table_title' => array(), 'table_include' => FALSE);
		
		$this->tablecreator->initialize($arguments_list);
		
		// Outputs
		return $this->tablecreator->get_outputs();
	}
}