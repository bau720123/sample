<?php
// version 1.5
class WA_MySQLi_Query  {
	public function __construct($conn) {
	  $this->Connection = $conn;
	  $this->Statement = "";
	  $this->Action = "";
	  $this->Table = "";
	  $this->Filter = "";
	  $this->SaveAs = "";
	  $this->ParamTypes = array();
	  $this->ParamColumns = array();
	  $this->ParamValues = array();
	  $this->FilterValues = array();
	  $this->AffectedRows = 0;
	  $this->InsertID = 0;
	  $this->NumRows = 0;
	  $this->ParamCount = 0;
	  $this->FieldCount = 0;
	  $this->Error = "";
	  $this->ErrorNo = 0;
	  $this->ID = 0;
	  $this->Debug = false;
	}
	public function setQuery($statement) {
	  $this->Statement = $statement;	
	}
	public function saveInSession($varname) {
	  $this->SaveAs = $varname;	
	}
	public function redirect($url) {
	  if ($url) header("location: " . $url);	
	}
	public function bindColumn($paramColumn,$paramType,$paramValue,$paramDefault) {
	  if (($paramValue !== "" || $paramDefault != "WA_IGNORE") && !(strtolower($this->Action) == "insert" && $paramValue === "" && $paramDefault == "WA_DEFAULT")) {
	    $this->ParamColumns[] = array($paramColumn,$paramDefault == "WA_DEFAULT" && $paramValue === "");
		if (!($paramValue === "" && $paramDefault == "WA_DEFAULT" && strtolower($this->Action) == "update")) {
		  $this->bindParam($paramType,$paramValue,$paramDefault);
		}
	  }
	}
	public function addFilter($filterColumn, $filterComparison, $filterType, $filterValue) {
      $this->FilterValues[] = array($filterColumn, $filterComparison, $filterType, $filterValue);
	}
	public function setFilter() {
	  if (sizeof($this->FilterValues) > 0) {
        $this->Statement .= " WHERE ";
        for ($x=0; $x<sizeof($this->FilterValues); $x++) {
          if ($x>0) $this->Statement .= " AND ";
          $this->Statement .= $this->FilterValues[$x][0] . " " . $this->FilterValues[$x][1] . " ?";
		  $this->bindParam($this->FilterValues[$x][2], $this->FilterValues[$x][3], "");
		}
	  }
	}
	public function bindParam($paramType,$paramValue,$paramDefault="WA_BLANK") {
	  if ($paramValue === "") {
		switch ($paramDefault) {
		  case "WA_BLANK":
			$paramValue = "";
			break;
		  case "WA_NULL":
		  case "WA_DEFAULT":
			$paramValue = null;
			break;
		  case "WA_CURRENT_TIMESTAMP":
			$paramValue = date("Y-m-d H:i:s");
			break;
		  case "WA_ZERO":
			$paramValue = "0";
			break;
		  case "WA_NO":
			$paramValue = "N";
			break;
		  default:
			$paramValue = $paramDefault;
		}
	  }
	  if ($paramType == "t") {
		$paramType = "s";
		$hasTime = strpos($paramValue," ") !== false;
		$paramValue = strtotime($paramValue);
		if ($hasTime) {
		  $paramValue = date('Y-m-d H:i:s',$paramValue);
		} else {
		  $paramValue = date('Y-m-d',$paramValue);
		}
	  } else if ($paramType == "c") {
		$paramType = "i";
		if ($paramValue) {
		  $paramValue = 1;
		} else {
		  $paramValue = 0;
		}
	  } else if ($paramType == "y") {
		$paramType = "s";
		if ($paramValue) {
		  $paramValue = "y";
		} else {
		  $paramValue = "n";
		}
	  } else if ($paramType == "n") {
		$paramType = "i";
		if ($paramValue) {
		  $paramValue = -1;
		} else {
		  $paramValue = 0;
		}
	  }
	  $this->ParamTypes[] = $paramType;	
	  $this->ParamValues[] = $paramValue;	
	}
	public function getParams() {
	  return array_merge(array(implode("",$this->ParamTypes)), $this->ParamValues);
	}
	public function execute($allowTableOverwrite=false) {
	  if (!$this->Statement) {
        $this->createStatement();
		if ((strtolower($this->Action) == "delete" || strtolower($this->Action) == "update") && strpos($this->Statement," WHERE ") === false && !$allowTableOverwrite) {
          return;
		}
	  }
	  $statement = $this->Statement;
	  $query = $this->Connection->Prepare($statement);
	  if ($query == false) {
		if ($this->Debug) {
		  die($this->Statement . "<BR><BR>" . mysqli_error($this->Connection));
		} else {
		  die("There is an error in your SQL syntax.");
		}
	  }
	  if (sizeof($this->ParamTypes)) call_user_func_array(array($query, "bind_param"),$this->paramRefs($this->getParams()));
	  $query->execute();
	  if ($this->SaveAs != "") {
		@session_start();
	    $_SESSION[$this->SaveAs] = $query->insert_id?$query->insert_id:$query->id;
	  }
	  $this->AffectedRows = $query->affected_rows;
	  $this->InsertID = $query->insert_id;
	  $this->NumRows = $query->num_rows;
	  $this->ParamCount = $query->param_count;
	  $this->FieldCount = $query->field_count;
	  $this->Error = $query->error;
	  $this->ErrorNo = $query->errno;
	  $this->ID = $query->id;
      $query->close();
	}
	public function paramRefs($arr) {
	  if (strnatcmp(phpversion(),'5.3') >= 0)
	  {
		$refs = array();
		foreach($arr as $key => $value)
		  $refs[$key] = &$arr[$key];
		return $refs;
	  }
	  return $arr;
	}
	public function createStatement() {
	  if (strtolower($this->Action) == "conditional") {
		if (sizeof($this->FilterValues) > 0) {
		  if (!class_exists("WA_MySQLi_RS")) require(dirname(__FILE__) . "/" . "rsobj.php");
		  $ConditionalRS = new WA_MySQLi_RS("ConditionalRS",$this->Connection,1);
		  $ConditionalRS->setQuery("SELECT Count(*) AS RowCount FROM " . $this->Table);
		  $ConditionalRS->FilterValues = $this->FilterValues;
		  $ConditionalRS->setFilter();
		  $ConditionalRS->execute();
		  if ($ConditionalRS->getColumnVal("RowCount")) {
		    $this->Action = "update";
			for ($x=sizeof($this->ParamColumns)-1; $x>=0; $x--) {
			  if ($this->ParamColumns[$x][1]) {
				  array_splice($this->ParamValues,$x,1);
				  array_splice($this->ParamTypes,$x,1);
			  }
			}
		  } else {
			$this->FilterValues = array();
		    $this->Action = "insert";
		  }
		} else {
		  $this->Action = "insert";
		}
	  }
	  if (strtolower($this->Action) == "replace") {
		if (sizeof($this->FilterValues) > 0) { 
		  $ReplaceDelete = new WA_MySQLi_Query($this->Connection);
		  $ReplaceDelete->setQuery("DELETE FROM dreamhostaccounting");
		  $ReplaceDelete->FilterValues = $this->FilterValues;
		  $ReplaceDelete->setFilter();
		  $ReplaceDelete->execute();
		}
		$this->Action = "insert";
	  }
	  switch (strtolower($this->Action)) {
		case "update":
		  $this->Statement = "UPDATE " . $this->Table . " SET ";
		  for ($x=0; $x<sizeof($this->ParamColumns); $x++) {
            if ($x!=0) $this->Statement .= ", ";
            $this->Statement .= $this->ParamColumns[$x][0] . " = " . (($this->ParamColumns[$x][1])?"DEFAULT":"?");
		  }
		  break;
		case "insert":
		  $Columns = "";
		  $Values = "";
		  $this->Statement = "INSERT INTO " . $this->Table . " (";
		  for ($x=0; $x<sizeof($this->ParamColumns); $x++) {
            if ($x!=0) {
			  $Columns .= ", ";
			  $Values .= ", ";
			}
            $Columns .= $this->ParamColumns[$x][0];
            $Values .= "?";
		  }
		  $this->Statement .= $Columns . ") VALUES (" . $Values . ")";
		  break;
		case "delete":
		  $this->Statement = "DELETE FROM " . $this->Table;
		  break;
	  }
      $this->setFilter();
	}
}
?>