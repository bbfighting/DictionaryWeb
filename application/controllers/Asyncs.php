<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****
 *** Website Controller ***
 *** Controller Name: Asyncs
 *** Description: Load asynchromous data
 *
 *****/

class Asyncs extends CI_Controller {
	// -------- -------- -------- --------
	// Private variables

	// -------- -------- -------- --------
	// Asyncs Method - 'getcharacter'
	// -------- -------- -------- --------
	public function getcharacter()
	{
		$argumet_keys = array('ch');
		$this->load->model('asyncs/async_getcharacter', 'character');

		echo json_encode($this->character->get_outputs($this->_load_requests($argumet_keys)));
	}
	// -------- -------- -------- --------

	// -------- -------- -------- --------
	// Asyncs Method - 'getphone'
	// -------- -------- -------- --------
	public function getphone()
	{
		$argumet_keys = array('ch', 'ph_table');
		$this->load->model('asyncs/async_getphone', 'phone');

		echo json_encode($this->phone->get_outputs($this->_load_requests($argumet_keys)));
	}
	// -------- -------- -------- --------

	// -------- -------- -------- --------
	// Asyncs Method - 'getpart'
	// -------- -------- -------- --------
	public function getpart()
	{
		// Load model - getemployee
		$argumet_keys = array('ch');
		$this->load->model('asyncs/async_getpart', 'getpart');

		echo json_encode($this->getpart->get_outputs($this->_load_requests($argumet_keys)));
	}
	// -------- -------- -------- --------

	// -------- --------
	// Private Function load_requests - load the requests
	private function _load_requests ( /*ref array*/ &$keys_list, /*string*/ $action = "" )
	{
		$temp_array = array();
		
		foreach ($keys_list as $key)
		{
			if ((string)$this->input->post($key) != "")
			{
				$temp_array[$key] = $this->input->post($key);
			}
		}
		
		return $temp_array;
	}
}
