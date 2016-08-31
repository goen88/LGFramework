<?php
/**
 * 用户数据类
 *
 */

class sg_users_data{
	/**
	 * 表名称
	 * @var string
	 */
	private $table;

	/**
	 * 数据库句柄.
	 * @var Object
	 */
	private $link;

	public function __construct($link){
		$this->link = $link;
		$this->table = "sg_users";
	}


	public function insert_a_row($row_rec){
		$id = $this->link->insert ($this->table, $row_rec);
		return $id;
	}


	public function update_a_row_by_uid($row_rec,$uid){

		$this->link->where ('uid', $uid);
		if ($this->link->update ($this->table, $row_rec)){
			//$db->count . ' records were updated';
			return $this->link->count;
		}
	}

	public function delete_a_row_by_uid($uid){
		$this->link->where('uid', $uid);
		if($this->link->delete($this->table)) {
			return  $this->link->count;
		}
	}

	public function select_a_row_by_uid($uid){
		$this->link->where ("uid", $uid);
		$row = $this->link->getOne($this->table);
		return $row;
	}

	public function select_a_sum($where=null){
		if($where){
			foreach ($where as $filed=>$value){
				$this->link->where ($filed, $value);
			}
		}
		$count = $this->link->getValue ($this->table, "count(*)");
		return $count;
	}

	public function select_muti_rows($where=null,$fileds='*',$offset=0,$count=10,$order=null){
		if(is_array($where)){
			foreach ($where as $filed=>$value){
				$this->link->where ($filed, $value);
			}
		}
		if(is_array($order)){
			foreach ($order as $filed=>$value){
				$this->link->orderBy($filed,$filed);
			}
		}
		$rlt = $this->link->get($this->table,array($offset,$count),$fileds);
		return $rlt;
	}

	public function select_muti_num_and_rows($where=null,$fileds="*",$offset=0,$count=10,$order=null){
		if(is_array($where)){
			foreach ($where as $filed=>$value){
				$this->link->where ($filed, $value);
			}
		}
		if(is_array($order)){
			foreach ($order as $filed=>$value){
				$this->link->orderBy($filed,$value);
			}
		}
		$rlt = $this->link->withTotalCount()->get($this->table, Array ($offset, $count),$fileds);
		return array(
			'totalCount'=>$this->link->totalCount,
			'items'=>$rlt
		);
	}
}
