<?php

Class j3databox extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //--------databox_search
    function get_Databox_search($test) {
        $fromdate = $this->input->post("from-date");
        $databox_search = $this->input->post("databox_search");
        $search = $this->input->post("search");
        $secrets_id = $this->input->post("secrets_id");
        $id_box = $this->input->post("id_box");
    
        $type_dataId_n = $this->input->post("type_dataId_n");
        $type_divisid_n = $this->input->post("type_divisid_n");
   
        $begin_fromdate = "";
        $begin_ex = explode("/", $fromdate);
        if ($fromdate != "") {
            $begin_fromdate = $begin_ex[2] . "-" . $begin_ex[0] . "-" . $begin_ex[1];
        }
        $todate = $this->input->post("to-date");
        $todate_end = "";
        $todate_ex = explode("/", $todate);
        if ($todate != "") {
            $todate_end = $todate_ex[2] . "-" . $todate_ex[0] . "-" . $todate_ex[1];
        }
        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('data_group_main','data_group.divisId = data_group_main.id','LEFT')
                ->join('division', 'division.divisid = data_group_main.fk_id', 'LEFT')
                ->join('data_type', 'data_type.type_id = data_group.dataId', 'LEFT');
        if($this->session->userdata('secret')!=2){$this->db->where('secret_id <', 4);}

        if ($begin_fromdate != "") {
            $this->db->where("databox_upload.date_upload BETWEEN  '$begin_fromdate' AND '$todate_end'", NULL, FALSE);
            if ($databox_search != "") {
                $this->db->or_where('databox_upload.subject like', '%' . $databox_search . '%');
                $this->db->or_where('databox_upload.databox_search like', '%' . $databox_search . '%');
                $this->db->or_where('databox_upload.databox_detail like', '%' . $databox_search . '%');
               $this->db->where('databox_upload.secret_id like', '%' . $secrets_id . '%');
            }
        }
        if ($begin_fromdate == "") {
            if ($search == "") {
                if ($type_dataId_n == "") {
                    if ($type_divisid_n == "") {
                  $this->db->where('databox_upload.subject like', '%' . $databox_search . '%');
                  $this->db->where('databox_upload.secret_id like', '%' . $secrets_id . '%');
                    }
                }
            }
        }

        if ($databox_search != "") {
            $this->db->or_where('databox_upload.subject like', '%' . $databox_search . '%');
            $this->db->or_where('databox_upload.databox_search like', '%' . $databox_search . '%');
            $this->db->or_where('databox_upload.databox_detail like', '%' . $databox_search . '%');
            $this->db->where('databox_upload.secret_id like', '%' . $secrets_id . '%');
        }
        if ($search != "") {
            $this->db->where('databox_upload.subject like', '%' . $search . '%');
            $this->db->or_where('databox_upload.databox_search like', '%' . $search . '%');
            $this->db->or_where('databox_upload.databox_detail like', '%' . $search . '%');
        }
        if ($id_box != "") {
            $this->db->where('databox_upload.databox_id like','%' . $id_box . '%' );
            $this->db->where('databox_upload.databox_id like', '%%');
        }
             
          
         if ($type_dataId_n != "") {
        $this->db->or_where('data_group.dataId like', '%' . $type_dataId_n .'%');
         }
          if ($type_divisid_n != "") {
        $this->db->or_where('data_group.divisId like', '%'.$type_divisid_n. '%');
          }
        $this->db->limit($test, $this->uri->segment(3));
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_Databox_search_num() {
        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
               ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('data_group_main','data_group.divisId = data_group_main.id','LEFT')
                ->join('division', 'division.divisid = data_group_main.fk_id', 'LEFT')
                ->join('data_type', 'data_type.type_id = data_group.dataId', 'LEFT');
        if($this->session->userdata('secret')!=2){$this->db->where('secret_id <', 4);}
        $this->db->order_by('databox_upload.databox_id', 'DESC');
        //$this->db->limit($test,$this->uri->segment(3));
        $query = $this->db->get();
        return $query->result_array();
    }

//------loading scrollbar
    function get_num_index() {
        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('division', 'division.group_Id = data_group.group_Id', 'LEFT');
        $this->db->order_by("databox_id", "desc");

        return $this->db->count_all_results();
    }

//------ที่เพิ่มใหม่    นับจำนวนเอกสารแต่ละกอง
    function get_num_box($groupID) {
        $this->db->select('*')->from('databox_upload')
                ->where('group_id', $groupID);
        return $this->db->count_all_results();
    }

    function get_num_box_week($groupID) {
        $this->db->select('*')->from('databox_upload')
                ->where('group_id', $groupID)
                ->where('date_upload >', mdate("%Y-%m-%d", strtotime("-8 days")));
        return $this->db->count_all_results();
    }

//------------------------------------------ ค้นหาข้อมูล
    function get_search() {
        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('data_group_main','data_group.divisId = data_group_main.id','LEFT')
                ->join('division', 'division.divisid = data_group_main.fk_id', 'LEFT');
        $this->db->order_by("databox_upload.databox_id", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_Databox($test) {
        if (isset($_POST['data_group'])) {
            $temp = $_POST['data_group'];
        } else {
            $temp = "";
        }
        if (isset($_POST['divis_id'])) {
            $temp2 = $_POST['divis_id'];
        } else {
            $temp2 = "";
        }
        if (isset($_POST['data_group_main_id'])) {
            $temp_group_main = $_POST['data_group_main_id'];
        } else {
            $temp_group_main = "";
        }

        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('data_group_main','data_group.divisId = data_group_main.id','LEFT')
                ->join('division', 'division.divisid = data_group_main.fk_id', 'LEFT');
        $this->db->where('data_group.group_Id like', '%' . $temp . '%');
        $this->db->where('data_group_main.id like', '%' . $temp_group_main . '%');
        $this->db->where('division.divisId like', '%' . $temp2 . '%');
        if($this->session->userdata('secret')!=2){$this->db->where('secret_id <', 4);}
        $this->db->order_by('databox_upload.databox_id', 'DESC');
        $this->db->limit($test, $this->uri->segment(3));
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_Databox_num($test) {

        if (isset($_POST['data_group'])) {
            $temp = $_POST['data_group'];
        } else {
            $temp = "";
        }
        if (isset($_POST['divis_id'])) {
            $temp2 = $_POST['divis_id'];
        } else {
            $temp2 = "";
        }
        if (isset($_POST['data_group_main_id'])) {
            $temp_group_main = $_POST['data_group_main_id'];
        } else {
            $temp_group_main = "";
        }

        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('data_group_main','data_group.divisId = data_group_main.id','LEFT')
                ->join('division', 'division.divisid = data_group_main.fk_id', 'LEFT');
        $this->db->where('data_group.group_Id like', '%' . $temp . '%');
        $this->db->where('data_group_main.id like', '%' . $temp_group_main . '%');
        $this->db->where('division.divisId like', '%' . $temp2 . '%');
        if($this->session->userdata('secret')!=2){$this->db->where('secret_id <', 4);}
        $this->db->order_by('databox_upload.databox_id', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

//---------------------------------------- หน้าแรก
    function get_Last_Update() {
        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('data_group_main','data_group.divisId = data_group_main.id','LEFT')
                ->join('division', 'division.divisid = data_group_main.fk_id', 'LEFT')
                ->join('data_type', 'data_type.type_id = data_group.dataId', 'LEFT');
        $this->db->order_by('databox_upload.databox_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_unit() {
        $sql = "SELECT  * FROM `division`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

//---------------------------------------- จบหน้าแรก
//---------------------------------------- หน้าภารกิจ

    function get_data_group() {
        $this->db->select('*')->from('data_group');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_type() {
        $sql = "SELECT  * FROM data_type";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_data_type_ms() {

        $this->db->select('*')->select('data_group.dataId')->from('data_group')
        ->join('data_type','data_type.type_id = data_group.dataId', 'LEFT');
        $this->db->where('data_group.dataId = data_type.type_id');
        $this->db->group_by('data_group.dataId');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_division_group() {
        $sql = "SELECT  * FROM  division_group";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
       function get_division_group_search() {
      
        
        
               $this->db->select('*')->select('division.divisid')->from('division')
               ->join('data_group_main','division.divisid = data_group_main.fk_id','LEFT')
                ->join('data_group', 'data_group.divisId = data_group_main.id', 'LEFT');
               $this->db->group_by('division.divisid');
          $query = $this->db->get();
        return $query->result_array();
    }

    function get_division_group_division() {
        $this->db->select('*')->from('division_group')
                ->join('division', 'division.group_Id = division_group.group_Id', 'LEFT');
        //->group_by('division_group.group_Id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_division_by() {
        //$sql = "SELECT * FROM 'division_group' LEFT JOIN 'division' ON 'division'.'group_Id' = 'division_group'.'group_Id' GROUP BY 'division_group'.'group_Id'";
        //$sql = $this->db->select('*')->from('division_group')->join('division','division.group_Id = division_group.group_Id','LEFT')->group_by("division_group.group_Id");
        $sql = "SELECT * FROM division_group LEFT JOIN division ON division.group_Id = division_group.group_Id GROUP BY division_group.group_Id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_data_group_box() {
        $select_disvisid = $this->input->post("select_disvisid");
        $select_disvisid_ex = explode("-", $select_disvisid);
        $data_group = $this->input->post("data_group");



        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('data_group_main','data_group.divisId = data_group_main.id','LEFT')
                ->join('division', 'division.divisid = data_group_main.fk_id', 'LEFT');
        $this->db->where('data_group.group_Id like', '%' . $select_disvisid_ex[0] . '%');
        $this->db->where('division.divisId like', '%' . $select_disvisid_ex[1] . '%');
        $this->db->order_by('databox_upload.databox_id', 'DESC');




        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_group_table() {
        $data_group = $this->input->post("data_group");
        $divis_id = $this->input->post("divis_id");

        $this->db->select('*')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('data_group_main','data_group.divisId = data_group_main.id','LEFT')
                ->join('division', 'division.divisid = data_group_main.fk_id', 'LEFT')
                ->join('division_group', 'division_group.group_Id = division.group_Id', 'LEFT');
        $this->db->like('division_group.group_Id', $data_group, 'none');
        $this->db->like('databox_upload.division_id', $divis_id);
        $this->db->like('databox_upload.group_Id', $data_group);
        $this->db->order_by('databox_upload.databox_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_division() {
        $sql = "SELECT  * FROM  division,data_group where division.divisId=data_group.divisId";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
     function get_databox_upload($test) {
        
        $this->db->select('*')->from('databox_upload');
        $this->db->limit($test, $this->uri->segment(3));
        $query = $this->db->get();;
        return $query->result_array();
    }
         function get_databox_upload_num() {
        $this->db->select('*')->from('databox_upload');

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_Databox_if() {
        $group_Id = $this->input->post("group_Id");
        $select_id = $this->input->post("select_id");
        $select_id_type = $this->input->post("select_id_type");
        $select_disvisid = $this->input->post("select_disvisid");
        $select_disvisid_ex = explode("-", $select_disvisid);
        if ($select_disvisid_ex[1] != "type_id") {
            if ($select_id_type == "") {


                $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('data_group_main','data_group.divisId = data_group_main.id','LEFT')
                ->join('division', 'division.divisid = data_group_main.fk_id', 'LEFT')
                        ->join('division_group', 'division.group_id = `division_group.group_Id', 'LEFT');
                $this->db->where('division_group.group_id like', '%' . $select_disvisid_ex[0] . '%');
                $this->db->where('division.divisId like', '%' . $select_disvisid_ex[1] . '%');
                if (isset($select_disvisid_ex[2])) {
                    $select_disvisid_ex2 = $select_disvisid_ex[2];
                    if ($select_disvisid_ex[2] == "box") {
                        $select_disvisid_ex2 = "";
                    }
                } else {
                    $select_disvisid_ex2 = "";
                }
                $this->db->where('databox_upload.group_Id like', '%' . $select_disvisid_ex2 . '%');
                $this->db->order_by('databox_upload.databox_id', 'DESC');
            }
        }


        if ($select_disvisid_ex[1] == "type_id") {
            $this->db->select('*')->select('data_group.dataId')->from('data_group')
                    ->join('data_type', 'data_type.type_id = data_group.dataId', 'LEFT')
                    ->join('databox_upload', 'databox_upload.group_id = data_group.group_id', 'LEFT');
            $this->db->where('data_type.type_id', $select_disvisid_ex[0]);
            $this->db->where('databox_upload.subject !=', 'null');
            if (isset($select_disvisid_ex[2])) {
                $select_disvisid_ex2 = $select_disvisid_ex[2];
            } else {
                $select_disvisid_ex2 = "";
            }
            $this->db->where('data_group.group_id like', '%' . $select_disvisid_ex2 . '%');
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_box_detail() {
        $data1 = $this->input->post("data1");
        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('division',  'division.divisid = data_group.group_Id', 'LEFT')
                ->join('data_type', 'data_type.type_id = data_group.dataId', 'LEFT');
        $this->db->where('databox_upload.databox_id ',$data1);
        $query = $this->db->get();
        return $query->result_array();
    }

//----------------------------------------จบหน้าภารกิจ
//-----------------------------------------หน้าอัพโหด

    function get_division_group_re() {
        $sql = "SELECT  * FROM  `division_group`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_upload($test) {

        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('division', 'division.divisid = data_group.divisid', 'LEFT')
                ->join('data_type', 'data_type.type_id = data_group.dataId', 'LEFT')
                ->join('division_group', 'division_group.group_Id = data_group.divisId', 'LEFT')
                ->join('secrets', 'secrets.id = databox_upload.secret_id', 'LEFT');
        $this->db->where('databox_upload.user_id', $this->session->userdata('username'));
        $this->db->limit($test, $this->uri->segment(3));

        $query = $this->db->get();
        return $query->result_array();

        /* 	$sql = "SELECT  * FROM  databox_upload";
          $query = $this->db->query($sql);
          return $query->result_array();
         */
    }

    function get_upload_num($test) {

        $this->db->select('*')->select('databox_upload.group_Id')->from('databox_upload')
                ->join('data_group', 'data_group.group_Id = databox_upload.group_Id', 'LEFT')
                ->join('division', 'division.divisid = data_group.divisid', 'LEFT')
                ->join('data_type', 'data_type.type_id = data_group.dataId', 'LEFT')
                ->join('division_group', 'division_group.group_Id = data_group.divisId', 'LEFT')
                ->join('secrets', 'secrets.id = databox_upload.secret_id', 'LEFT');
        $this->db->where('databox_upload.user_id', $this->session->userdata('username'));
        $query = $this->db->get();
        return $query->result_array();

        /* 	$sql = "SELECT  * FROM  databox_upload";
          $query = $this->db->query($sql);
          return $query->result_array();
         */
    }

//----------------------------------------- หน้าแสดงข้อมูลหลังจากค้นหา
//-----------------------------------------หน้าอัพโหด


    function get_data_group_up() {
        $sql = "SELECT  * FROM  data_group";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_division_group_up() {
        $sql = "SELECT  * FROM  division_group";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_division() {
        $sql = "SELECT * FROM division";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_data_type_up() {

        $this->db->select('*')->select('data_group.dataId')->from('data_group')
                ->join('data_type', 'data_type.type_id = data_group.dataId', 'LEFT');
        $this->db->where('data_group.dataId = data_type.type_id');
        $this->db->group_by('data_group.dataId');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_data_group_main() {
     
          $this->db->select('*')->select('data_group_main.id')->from('data_group_main')
                ->join('data_group', 'data_group_main.id = data_group.divisId', 'LEFT');
            $this->db->group_by('data_group_main.id');
        $query = $this->db->get();
        return $query->result_array();

    }
    function get_data_type_search() {

        $this->db->select('*')->select('data_type.type_id')->from('data_type')
                ->join('data_group', 'data_group.dataId = data_type.type_id', 'LEFT');
        $this->db->group_by('data_type.type_id');
        $query = $this->db->get();
        return $query->result_array();
    }

//----------------------------------------- หน้าแสดงข้อมูลหลังจากค้นหา
}

?>
