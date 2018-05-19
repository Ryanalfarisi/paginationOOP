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
			$stmt	= $this->db->prepare("SELECT id FROM $this->table");
			$stmt->execute();
			$this->total_records = $stmt->rowCount();
		}

		public function get_data(){
			$start = 0;
			if($this->current_page() > 1){
				$start = ($this->current_page() * $this->limit) - $this->limit;
			}
			$stmt = $this->db->prepare("SELECT * FROM $this->table LIMIT $start, $this->limit");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
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

 