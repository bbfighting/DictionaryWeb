<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****
 *** Website Model ***
 *** Model Name: Page_Contact
 *** Description: Load the contact page contents
 *
 *****/
 
class Async_getphone extends CI_Model { 
	// -------- -------- -------- --------
	// Private variables

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
		$phone = urldecode($arguments_list['ch']);
		$json_ch = $phone;
		$phone = preg_replace('/(\s+)$/', '', $phone);
		$phone_list = preg_split('/\s+|,/', $phone);
		$phone_list = array_unique($phone_list);
		$ph_table = $arguments_list['ph_table'];

		$json_array = array();

		$result_table = "<tr><td>";

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

		if ($tmp_name != 'json')
		{
			$tmp_name = time();
			$filepath = sprintf("download/result_%s.csv", $tmp_name);
			$handle = fopen($filepath,"w+");
			$output_title = array();

			$output_title = array_merge($output_title, $col_array['content']);
			$output_title = array_merge($output_title, $col_array['cs']);
			$output_title = array_merge($output_title, $col_array['v']);
			$output_title = array_merge($output_title, $col_array['ce']);
			$output_title = array_merge($output_title, $col_array['tone']);
			fputcsv($handle, array('input', 'result'));
		}


		// Initialization
		$this->load->database();

		foreach ($phone_list as $temp_phone)
		{
			$sql = "SELECT a.*, b.* FROM item_phone a, $ph_table b WHERE (a.bopomofo LIKE '$temp_phone' or a.Pinyin REGEXP '$temp_phone') and a.Code = b.Code";
			$query = $this->db->query($sql);

			if ($query->num_rows() > 0)
			{
				$output_content_csv = array();
				$temp_json_array = array();

				foreach ($query->result() as $row)
				{
					foreach ($col_array as $key => $value) {
						$output_content = array();
						$temp_data['table-' . $key] = "<tr><td>";

						foreach ($value as $col_name) 
						{
							array_push($output_content,  $row->$col_name);
							$temp_json_array[$col_name] = $row->$col_name;				
						}
						$output_content_csv = array_merge($output_content_csv, $output_content);
						$temp_content = implode("</td><td>", $output_content);
						$temp_data['table-' . $key] .= $temp_content . "</td></tr>";
					}
				}
				array_push($json_array, $temp_json_array);

				if ($tmp_name != 'json')
				{
					fputcsv($handle, $output_content_csv);
				}
			}
		}
		$json_data = json_encode($json_array, JSON_UNESCAPED_UNICODE);

		if (! $is_file)
		{
			$temp_data['result-download'] = sprintf("<div class=\"box-header\"><i class=\"fa fa-download\"></i><h3 class=\"box-title\">下載查詢結果</h3></div><!-- /.box-header -->&nbsp;&nbsp;&nbsp;<a href=\"/dictionary/downloadcsv/%s/csv\"><button type=\"button\" class=\"btn btn-default\" id=\"downloadc\">CSV</button></a></br></br>
<div class=\"box-header\"><i class=\"fa fa-download\"></i><h3 class=\"box-title\">瀏覽資料</h3></div><!-- /.box-header -->&nbsp;&nbsp;&nbsp;<a href=\"/dictionary/data/%s/%s\" target=\"_blank\"><button type=\"button\" class=\"btn btn-default\">資料</button></a></br></br>", $tmp_name, $ph_table, urlencode($json_ch));
			$temp_data['rm_tmp'] = sprintf("<input type=\"hidden\" name=\"rm_tmp\" value=\"%s\">", $tmp_name);
		}
		else
		{
			$temp_data['page_file_search'] = sprintf("<div class=\"box-header\"><i class=\"fa fa-download\"></i><h3 class=\"box-title\">下載查詢結果</h3></div><!-- /.box-header -->&nbsp;&nbsp;&nbsp;<a href=\"/dictionary/downloadcsv/%s/csv\"><button type=\"button\" class=\"btn btn-default\" id=\"downloadc\">CSV</button></a><div id=\"active-type\" class=\"phone\"></div></br></br>", $tmp_name);
			$temp_data['page_rm_tmp'] = sprintf("<input type=\"hidden\" name=\"rm_tmp\" value=\"%s\">", $tmp_name);
		}

		$this->db->close();

		if ($tmp_name == 'json')
		{
			return $json_data;
		}
		else
		{
			fclose($handle);
			return $temp_data;
		}
	}
}