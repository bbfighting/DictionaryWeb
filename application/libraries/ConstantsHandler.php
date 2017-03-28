<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*****
 *** Website Libarary ***
 *** Class Name: ConstantsHandler
 *** Description: Store the customized constants
 *
 *** Usage:
 * $filter_detail = $this->constantshandler->filter;
 *****/

class ConstantsHandler {
	// -------- -------- -------- --------
	// Private variables
	private $_CI_linker = "";
	private $_database;
	private $_constants_list = array(
		'menulist'
	);
	private $_data_core = array();
	
	// -------- --------
	// Constructor
	public function __construct()
	{
		$this->_CI_linker = &get_instance();
		$this->_CI_linker->load->database();
		$this->_database = &$this->_CI_linker->db;
	}
	
	// -------- --------
	// General getter
	public function __get( /*string*/ $property_name = "" )
	{
		// If invalid property
		if ( ! in_array($property_name, $this->_constants_list))
		{
			return NULL;
		}
		// If valid property
		else
		{
			// Check the constants is defined or not
			if ( ! array_key_exists($property_name, $this->_data_core))
			{
				call_user_func(array($this, sprintf("_initialize_%s", $property_name)));
			}
			return $this->_data_core[$property_name];
		}
	}

	// -------- --------
	// Private Function get_menulist - load the menulist data
	private function _initialize_menulist()
	{
		$temp_data_list = array();
		$temp_data_sublist = array();
		
		// Step 1 - load the main page
		$iter_keys = array('Page_Title', 'Page_Icon');
		
		$query_object = $this->_database->query("SELECT * FROM Constant_Menu_List ORDER BY NOrder ASC");
		
		foreach ($query_object->result_array() as $data_row)
		{
			$temp_list = $this->_get_list($data_row, $iter_keys);
			$temp_data_list[$data_row['Page_Pointer']] = array_merge($temp_list, array(array()));
		}
		
		$query_object->free_result();
		
		// Step 2 - load the sub page	
		$query_object = $this->_database->query("SELECT * FROM Constant_Menu_SubPage ORDER BY Page_Idx ASC");
		$iter_keys = array('Page_Sub_Pointer', 'Page_Sub_Title');
		
		foreach ($query_object->result_array() as $data_row)
		{
			$temp_list = $this->_get_list($data_row, $iter_keys);
			
			array_push($temp_data_list[$data_row['Page_Main']][2], $temp_list);
		}
		
		$this->_data_core['menulist'] = $temp_data_list;
	}

	// -------- --------
	//  Private Function get_list - get list by specific keys
	private function _get_list( /*ref array*/ &$data_row, /*ref array*/ &$keys )
	{
		$temp_array = array();
		
		foreach ($keys as $dkey) array_push($temp_array, $data_row[$dkey]);
		
		return $temp_array;
	}

}

/*****
 * End of file ConstantsHandler.php
 * Location: ./application/libararies/ConstantsHandler.php
 *****/