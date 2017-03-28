<?php
/*****
 *** Website Controller ***
 *** Controller Name: Pages
 *** Description: Load the static pages
 *
 *****/

class Pages extends CI_Controller 
{
    // -------- -------- -------- --------
    // Private variables
    private $_page_pointer = "";
    private $_query_code = "";
    private $_render_jslist = array();
    private $_render_contents = "";

    // -------- -------- -------- --------
    // Load the views
    // -------- -------- -------- --------
    public function view( /*string*/ $fetch_type = "direct", /*string*/ $target_page = "home", $target_type = "csv") 
    {
        // Initialization
        $this->load->library('MenuCreator');
        $this->menucreator->initialize($target_page);
        $this->_page_pointer = $this->menucreator->get_page();
        $temp_tsatamp = time();
        
        // -------- ------- --------
        // ---- Direct Access Page ----
        if ($fetch_type == "direct")
        {
            // Define dead action
            define('DEAD_ACTION', 'home');
            // Preparation for rendering
            call_user_func(array($this, $this->_page_pointer));

            // -------- --------
            // Step 0 - set check token
            $this->session->set_userdata('check_token', $temp_tsatamp);
            
            // Step 1 - get menubar contents
            $render_data = array('render_main_menubar' => $this->menucreator->get_outputs());

            // Step 2 - get script including list
            $render_data['render_main_jslist'] = implode('', array_map(
                function($input_src) {
                    return sprintf("<script type=\"text/javascript\" src=\"/dictionary/jscript/%s.js\"></script>", $input_src);
                }, $this->_render_jslist)
            );
            
            $render_data['render_main_contents'] = preg_replace('/[\n\t]+|\s{2,}/', ' ', $this->_render_contents);
            // -------- --------
            
            // Final Render
            $this->load->view('base', $render_data);
        }
        elseif ($fetch_type == "downloadcsv") 
        {
            $data['time'] = $target_page;
            $data['type'] = $target_type;
            $this->load->view('downloadcsv', $data);
        }
        elseif ($fetch_type == "data") 
        {
            $argumet_keys['ch'] = $target_type;

            if ($target_page == "phone_realvalue" or $target_page == "phone_binary")
            {
                $argumet_keys['ph_table'] = $target_page;
                $target_page = "phone";
            }

            $this->load->model(sprintf('asyncs/async_get%s', $target_page), 'temp_model');

            echo $this->temp_model->get_outputs($argumet_keys, FALSE, 'json');
        }

        // -------- ------- --------
        else exit;
    }
    // -------- -------- -------- --------


    // -------- -------- -------- --------
    // Page Method - 'home'
    // -------- -------- -------- --------
    public function home()
    {  
        // Outputs
        $this->_render_contents = $this->load->view('main_home', '', TRUE);
    }
    // -------- -------- -------- --------


    // -------- -------- -------- --------
    // Page Method - 'search'
    // -------- -------- -------- --------
    public function search()
    {
        if (isset($_FILES["FILE"])) 
        {
            if ($_FILES["FILE"]["size"] != 0)
            {
                $argumet_keys = array();
                $encode_replace = array('GB2312'=>'GBK', 'GBK'=>'GBK', 'EUC-CN'=>'GBK', 'CP936'=>'GB2312');

                $sub_name = explode('.', $_FILES["FILE"]["name"]);

                $this->load->helper('file');

                $file_content = read_file($_FILES["FILE"]['tmp_name']);

                $encoding = mb_detect_encoding($file_content, array('UTF-8', 'GBK', 'BIG5','ASCII'));

                if ($encoding == 'CP936')
                {
                    $file_content = mb_convert_encoding($file_content, 'UTF-8', 'Big5');
                }
                else if (! $encoding)
                {
                    $file_content = mb_convert_encoding($file_content, 'UTF-8', 'Unicode');
                }

                $argumet_keys['ch'] = $file_content;
                $argumet_keys['ph_table'] = $_POST["phoneval"];
                $type = $_POST['search_type'];

                $this->load->model(sprintf('asyncs/async_get%s', $type), 'temp_model');

                $data = $this->temp_model->get_outputs($argumet_keys, TRUE, $sub_name[0]);
            }
            else
            {
                $data['page_file_search'] = '不好意思，檔案內未有資料';
            }
        }
        else
        {
            $data['page_file_search'] = '';
            $data['page_rm_tmp'] = '';
        }
        $this->_render_jslist = array('customs/custom.search'); 
        $this->_render_contents = $this->load->view('main_search', $data, TRUE);        
    }
    // -------- -------- -------- --------

    // -------- -------- -------- --------
    // Asyncs Method - 'rm_file'
    // -------- -------- -------- --------
    public function rm_file()
    {
        $argumet_keys = array('rm_name');

        $sub_name = $this->_load_requests($argumet_keys)['rm_name'];

        $rm_path = sprintf("/home/testuser/public_html/dictionary/download/result_%s.csv", $sub_name);
        if (file_exists($rm_path)) unlink($rm_path);
    }
    // -------- -------- -------- --------   

    // -------- -------- -------- --------
    // Page Method - 'character'
    // -------- -------- -------- --------
    public function character()
    {  
        $this->load->model("pages/page_part", 'part_model');

        echo $this->part_model->get_data_list();
    }
    // -------- -------- -------- --------

    // -------- -------- -------- --------
    // Page Method - 'phone'
    // -------- -------- -------- --------
    public function phone()
    { 
        $argumet_keys = array('ph_table');
        $this->load->model("pages/page_phone", 'phone_model');

        echo $this->phone_model->get_data_list($this->_load_requests($argumet_keys));
    }
    // -------- -------- -------- --------

    // -------- -------- -------- --------
    // Page Method - 'part'
    // -------- -------- -------- --------
    public function part()
    {  
        $this->load->model("pages/page_part", 'part_model');

        echo $this->part_model->get_data_list();
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
?>