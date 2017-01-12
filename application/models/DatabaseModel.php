<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DatabaseModel extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		#common function of DML commands
		function access_database($tablename, $mode, $data_array, $where_array, $join_array=""){
		if($mode == 'select')
		{
			$this->db->select('*');
			$this->db->from($tablename);
			if($where_array!='')
				$this->db->where($where_array);

			if($join_array != '' && $join_array[0] == 'limit'){
				$this->db->limit($join_array[1], $join_array[2]);
			}

			$rs=$this->db->get();
			return $rs->result_array();
		}
		elseif($mode=='wherein'){
		    $this->db->select("*");
		    $this->db->from($tablename);
            $this->db->where_in($join_array , $data_array);
            if($where_array!='')
				$this->db->where($where_array);

            $rs=$this->db->get();
			return $rs->result_array();
		}
		elseif($mode=='insert'){
			$this->db->insert($tablename,$data_array);
			return $this->db->insert_id();
		}
		elseif($mode=='update'){
			$this->db->where($where_array);
			$this->db->update($tablename,$data_array);
		}
		elseif($mode=='delete'){
			$this->db->delete($tablename,$where_array);
		}
		elseif($mode == 'like')
		{
			$this->db->select('*');
			$this->db->from($tablename);
			$this->db->like($where_array);
			if($join_array != ''){
			    $this->db->or_like($join_array);
			}
			if($data_array != '') {
			    $this->db->having($data_array);
			}
			$rs=$this->db->get();
			return $rs->result_array();
		}
		elseif($mode=='orderby'){
		    $this->db->select('*');
			$this->db->from($tablename);
			if($where_array!='')
				$this->db->where($where_array);

			$this->db->order_by($data_array[0], $data_array[1]);
			$rs=$this->db->get();
			return $rs->result_array();

		}
		elseif($mode=='totalvalue'){
		    $this->db->select("SUM(".$data_array[0].") AS ".$data_array[1]."");
            $this->db->from($tablename);
            if($where_array!='')
				$this->db->where($where_array);

            $rs=$this->db->get();
			return $rs->result_array();

		}
		elseif($mode=='groupby'){
		    $this->db->select('*');
			$this->db->from($tablename);
			if($where_array!='')
				$this->db->where($where_array);

			$this->db->group_by($data_array);
			$rs=$this->db->get();
			return $rs->result_array();

		}
		elseif($mode=='join_order_limit'){
		    $this->db->select('*');
			$this->db->from($tablename);
			$this->db->join($join_array[0], $join_array[1]);
			if($where_array!='')
				$this->db->where($where_array);

			$this->db->order_by($data_array[0], $data_array[1]);
			$this->db->limit($join_array[2], $join_array[3]);
			$rs=$this->db->get();
			return $rs->result_array();

		}
		elseif($mode == 'select_like')
		{
			$this->db->select('*');
			$this->db->from($tablename);
			if($where_array!='')
				$this->db->where($where_array);

            if($data_array!='')
                $this->db->like($data_array);

            if($join_array!='')
                $this->db->where_in($join_array[0] , json_decode($join_array[1]));

			$rs=$this->db->get();
			return $rs->result_array();
		}
		elseif($join_array != ''){
			$this->db->select('*');
			$this->db->from($tablename);
			$this->db->join($join_array[0], $join_array[1]);

			if($where_array!='')
				$this->db->where($where_array);

			$rs=$this->db->get();
			return $rs->result_array();
		}
	}


	function select_data($field , $table , $where = '' , $limit = '' , $join_array = ''){
		$this->db->select($field);
		$this->db->from($table);
		if($where != ""){
			$this->db->where($where);
		}

		if($join_array != ''){
			if(in_array('multiple',$join_array)){
				foreach($join_array['1'] as $joinArray){
					$this->db->join($joinArray[0], $joinArray[1]);
				}
			}else{
				$this->db->join($join_array[0], $join_array[1]);
			}
		}


		if($limit != ""){
			if(count($limit)>1){
				$this->db->limit($limit['0'] , $limit['1']);
			}else{
				$this->db->limit($limit);
			}

		}
		return $this->db->get()->result_array();
	}
}
?>
