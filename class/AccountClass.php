<?php
class AccountClass extends Mapper
{	
    //search display
	public function account($clear, $page, $sort, $exist, $date_time_start, $date_time_end, $mail_addr, $take_point_min, $take_point_max, $retention_point_min, $retention_point_max):array
    {  
		$limit = 500;
        $offset = ($page - 1) * $limit; 
        //日付を本日の23：59：59に設定しなおす　sqlの範囲が00:00:00まで判定しないようなので記述
        $date_time_end = date("Y-m-d H:i:s",strtotime($date_time_end. "+86399 second"));        
        //--------------------------------------
        //  dynamic-sql
        //--------------------------------------        
        $sql  = "select
        user.id,
        user.exist,
        user.login_id,
        user.created_at,
        user.deleted_at,
        user_point.user_id,
        user_point.current,
        user_point.uncommitted
        FROM user 
        inner join user_point
        on user.id = user_point.user_id
        where true";
        if(isset($clear)){
                //全件表示ボタンが押された時sessionを破棄し初期表示を行う
                session_destroy();
                $date_time_start = date('2018-01-01');
                $date_time_end = date('Y-m-d');
                $mail_addr = "";
                $exist ="all";
                $take_point_min = "";
                $take_point_max = "";
                $retention_point_min = "";
                $retention_point_max = "";
                
                if(!empty($exist)){
                    if($exist ==="1"){
                $sql .= " and user.exist = true";
                    }else if($exist==="2"){
                $sql .= " and user.exist is null";
                    }else if($exist === "all"){
                    }
                }
            $sql .= empty($mail_addr)       ? "" : " and user.login_id like ".$this->db->quote("%".$mail_addr."%");
            $sql .= empty($date_time_start) ? "" : " and user.created_at >= ".$this->db->quote($date_time_start);
            $sql .= empty($date_time_end)   ? "" : " and user.created_at <= ".$this->db->quote($date_time_end);

            $sql .= empty($take_point_min)  ? "" : " and user_point.current >= ".$this->db->quote($take_point_min);
            $sql .= empty($take_point_max)  ? "" : " and user_point.current <= ".$this->db->quote($take_point_max);
                        
            $sql .= empty($retention_point_min)  ? "" : " and user_point.uncommitted >= ".$this->db->quote($retention_point_min);
            $sql .= empty($retention_point_max)  ? "" : " and user_point.uncommitted <= ".$this->db->quote($retention_point_max);
            
            $sql .= " order by user.id ".$sort;
            $sql .= " limit ".strval($limit);
            $sql .= " offset ".strval($offset);            
        }else{
            if(!empty($exist)){
            //$sql .= ($exist)              ? " and user.exist = true" : " and user.exist is null";
                if($exist ==="1"){
            $sql .= " and user.exist = true";
                }else if($exist==="2"){
            $sql .= " and user.exist is null";
                }else if($exist === "all"){
                    //空
                }
            }
            $sql .= empty($mail_addr)       ? "" : " and user.login_id like ".$this->db->quote("%".$mail_addr."%");
            $sql .= empty($date_time_start) ? "" : " and user.created_at >= ".$this->db->quote($date_time_start);
            $sql .= empty($date_time_end)   ? "" : " and user.created_at <= ".$this->db->quote($date_time_end);
            
            $sql .= empty($take_point_min)  ? "" : " and user_point.current >= ".$this->db->quote($take_point_min);
            $sql .= empty($take_point_max)  ? "" : " and user_point.current <= ".$this->db->quote($take_point_max);
            
            $sql .= empty($retention_point_min)  ? "" : " and user_point.uncommitted >= ".$this->db->quote($retention_point_min);
            $sql .= empty($retention_point_max)  ? "" : " and user_point.uncommitted <= ".$this->db->quote($retention_point_max);
            
            $sql .= " order by user.id ".$sort;
            $sql .= " limit ".strval($limit);
            $sql .= " offset ".strval($offset);
        }
        
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);  
    }
	
	//count about total
    public function count_user(): int
    {
        $sql = "SELECT count(id) FROM `user`";
        $stmt = $this->db->query($sql);
        $results = $stmt->fetchColumn();
        return $results;
    }
	
	//update to mailaddress
    public function update_user($mail_address, $user_id)
    {
        $sql = "UPDATE user SET 
	    login_id = '" . $mail_address . "'
	    WHERE id = '" . $user_id . "'";
        $stmt = $this->db->query($sql);
    }

	//update to exist
    public function update_exist_deleted_at($exist, $deleted_at, $user_id)
    {
        $sql = "UPDATE user SET 
	    exist = NULL
		,deleted_at = '" . $deleted_at . "'
	    WHERE id = '" . $user_id . "'";
        $stmt = $this->db->query($sql);
    }
	
	//detail of display
	public function update_detail($id)
	{
        $sql = "SELECT  
        user.id,
        user.exist,
        user.login_id,
        user.created_at,
        user.deleted_at,
        user_point.user_id,
        user_point.current,
        user_point.uncommitted
        FROM user 
        inner join user_point
        on user.id = user_point.user_id
      	WHERE id = '" . $id . "'";
        $stmt = $this->db->query($sql);
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
	}
    
    //detail of display about scroll
    public function user_history($id)
    {
     $sql="
     select 
     *
     from
     user_point_operation_history
     where user_id = '" . $id . "'";
    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);  
    }
}