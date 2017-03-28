<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****
 *** Website Model ***
 *** Model Name: Page_Nanomark
 *** Description: Load the nanomark page contents
 *
 *****/
 
class Page_phone extends CI_Model {
	// -------- --------
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	// -------- -------- 
	// Function get_data_list - get the data list
	public function get_data_list( /*array*/ $arguments_list )
	{
		$table_header_str = "";
		$ph_table = $arguments_list['ph_table'];

		if ($ph_table == "phone_binary")
		{
			$col_array = array('content' => array('bopomofo', 'Pinyin', 'Code', 'Tone'), 
								'cs' => array('Cs1', 'Cs2', 'Cs3', 'Cs4', 'Cs5', 'Cs6', 'Cs7', 'Cs8'), 
								'v' => array('V11', 'V12', 'V13', 'V14', 'V15', 'V16', 'V17', 'V18',
											 'V21', 'V22', 'V23', 'V24', 'V25', 'V26', 'V27', 'V28',
											 'V31', 'V32', 'V33', 'V34', 'V35', 'V36', 'V37', 'V38'),
								'ce' => array('Ce1', 'Ce2', 'Ce3', 'Ce4', 'Ce5', 'Ce6', 'Ce7', 'Ce8'),
								'tone' => array('Tone1', 'Tone2', 'Tone3'));			
		}
		else
		{
			$col_array = array('content' => array('bopomofo', 'Pinyin', 'Code', 'Tone'), 
								'cs' => array('Cs1', 'Cs2', 'Cs3'), 
								'v' => array('V11', 'V12', 'V13',
											 'V21', 'V22', 'V23',
											 'V31', 'V32', 'V33'),
								'ce' => array('Ce1', 'Ce2', 'Ce3'),
								'tone' => array('Tone1'));				
		}

		$table_title = array('content' => array('Tone' => "Mandarin includes 5 tones: 0 (netural), 1 (Flat), 2(Rising), 3 (Falling-Rising) and 4 (Falling). These tones are important features of Chinese phonology but might not be the research goal of certain researchers. Here users can chose if they want the phonological representation with tones information or not."), 
							 'cs' => array('table-cs' => "聲母"), 
							 'v' => array('V11' => "韻頭", 'V12' => "韻頭", 'V13' => "韻頭", 'V14' => "韻頭", 'V15' => "韻頭", 'V16' => "韻頭", 'V17' => "韻頭", 'V18' => "韻頭",
										  'V21' => "韻父", 'V22' => "韻父", 'V23' => "韻父", 'V24' => "韻父", 'V25' => "韻父", 'V26' => "韻父", 'V27' => "韻父", 'V28' => "韻父",
										  'V31' => "韻尾", 'V32' => "韻尾", 'V33' => "韻尾", 'V34' => "韻尾", 'V35' => "韻尾", 'V36' => "韻尾", 'V37' => "韻尾", 'V38' => "韻尾"),
							 'ce' => array('table-ce' => "韻尾"),
							 'tone' => array('Tone1' => "Tone的數值化"));	


		// Generate the tables
		$this->load->library('TableCreator');

		foreach ($col_array as $key => $value) {		
		// -------- Table 1 - affairs --------
			$table_layout = $value;
			$arguments_list = array('table_id' => 'table-' . $key, 'table_layout' => &$table_layout, 'table_title' => &$table_title[$key], 'table_include' => FALSE);
			$this->tablecreator->initialize($arguments_list);
			$table_header_str .= $this->tablecreator->get_outputs() . "</br>";
		}
		
		// Outputs
		return $table_header_str;
	}
}