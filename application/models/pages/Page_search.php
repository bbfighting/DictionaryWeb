<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****
 *** Website Model ***
 *** Model Name: Page_Contact
 *** Description: Load the contact page contents
 *
 *****/
 
class Page_search extends CI_Model { 
	// -------- -------- -------- --------
	// Private variables

	private $_col_array = array('編碼' => 'coding', 
						'正體' => 'traditional', 
						'簡體' => 'simplified',
						'部首' => 'radical',
						'部首筆畫' => 'radical_strokes',
						'偏旁筆畫' => 'side_strokes',
						'正體筆畫' => 'traditional_strokes',
						'簡體筆畫' => 'simp_strokes',
						'注音1' => 'bopomofo1',
						'漢語拼音1' => 'pinyin1',
						'注音2' => 'bopomofo2',
						'漢語拼音2' => 'pinyin2',
						'注音3' => 'bopomofo3',
						'漢語拼音3' => 'pinyin3',
						'英文1' => 'english1',
						'英文2' => 'english2',
						'中研院字頻' => 'sinica',
						'國推會87字頻' => 'NSC87',
						'簡體對應正體字' => 'simp_to_tra');

	// -------- --------
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	// -------- --------
	// Function get_outputs - get the data outputs
	public function get_outputs( /*string*/ $character)
	{
		$result_table = "";

		// Initialization
		$this->load->database();
		$this->db->select('a.coding, a.traditional, a.simplified, a.traditional_strokes, a.side_strokes, a.bopomofo1, a.pinyin1, a.bopomofo2, a.pinyin2, a.bopomofo3, a.pinyin3, a.english1, a.english2, a.sinica, a.NSC87, a.simp_strokes, b.radical, b.radical_strokes, c.simp_to_tra');
		$this->db->from('character_info a');
		$this->db->where('traditional', $character);
		$this->db->or_where('a.simplified', $character);
		$this->db->join('item_radical b', 'a.radical_id = b.id');
		$this->db->join('item_simp c', 'a.simp_id = c.id');


		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			foreach ($this->_col_array as $key => $value)
			{
				$result_table .= "<tr><td align='left'><strong>" . $key . "</strong></td>";
				for ($i = 0; $i < $query->num_rows(); $i++)
				{
					$result_table .= "<td align='left'>" . $query->result()[$i]->$value . "</td>";
				}
				$result_table .= "</tr>";
			}
		}

		$this->db->close();
		return $result_table;
	}
}