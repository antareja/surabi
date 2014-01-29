<?php

/* By Haidar Mar'ie
 * Email = coder5@ymail.com
 https://www.facebook.com/Dlinkerz
 https://www.facebook.com/aan.alfarghani
 https://www.facebook.com/rezaa.LinkinParkSoldiers
 https://www.facebook.com/lilidiayana.fitri
 https://www.facebook.com/hudakhoirullail
 https://www.facebook.com/happy.fernando.50
 
 ok @FAUZI ... coba deh ambil wudhu .. solat 2 rakaat .. lalu liat lagi rumus nya .. biar otak n tubuh nte fresh .. dan dapet jawaban tepat ..
 
  marticle */

class MHadits extends CI_Model {

	private $sqlite;
	public static $db = DBUSE;
	private $DBUSE;
// 	private TABLEUSE = 
	//private $lite;
    function __construct() {
        parent::__construct();
//         $db = $this->
		$this->DBUSE = DBUSE;
// 		$this->had_table = TABLEUSE;
        $this->sqlite = $this->load->database('sqlite', TRUE);
		$lite = $this->load->database('sqlite', TRUE);
    }

    function searchHaditsBool($words, $words_min = NULL,$imam_id, $limit=null) {
        $extract = $words;
        $imam = $imam_id != 0 ? " AND imam_id IN ($imam_id)" : "";
        $sql = "SELECT * FROM ".table_use()." 
				WHERE MATCH (isi_indonesia) AGAINST ('$words $words_min' IN BOOLEAN MODE) $imam

				ORDER BY imam_id ASC;";
        $sqlite_query = "SELECT *,docid, length(isi_indonesia) as simple  FROM ".table_use()."
		        WHERE isi_indonesia MATCH '$words $words_min' $imam
		        ORDER BY imam_id, simple ASC";
        echo "<blockquote><small>".$sqlite_query."</small></blockquote>";
		$msc=microtime(true);
		//echo DBUSE;
        $query = $this->db->query($sqlite_query);
//         $query2 = $this->sqlite->get('had_all_fts4', 10, 20);
        //echo $this->last_query();
		query_exec_time(microtime(true)-$msc);
        return $query;
    }
	
    function searchBabKitab($word, $imam_id){
        $imam = $imam_id != 0 ? " AND imam_id IN ($imam_id)" : "";
    	$sqlite_query = "SELECT * FROM ".table_use()."
		        WHERE isi_indonesia MATCH '$word ' $imam
		        AND type !=1
		        ORDER BY imam_id ASC";
    	debug($sqlite_query);
    	$msc=microtime(true);
    	//echo DBUSE;
    	$query = $this->db->query($sqlite_query);
    	//         $query2 = $this->sqlite->get('had_all_fts4', 10, 20);
    	//echo $this->last_query();
    	query_exec_time(microtime(true)-$msc);
    	return $query;
    }
    function searchHaditsNo($imam_id, $no) {
        $sql = "SELECT h.*, kitab_indonesia, bab_indonesia FROM had_all_fts4_content  h
				INNER JOIN kitab_all k ON h.".field('kitab_imam_id')." = k.kitab_imam_id
				INNER JOIN bab_all b ON h.".field('bab_imam_id')." = b.bab_imam_id
				WHERE ".field("imam_id"). "=".$imam_id." 
				AND ".field("no_hdt"). "=". $no 
        		." GROUP BY h.docid";
        debug($sql);
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query;
    }

    // SEARCH BY ARAB
    function searchHaditsBoolArab($words, $words_min = NULL,$imam_id, $pages=null) {
        $extract = $words;
        $imam = $imam_id != 0 ? " AND imam_id IN ($imam_id)" : "";
        $sql = "SELECT * FROM `had_all_fts4` 
		    	WHERE MATCH (isi_arab) AGAINST ('$words $words_min' IN BOOLEAN MODE) $imam
		    	ORDER BY imam_id ASC;
		    	";
        $sqlite = "SELECT * FROM `had_all_fts4`
		        WHERE isi_arab MATCH '$words $words_min' $imam
		        ORDER BY imam_id ASC LIMIT ".$limit .",40";
        debug($sqlite);
        //die($sql);exit;
        $msc=microtime(true);
        $query = $this->db->query($sqlite);
		query_exec_time(microtime(true)-$msc);
        return $query;
    }
    
