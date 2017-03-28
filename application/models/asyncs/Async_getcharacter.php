<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****
 *** Website Model ***
 *** Model Name: Page_Contact
 *** Description: Load the contact page contents
 *
 *****/
 
class Async_getcharacter extends CI_Model { 
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
	public function get_outputs( /*array*/ $arguments_list, $is_file = False, $tmp_name = "" )
	{
		$temp_data = array();
		$result_array = array();
		$result_str = "";

		$character = urldecode($arguments_list['ch']);
		$json_ch = $character;
		$character = preg_replace('/(\s+)$/', '', $character);
		$character_list = preg_split('/\s+|,/', $character);

		$result_table = "";

		// Initialization
		$this->load->database();
		$this->db->select('a.coding, a.traditional, a.simplified, a.traditional_strokes, a.side_strokes, a.bopomofo1, a.pinyin1, a.bopomofo2, a.pinyin2, a.bopomofo3, a.pinyin3, a.english1, a.english2, a.sinica, a.NSC87, a.simp_strokes, b.radical, b.radical_strokes, c.simp_to_tra');
		$this->db->from('character_info a');
		$this->db->where_in('traditional', $character_list);
		$this->db->or_where_in('a.simplified', $character_list);
		$this->db->join('item_radical b', 'a.radical_id = b.id');
		$this->db->join('item_simp c', 'a.simp_id = c.id');


		$query = $this->db->get();

		//$tmp_name = time();
		if ($tmp_name == 'json')
		{
			$temp_json_array = array();
			$json_array = array();

			foreach ($query->result() as $row)
			{
				foreach ($this->_col_array as $key => $value)
				{
					$temp_json_array[$value] = $row->$value;
				}
				array_push($json_array, $temp_json_array);
			}

			$json_data = json_encode($json_array, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$tmp_name = time();
			$filepath = sprintf("download/result_%s.csv", $tmp_name);
			$handle = fopen($filepath,"w+");
			$output_title = array_keys($this->_col_array);
			fputcsv($handle, $output_title);

			foreach ($query->result() as $row)
			{
				$output_content = array();
				foreach ($this->_col_array as $key => $value)
				{
					array_push($output_content, $row->$value);
				}
				fputcsv($handle, $output_content);
			}
		
			fclose($handle);
		}

		if (! $is_file)
		{
			if ($query->num_rows() > 0)
			{
				foreach ($this->_col_array as $key => $value)
				{
					if ($value == "coding") $title = "1.6,097正體中文字部首+筆畫順序編碼 -> 6碼:部首順序(2碼) + 偏旁筆畫(2碼) + 字典排序(2碼)\n2.有無簡化(有簡化:1800,無簡化:3713) -> 1碼: 0(無簡化) 1(有簡化)\n3.對應類別(有簡化:59+4,無簡化:199+16+2) -> 1碼: 0(無簡化) 1(對應第一字) 2(對應第二字) 3(對應第三字)";
					else if ($value == "NSC87") $title = "國語推行委員會（2000）：《八十七年常用語詞調查報告書》。台北：教育部";
					else $title = "";
					$result_table .= sprintf("<tr><td align='left'><a title=\"%s\"><strong>%s</strong></a></td>", $title, $key);
					for ($i = 0; $i < $query->num_rows(); $i++)
					{
						$result_table .= "<td align='left'>" . $query->result()[$i]->$value . "</a></td>";
					}
					$result_table .= "</tr>";
				}
				$temp_data['table-content'] = $result_table;
			}

			$temp_data['result-download'] = sprintf("<div class=\"box-header\"><i class=\"fa fa-download\"></i><h3 class=\"box-title\">下載查詢結果</h3></div><!-- /.box-header -->&nbsp;&nbsp;&nbsp;<a href=\"/dictionary/downloadcsv/%s/csv\"><button type=\"button\" class=\"btn btn-default\" id=\"downloadc\">CSV</button></a></br></br>
<div class=\"box-header\"><i class=\"fa fa-download\"></i><h3 class=\"box-title\">瀏覽資料</h3></div><!-- /.box-header -->&nbsp;&nbsp;&nbsp;<a href=\"/dictionary/data/character/%s\" target=\"_blank\"><button type=\"button\" class=\"btn btn-default\">資料</button></a></br></br>", $tmp_name, urlencode($json_ch));
			$temp_data['rm_tmp'] = sprintf("<input type=\"hidden\" name=\"rm_tmp\" value=\"%s\">", $tmp_name);
		}
		else
		{
			$temp_data['page_file_search'] = sprintf("<div class=\"box-header\"><i class=\"fa fa-download\"></i><h3 class=\"box-title\">下載查詢結果</h3></div><!-- /.box-header -->&nbsp;&nbsp;&nbsp;<a href=\"/dictionary/downloadcsv/%s/csv\"><button type=\"button\" class=\"btn btn-default\" id=\"downloadc\">CSV</button></a><div id=\"active-type\" class=\"character\"></div></br></br>", $tmp_name);
			$temp_data['page_rm_tmp'] = sprintf("<input type=\"hidden\" name=\"rm_tmp\" value=\"%s\">", $tmp_name);
		}

		$this->db->close();

		if ($tmp_name == 'json')
		{
			return $json_data;
		}
		else
		{
			return $temp_data;
		}
	}
}
