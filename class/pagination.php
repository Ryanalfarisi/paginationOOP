<?php 
	
	class Pagination{

		private $db, $table, $total_records, $limit = 5;

		//PDO connection
		public function __construct($table){
			$this->table = $table;
			$this->db = new PDO("mysql:host=localhost; dbname=faker", "root", "root");
			$this->set_total_records();
		}

		public function set_total_records(){

			$query  = "SELECT id FROM $this->table";

			if($this->is_search()){
				$val 	= $this->is_search();
				$query  = "SELECT id FROM $this->table WHERE username LIKE '%$val%'";
			}

			$stmt	= $this->db->prepare($query);
			$stmt->execute();
			$this->total_records = $stmt->rowCount();
		}

		public function get_data(){
			$start = 0;
			if($this->current_page() > 1){
				$start = ($this->current_page() * $this->limit) - $this->limit;
			}

			$query  = "SELECT * FROM $this->table LIMIT $start, $this->limit";

			if($this->is_search()){
				$val 	= $this->is_search();
				$query  = "SELECT id FROM $this->table WHERE username LIKE '%$val%' $start, $this->limit";
			}

			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function check_search(){
			if($this->is_search()){
				return '&search='.$this->is_search();
			}
			return '';
		}


		public function is_search(){
			return isset($_GET['search']) ? $_GET['search'] : '';
		}

		public function current_page(){
			return isset($_GET['page']) ? (int)$_GET['page'] :1;
		}

		public function get_pagination_number(){
			return ceil($this->total_records / $this->limit);
		}

		public function prev_page(){
			return ($this->current_page() > 1) ? $this->current_page() : 1;
		}
		public function next_page(){
			return ($this->current_page() < $this->get_pagination_number()) ? $this->current_page()+1 : $this->get_pagination_number();
		}
		public function is_active_class($page){
			return ($page == $this->current_page()) ? 'active' : '';
		}
		
	}


 ?>

