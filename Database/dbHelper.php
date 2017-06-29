<?php
class dbHelp{
	public static $connect;
	public static function connect(){
		try {
		$connect = new PDO('mysql:host=localhost;dbname=anonymousblog;charset=utf8mb4', 'root', '8zxrknec');
		} catch (PDOException $e) {
			    print "Error!: " . $e->getMessage() . "<br/>";
    			die("Oops something went wrong!");
		}
		return $connect;
	}
	public static function insert($table,$array){
		if(!empty($table) && !empty($array)){
			$keys = '';
			$keysForValues = '';
			$insertKeyValueArray = array();
			foreach($array as $key => $value){
	            $keys .= $key.",";
	            $keysForValues .= ':'.$key.",";
	            $insertKeyValueArray[":".$key] = $value;
        	}
            $keys = rtrim($keys, ',');
            $keysForValues = rtrim($keysForValues, ',');
			$stmt = self::connect()->prepare("INSERT INTO $table ($keys) VALUES ($keysForValues)");
			return $stmt->execute($insertKeyValueArray) ? TRUE : FALSE;
		}
	}
	public static function select($what = "*",$table,$fields = []){
		if(!empty($table)){
			$selectKeyValueArray = array();
			$keysForWhere = '';
			foreach($fields as $key => $value){
				$selectKeyValueArray[":".$key] = $value;
			}
			$where = getWhere($fields);
			$stmt = self::connect()->prepare("SELECT $what FROM $table $where");
			$stmt->execute($selectKeyValueArray);
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}
	}
	public static function getWhere($array){
        $where = ' WHERE';
        foreach($array as $key => $value){
            $where .= ' '.$key.' =:'.$key.' AND';
        }
        $where = rtrim($where, 'AND');
        return $where;
    }
}
?>