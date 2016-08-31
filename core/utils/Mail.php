<?php
class Mail {
    public function send($type, $from_user_id, $to, $invite_user_id=null,$order_id=null,$sent=0){
        $data = array();
        $data['from_user_id'] = $from_user_id;
        $data['to'] = $to;
        $data['type'] = $type;
        $data['invite_user_id'] = $invite_user_id;
        $data['order_id'] = $order_id;
        $data['sent'] = $sent;
        $data = json_encode($data);
        $redis = new Redis();
        $redis->connect(REDIS_SERVER, REDIS_PORT);
        $rlt = $redis->lPush(MAIL_QUEUE_NAME, $data);
        $redis->close();
        return $rlt;
    }
}
?>