    // SEARCH BY ARAB Gundul
    function searchHaditsBoolArabGundul($words, $words_min = NULL,$imam_id, $pages=null) {
    	$extract = $words;
    	$imam = $imam_id != 0 ? " AND imam_id IN ($imam_id)" : "";
    	$sql = "SELECT * FROM `had_all_fts4`
		    	WHERE MATCH (isi_arab_gundul) AGAINST ('$words $words_min' IN BOOLEAN MODE) $imam
		    	ORDER BY imam_id ASC;
    	";
    	$sqlite = "SELECT * FROM `had_all_fts4`
			    	WHERE isi_arab_gundul MATCH '$words $words_min' $imam
			    	ORDER BY imam_id ASC LIMIT ".$limit .",40";
        debug($sqlite);
    	//die($sql);exit;
    	$msc=microtime(true);
    	$query = $this->db->query($sqlite);
    	query_exec_time(microtime(true)-$msc);
    	return $query;
    }
	
	
    function searchHaditsLike($words,$imam_id) {
        $extract = $words;
        $imam = $imam_id != 0 ? " AND imam_id IN($imam_id)" : "";
        $sql = "SELECT * FROM `had_all_fts4` WHERE isi_indonesia LIKE '%$words%' $imam";
        //debug($sql);
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query;
    }

    function searchHaditsLikeExact($words,$imam_id) {
        $extract = $words;
        $imam = $imam_id != 0 ? " AND imam_id IN($imam_id)" : "";
        $sql = "SELECT * FROM `had_all_fts4` WHERE isi_indonesia LIKE '$words' $imam";
        //debug($sql);
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query;
    }

    function searchHaditsLikeArab($words,$imam_id) {
        $extract = $words;
        $imam = $imam_id != 0 ? " AND imam_id IN($imam_id)" : "";
        $sql = "SELECT * FROM `had_all_fts4` WHERE isi_arab_Gundul LIKE '%$words%' $imam";
        //debug($sql);
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query;
    }

    function searchHaditsLikeExactArab($words,$imam_id) {
        $extract = $words;
        $imam = $imam_id != 0 ? " AND imam_id IN($imam_id)" : "";
        $sql = "SELECT * FROM `had_all_fts4`  
        		WHERE isi_arab_Gundul LIKE '% $words %' $imam";
        //debug($sql);
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query;
    }

    function getAllKitab($imam) {
        $sql = "SELECT * FROM kitab_all 
        		WHERE imam_id =" . imam_id($imam);
        // debug($sql);
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query->result();
    }
	
    function getIdKitab($imam, $kitab_imam_id) {
        $sql = "SELECT * FROM kitab_all 
        		WHERE imam_id =". imam_id($imam) ."
        		AND kitab_imam_id=". $kitab_imam_id;
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query->row();
    }

    function getAllBab($imam, $kitab_imam_id) {
        $sql = "SELECT * FROM bab_all 
        		WHERE imam_id=" . imam_id($imam) ."
        		AND kitab_imam_id =" .$kitab_imam_id ;
        // debug($sql);
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query->result();
    }

    function getIdBab($imam, $bab_imam_id) {
        $sql = "SELECT * FROM bab_all  
        		WHERE imam_id=" . imam_id($imam) ."
        		 AND bab_imam_id=".$bab_imam_id;
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query->row();
    }

    function getTemaIdBab($imam, $bab_imam_id) {
        $sql = "SELECT ".field('no_hdt').",".field('tema') .",".field('isi_indonesia')." FROM had_all_fts4_content 
        		WHERE ".field('imam_id') ." =" .imam_id($imam) 
        		." AND ".field('type')."=1 AND ".field('bab_imam_id') ."=".  $bab_imam_id;
        debug($sql);
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query;
    }

    function getHaditsIdHdt($imam, $id_hadits) {
        $sql = "SELECT * FROM had_all_fts4_content 
        		WHERE ".field('imam_id') ." =" . imam_id($imam) ."
        				AND ".field('no_hdt') ."=" . $id_hadits ;
        debug($sql);
        $msc=microtime(true);
        $query = $this->db->query($sql);
		query_exec_time(microtime(true)-$msc);
        return $query->row();
    }

}