<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Application desing and developer by: Palash Kumar
 * email:palash.ict08@yahoo.com
 * Description of common_mod
 *
 * @author Palash
 */
class Common_mod extends CI_Model{
    
     public function __construct()
        {
            parent::__construct();
        }
      
        //insert query//
        public function insert($table=null,$colVal=null){
            $insertedID = 0;
            if(!empty($table) && strlen($table) > 0){
                $rs = $this ->db->insert($table,$colVal);
                if($rs){
                    $insertedID = $this->db->insert_id();
                }
            }
            return $insertedID;
        }
     /* get method is for getting all value without limit and order.
     * $colValArray= array of column and value for making wehere condition
     */
    public function getColsVal($tbl=null,$cols=null,$condition=null){
        if($tbl != "" && strlen($tbl) > 0 && !empty($cols) && strlen($condition) > 0){
            $sql = "SELECT ";
            for($i = 0;$i < sizeof($cols);$i++){
                $sql .=$cols[$i].",";
            }
            $last = $sql[strlen($sql)-1]; 
            if($last==","){
                $sql = substr($sql,0, -1);
            }
            $sql .= " FROM ".$tbl." WHERE 1 = 1 ".$condition;
            $q = $this->db->query($sql);
            $totalRows = $q->num_rows();
            $rows = $q->result_array();        
        }
        return array('rows'=>$rows,'totalRows'=>$totalRows);
    }    
    public function get($tbl=null,$colValArray=null,$condition=null){
        if($tbl != "" && strlen($tbl) > 0){
             $sql="SELECT * FROM ".$tbl." WHERE 1=1 ";
             if(!empty($colValArray)){
                  foreach($colValArray as $key=>$val){
                      $sql.=" AND ".$this->db->escape($key)."='".$this->db->escape($val)."' ";
                  }
              }
              if($condition != null && strlen($condition) > 0){
                $sql .= " ".$condition." ";
              }
              $q = $this->db->query($sql);
              $totalRows=$q->num_rows();
              $rows = $q->result_array();
          } 
        return array('rows'=>$rows,'totalRows'=>$totalRows);
    }    
    
    public function getCount($table=null,$colValArray=null,$condition=null){
        $count = 0;
        if($table != "" && strlen($table) > 0){
            $sql="SELECT COUNT(id) as total FROM ".$table." WHERE 1=1 ";
            if(!empty($colValArray)){
                  foreach($colValArray as $key=>$val){
                      $sql.=" AND ".$key."=".$this->db->escape($val)." ";
                  }
              }
              if($condition != null && strlen($condition) > 0){
                      $sql .= " ".$condition." ";
              }
              $query = $this->db->query($sql);
              $result = $query->result();
              $count = $result[0]->total ;
        }
        return $count;
    }

    public function getSpecificColVal($table=null,$colName=null,$condition=null){
        $sql="SELECT ";
        if(!empty($colName)){
            $sql.=" ".$colName." FROM ".$table." WHERE 1=1 ";
            if($condition != null && strlen($condition) > 0){
                $sql .= " ".$condition." ";
            }
            $query=$this->db->query($sql);
            if($query->num_rows()>0){
                $result=$query->result()[0];
                $colval = $result->$colName;
            }else{
                $colval = "";
            }
            return $colval;
        }
    }
    
    public function checkExsistance($tbl=null,$colName=null,$condition=null){
        
    }
    
    public function updateVal($table=null,$colVal=null,$conditionArray = null,$condition=null){
        $hasUpdated = false;
        if($table != "" && strlen($table) > 0){
            $sql="UPDATE ".  $table." SET ";
            if(!empty($colVal) && (!empty($condition) || !empty($conditionArray))){
                if(!empty($colVal) && sizeof($colVal) > 0){
                    foreach ($colVal as $key=>$val){
                        $sql.=" ".$key."=".$this->db->escape($val).",";
                     }
                     if($sql!=""){
                         $last = $sql[strlen($sql)-1]; 
                         if($last==","){
                             $sql=  substr($sql,0, -1);
                         }
                     }
                   
                    $sql.=" WHERE 1=1 ";
                    if(!empty($conditionArray) && sizeof($conditionArray) > 0){
                        foreach($conditionArray as $key=>$val){
                            $sql.="AND ".$key."=".$this->db->escape($val)."";
                        }
                    }
                    if($condition != null && strlen($condition) > 0){
                      $sql .= " ".$condition." ";
                    }
                    $q=$this->db->query($sql);
                    if($q){
                        $hasUpdated = true;
                    }
                }
            }
        }
        return $hasUpdated;
    }
    
    public function delete($tableName = null,$data = null){
        $result = "";
        if(strlen($tableName) > 0 && !empty($data)){
            foreach ($data as $key => $value) {
                $this->db->where($key,$value);
            }
            $result = $this->db->delete($tableName);
        }
        return $result;
    }
    
    public function insertBatch($tableName = null,$batch = null){
        $insertedID = 0;
        if(strlen($tableName) > 0 && !empty($batch)){
            $this->db->insert_batch($tableName,$batch);
            $insertedID = $this->db->insert_id();
        }
        return $insertedID;
    }
    
    public function runQuery($sql = null){
        $query = null;
        if(strlen($sql) > 0){
            $query = $this->db->query($sql);
        }
        return $query;
    }
}

?>
