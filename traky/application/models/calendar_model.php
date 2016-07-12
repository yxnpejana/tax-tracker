<?php
/**
 * Deals with all data of calendar
 *
 * @author Yaxien
 */
class Calendar_model extends CI_Model {

    public function __construct(){
            // Call the CI_Model constructor
            parent::__construct();
    }
    
    public function add_event($events){        
        //get if all day
        $allday = $events['allday']? TRUE: FALSE;
        //get if it recurrs
        $recurr = $events['repeats']? TRUE: FALSE;
        $repeat_freq = $events['repeat-freq'] > 0? $events['repeat-freq']: 0;
        $weekday = date('N', strtotime($events['start-date']));      
        
        //for parent only
        if($allday){
            $to_save = array(
                'title' => $events['title'],
                'allday' => $allday,
                'weekday' => $weekday,
                'start_date' => $events['start-date'],
                'repeats' => $recurr,
                'repeat_freq' => $repeat_freq,
                'color' => $events['color']
            );
            $child_event = array(
                'allday' => $allday,
                'start' => $events['start-date']." 00:00:00",
                 'end' => "0000-00-00 00:00:00",
                 'title' => $events['title']
            );
            
        } else {
            $to_save = array(
                'title' => $events['title'],
                'allday' => $allday,
                'weekday' => $weekday,
                'start_date' => $events['start-date'],
                'end_date' => $events['end-date'],
                'start_time' => $events['start-time'],
                'end_time' => $events['end-time'],
                'repeats' => $recurr,
                'repeat_freq' => $repeat_freq,
                'color' => $events['color']
            );
            $child_event = array(
                'allday' => $allday,
                'start' => date('Y-m-d H:i:s', $events['start-date']." 08:00:00"),
                 'end' => date('Y-m-d H:i:s', $events['start-date']." 17:00:00"),
                 'title' => $events['title']
            );
        }
        
        if($recurr){
            
            $until = (365/$repeat_freq);
            if ($repeat_freq == 1){
                $weekday = 0;
            }
            
            //insert to Parent
            $this->db->insert('event_parent', $to_save);
            $parent_id = $this->db->insert_id();
            
            //insert to event child table            
            for($x = 0; $x <$until; $x++){
                $child_event['parent_id'] = $parent_id;
                
                $start_date = strtotime($child_event['start']);
                
                if($allday){
                    $end_date = strtotime($child_event['start']);
                } else {
                    $end_date = strtotime($child_event['end'].' + '.$repeat_freq.' DAYS');
                }
                
                $child_event['start'] = date('Y-m-d H:i:s', $start_date);
                $child_event['end'] = date('Y-m-d H:i:s', $end_date);
                
                $this->db->insert('events', $child_event);
            }
            
            
            
        } else {
            //insert to Parent
            $this->db->insert('event_parent', $to_save);
            $parent_id = $this->db->insert_id();
            
            //insert to event child table
            $child_event['parent_id'] = $parent_id;
            $this->db->insert('events', $child_event);
        }
        
        return $parent_id;
    }
    
    public function get_events($start, $end){
        $sql = $this->db->query('SELECT events.*, event_parent.color '
                . 'FROM events '
                . 'LEFT JOIN event_parent on event_parent.parent_id = events.parent_id '
                . 'WHERE event_parent.start_date BETWEEN "'.$start.'" AND "'.$end.'"');
        
        if($sql->num_rows() > 0){
           $row = $sql->result();
            
           return $row;
            
        } else { return FALSE;}
    }
}
