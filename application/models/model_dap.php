

    <?php
     
    class model_dap extends CI_Model {
     
        function __construct() {
            parent::__construct();
     
        }
     
        function insert_csv($data) {
            $this->db->insert('dp_emp', $data);
        }
        
        function insert_csv_ovt($data) {
            $this->db->insert('ovt_transaksi', $data);
        }
		
		function get_db_dko(){
		$query = "SELECT  tgl_input as kategori,
				(SUM(CASE WHEN (tgl_input between DATE_SUB(DATE_SUB(CURDATE(),INTERVAL (DAY(CURDATE())-1) DAY), INTERVAL 1 MONTH) 
				and LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))) THEN actual ELSE 0 END))/ 
				(SUM(CASE WHEN (tgl_input between DATE_SUB(DATE_SUB(CURDATE(),INTERVAL (DAY(CURDATE())-1) DAY), INTERVAL 1 MONTH) 
				and LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))) THEN plan ELSE 0 END)) AS ac_lm,
				(SUM(CASE WHEN (tgl_input between DATE_SUB(DATE_SUB(CURDATE(),INTERVAL (DAY(CURDATE())-1) DAY), INTERVAL 1 MONTH) 
				and LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))) THEN ar ELSE 0 END))/
				(select COUNT(tgl_input) from dko_transaksi where tgl_input between DATE_SUB(DATE_SUB(CURDATE(),INTERVAL (DAY(CURDATE())-1) DAY), INTERVAL 1 MONTH) 
				AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)))AS ar_lm,
				(SUM(CASE WHEN (tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) THEN actual ELSE 0 END))/ 
				(SUM(CASE WHEN (tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) THEN plan ELSE 0 END)) AS ac_tm,
				(SUM(CASE WHEN (tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) THEN ar ELSE 0 END)) /
				(select COUNT(tgl_input) from dko_transaksi where tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS ar_tm
			FROM 
			dko_transaksi";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_db_pck(){
		$query = "SELECT  tgl_input as kategori,
				(SUM(CASE WHEN (tgl_input between DATE_SUB(DATE_SUB(CURDATE(),INTERVAL (DAY(CURDATE())-1) DAY), INTERVAL 1 MONTH) 
				and LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))) THEN actual ELSE 0 END))/ 
				(SUM(CASE WHEN (tgl_input between DATE_SUB(DATE_SUB(CURDATE(),INTERVAL (DAY(CURDATE())-1) DAY), INTERVAL 1 MONTH) 
				and LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))) THEN plan ELSE 0 END)) AS ac_lm,
				(SUM(CASE WHEN (tgl_input between DATE_SUB(DATE_SUB(CURDATE(),INTERVAL (DAY(CURDATE())-1) DAY), INTERVAL 1 MONTH) 
				and LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))) THEN ar ELSE 0 END))/
				(select COUNT(tgl_input) from pck_transaksi where tgl_input between DATE_SUB(DATE_SUB(CURDATE(),INTERVAL (DAY(CURDATE())-1) DAY), INTERVAL 1 MONTH) 
				AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)))AS ar_lm,
				(SUM(CASE WHEN (tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) THEN actual ELSE 0 END))/ 
				(SUM(CASE WHEN (tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) THEN plan ELSE 0 END)) AS ac_tm,
				(SUM(CASE WHEN (tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) THEN ar ELSE 0 END)) /
				(select COUNT(tgl_input) from pck_transaksi where tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS ar_tm
			FROM 
			pck_transaksi";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
        
        
		
    }
    