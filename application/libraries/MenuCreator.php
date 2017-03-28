<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*****
 *** Website Libarary ***
 *** Class Name: MenuCreator
 *** Description: Create the menu bar
 *
 *** Usage:
 * $this->menucreator->set_page($target_page);
 * $this->_page_pointer = &$this->menucreator->get_page();
 * $this->_page_frame_title = &$this->menucreator->get_page_title();
 * $data['render_main_menubar'] = $this->menucreator->get_outputs();
 *****/
 
class MenuCreator {
	// -------- -------- -------- --------
	// Private variables
	private $_CI_linker = "";
	private $_current_page = "";
	private $_menu_format = "";

	// -------- --------
	// Constructor
	public function __construct()
	{
		$this->_CI_linker = &get_instance();
	}

	// -------- -------- 	
	// Function initialize - alternative constructor
	public function initialize( /*ref string*/ &$target_page )
	{
		$this->_current_page = $target_page;
		$this->_menu_format = $this->_CI_linker->constantshandler->menulist;

		if (! array_key_exists($this->_current_page, $this->_menu_format))
		{
			$this->_current_page = "home";
		}
	}

	// -------- -------- 	
	// Function get_outputs - output the menu contents
	public function get_outputs()
	{
		$temp_outputs_menu = array();
		
		foreach ($this->_menu_format as $page => $info)
		{
			if (count($info[2]) > 0)
			{
				array_push($temp_outputs_menu, sprintf(
					"<li class=\"dropdown\"><a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"/dictionary/%s\"><i class=\"%s\"></i> %s<b class=\"caret\"></b></a>
                	 <ul role=\"menu\" class=\"dropdown-menu\">",
					$page, $info[1], $info[0]
				));
										
				foreach ($info[2] as $sub_item)
				{
					array_push($temp_outputs_menu, sprintf("<li><a href=\"/dictionary/%s\">%s</a></li>", $sub_item[0], $sub_item[1]));
				}
					
				array_push($temp_outputs_menu, "</ul></li>");
			}
			else
			{
				$li = ($page == "home") ? "<li class=\"active\">" : "<li>";
				array_push($temp_outputs_menu, sprintf(
					"%s<a href=\"/dictionary/%s\"><i class=\"%s\"></i> %s</a></li>",
					$li, $page, $info[1], $info[0]
				));				
			}
		}
		
		return implode('', $temp_outputs_menu);
	}

	// -------- -------- 	
	// Function get_page - get the including page
	public function get_page()
	{
		return $this->_current_page;
	}
}