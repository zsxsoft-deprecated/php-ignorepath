<?php
/**
 * PHP Path Parser
 * @package phppathparser
 */
class PathParser {

	public $debug = true;
	private $_base = '';
	private $_ruleTree = array();
	private $_regExList = array();
	private $_ignoreCase = false;


	/**
	 * __get
	 * @param $name
	 * @return mixed
	 */
	public function __get($orig) {
		$name = "_" . $orig;
		return $this->$name;
	}

	/**
	 * __construct
	 * @param $name
	 * @return mixed
	 */
	public function __construct($basePath = '', $rulePath = '') {
		$this->_base = $basePath;
		if ($rulePath != '') {
			$this->loadRules(file_get_contents($rulePath));
		}
	}

	/**
	 * loadRules
	 * @param $ruleText
	 * @return bool
	 */
	public function loadRules($ruleText) {
		$array = explode("\n", $ruleText);
		if ($this->debug) { var_dump($array); }
		for ($i = 0; $i < count($array); $i++) {
			switch ($array[$i][0]) {
				case "#":
					// Ignore
					break;
				case ":":
					// RegExp
					array_push($this->_regExList, substr($array[$i], strpos($array[$i], "|") + 1));
					break;
				default:
					$this->buildTree(0, explode("/", $array[$i]), $this->_ruleTree);
					
					break;
			}
		}
		var_dump($this->_ruleTree);
		
	}

	/**
	 * buildTree
	 * @param $deep
	 * @param $array
	 * @return bool
	 */
	public function buildTree($deep, $array, &$tree) {
		if ($this->debug) { echo 'deep = ' . $deep . ', $array[$deep] = ' . $array[$deep] . "\n";}
		if ($deep == count($array)) return;
		$val = $array[$deep];
		//if ($val == '') { $val = '$base'; }
		$childTree = &$tree;
		if (!isset($tree[$val])) {
			$tree[$val] = array();
		}
		$childTree = &$tree[$val];
		$this->buildTree($deep + 1, $array, $childTree);
	}


	/*
	 * analyze
	 * @param $deep
	 * @param $array
	 * @return bool
	 */
	private function _analyze($deep, $array, $tree) {
		//echo $deep;
		
		$val = $array[$deep];
		//if ($val == '') { $val = '$base'; }
		//echo $treeName;

		foreach ($tree as $key => $child) {
		 	$str = preg_quote($key);
			$str = str_replace('\\*', '.+', $str);
			$str = str_replace('\\?', '.', $str);
			$str = "/" . $str . "/";

			//var_dump($str);var_dump($val);echo "\n". (preg_match($str, $val) ? "a" : "b");
			if (preg_match($str, $val)) {
				if ($deep == count($array) - 1 || count($child) == 0) {
					return true;
				}
				return $this->_analyze($deep + 1, $array, $child);
			}
			else {
				return false;
			}
		}

	}



	/**
	 * checkRegExp
	 * @param $path
	 * @return bool
	 */
	public function _checkRegExp($path) {
		return false;
	}


	/**
	 * checkPath
	 * @param $path
	 * @return bool
	 */
	public function checkPath($path) {
		$array = explode("/", $path);
		if (!$this->_checkRegExp($path)) {
			return $this->_analyze(0, $array, $this->_ruleTree);
		}
		else {
			return true;
		}
		
	}


}