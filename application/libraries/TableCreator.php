<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*****
 *** Website Libarary ***
 *** Class Name: TableCreator
 *** Description: Initialize the query table
 *
 *** Usage:
 * $table_layout = array("儀器名稱///203///text///", "管理者///50///text///", "技術///85///text///", "類別///95///text///", "編輯///40///none///da-icon-column");
 * $arguments_list = array('table_id'=>"Table_List", 'table_layout'=>&$table_layout);
 * $this->load->library('TableCreator', $arguments_list);
 * foreach ($data_list as $data_row) { $this->tablecreator->append_row($data_array); }
 * $temp_data['render_page_table'] = $this->tablecreator->get_outputs();
 *****/

class TableCreator {
	// -------- --------
	// Private variables
	private $_table_id = "";
	private $_table_col_count = 0;

	private $_table_col_titles = array();
	private $_table_col_width = array();
	private $_table_col_class = array();

	//Table contents strings
	private $_table_output_head = array();
	private $_table_output_body = array();
	private $_table_output_tail = array();

	// Table contents strings

	// -------- --------
	// Constructor
	public function __construct( /*ref array*/ &$arguments_list = array() )
	{
		if (element('table_layout', $arguments_list))
		{
			$this->initialize($arguments_list);
		}
	}

	// -------- --------
	// Function initialize - alternative constructor
	public function initialize( /*ref array*/ &$arguments_list )
	{
		// check layout
		$table_id = &$arguments_list['table_id'];
		$table_layout = &$arguments_list['table_layout'];
		$table_title = &$arguments_list['table_title'];
		$table_inlude = (array_key_exists('table_include', $arguments_list)) ? $arguments_list['table_include'] : TRUE;


		if (! $table_inlude)
		{
			// Reset the table
			$this->_table_output_head = array();
		}

		// create header and tail
		array_push(
			$this->_table_output_head,
			//sprintf("<table class=\"table table-bordered table-hover\" id=\"%s\">", $table_id)
			"<table class=\"table table-bordered table-hover\">"
		);

		$this->_table_id = $table_id;
		$this->_table_col_count = count($table_layout);

		if (count($table_layout) == 0)
		{
			array_push(
				$this->_table_output_head,
				//sprintf("<table class=\"table table-bordered table-hover\" id=\"%s\"><thead></thead><tbody></tbody></table>", $table_id)
				sprintf("<table class=\"table table-bordered table-hover\"><thead></thead><tbody id=\"%s\"></tbody></table>", $table_id)
			);
		}
		else
		{
			array_push($this->_table_output_head, sprintf("<thead><tr>", $table_id));
			foreach ($table_layout as $col_setting)
			{
				if (array_key_exists($table_id, $table_title))
				{
					$temp_title = $table_title[$table_id];
				}
				else if (array_key_exists($col_setting, $table_title))
				{
					$temp_title = $table_title[$col_setting];
				}
				else
				{
					$temp_title = "";
				}

				array_push(
					$this->_table_output_head, 
					sprintf("<th style=\"background-color:#d8f6f3\"><a title=\"%s\">%s</a></th>", $temp_title, $col_setting)
				);
			}
			//array_push($this->_table_output_head, "</tr></thead><tbody></tbody></table>");
			array_push($this->_table_output_head, sprintf("</tr></thead><tbody id=\"%s\"></tbody></table>", $table_id));
		}
	}

	// -------- --------
	// Function get_outputs - return complete output
	public function get_outputs()
	{
		return implode('', $this->_table_output_head);
	}
}
