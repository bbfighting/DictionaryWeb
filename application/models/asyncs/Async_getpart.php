<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****
 *** Website Model ***
 *** Model Name: Page_Contact
 *** Description: Load the contact page contents
 *
 *****/
 
class Async_getpart extends CI_Model { 
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
		$result_array = array();
		$result_str = "";
		$j = 0;

		$part = urldecode($arguments_list['ch']);
		$json_ch = $part;
		$part = preg_replace('/(\s+)$/', '', $part);
		$part_list = preg_split('/\s+|,/', $part);		

		if ($tmp_name != 'json')
		{
			$tmp_name = time();
			$filepath = sprintf("download/result_%s.csv", $tmp_name);
			$handle = fopen($filepath,"w+");
			fputcsv($handle, array('input', 'result'));
		}
		$json_array = array();

		foreach ($part_list as $temp_part)
		{
			$sub_part = $this->mb_str_split($temp_part);
			for ($i = 0; $i < sizeof($sub_part); $i++)
			{
				if ($sub_part[$i] == "﻿")
				{
					unset($sub_part[$i]);
				}
			}

			$re_part = implode(".*", $sub_part);

			// Initialization
			$sql = "SELECT a.part, b.traditional FROM item_part a, character_coding b WHERE a.part REGEXP '$re_part' and a.coding = b.coding";

			$query = $this->db->query($sql);

			if ($query->num_rows() > 0)
			{
				$temp_str = "";
				$temp_json_array = array();
				$temp_json_array['input'] = $temp_part;

				foreach ($query->result() as $row)
				{
					$temp_str .= $row->traditional;
					$j ++;
					if ($j % 40 == 0)
					{
						//array_push($result_array, $row->traditional . "</br>");
						$result_str .= $row->traditional . "&nbsp;&nbsp;&nbsp;</br>";
					}
					else
					{
						$result_str .= $row->traditional . "&nbsp;&nbsp;&nbsp;";
						//array_push($result_array, $row->traditional);
					}
				}
				$temp_json_array['result'] = $temp_str;
				array_push($json_array, $temp_json_array);

				$temp_data['table-content'] = "<tr><td>" . $result_str . "</tr></td>";
			}
			if ($tmp_name != 'json')
			{
				fputcsv($handle, array($temp_part, $temp_str));
			}
		}
		$json_data = json_encode($json_array, JSON_UNESCAPED_UNICODE);

		if (! $is_file)
		{
			$temp_data['result-download'] = sprintf("<div class=\"box-header\"><i class=\"fa fa-download\"></i><h3 class=\"box-title\">下載查詢結果</h3></div><!-- /.box-header -->&nbsp;&nbsp;&nbsp;<a href=\"/dictionary/downloadcsv/%s/csv\"><button type=\"button\" class=\"btn btn-default\" id=\"downloadc\">CSV</button></a></br></br>
<div class=\"box-header\"><i class=\"fa fa-download\"></i><h3 class=\"box-title\">瀏覽資料</h3></div><!-- /.box-header -->&nbsp;&nbsp;&nbsp;<a href=\"/dictionary/data/part/%s\" target=\"_blank\"><button type=\"button\" class=\"btn btn-default\">資料</button></a></br></br>", $tmp_name, urlencode($json_ch));
			$temp_data['rm_tmp'] = sprintf("<input type=\"hidden\" name=\"rm_tmp\" value=\"%s\">", $tmp_name);
		}
		else
		{
			$temp_data['page_file_search'] = sprintf("<div class=\"box-header\"><i class=\"fa fa-download\"></i><h3 class=\"box-title\">下載查詢結果</h3></div><!-- /.box-header -->&nbsp;&nbsp;&nbsp;<a href=\"/dictionary/downloadcsv/%s/csv\"><button type=\"button\" class=\"btn btn-default\" id=\"downloadc\">CSV</button></a><div id=\"active-type\" class=\"part\"></div></br></br>", $tmp_name);
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

	public function mb_str_split( $string ) { 
	    # Split at all position not after the start: ^ 
	    # and not before the end: $ 
	    return preg_split('/(?<!^)(?!$)/u', $string ); 
	} 
}