<?php  

/**
 * 
 */
class finance_model_copy extends CI_model
{
	
	function __construct() {
    parent::__construct();
    }

     function account_type($id = null, $account = null) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($account)) {
            $this->db->where('account', $account);
        }
        $this->db->order_by('account', 'ASC');
        return $this->db->get('account_type');
    }

    function account_type_sub($id = null, $accounttype = null, $sub_account = null) {

        if (!is_null($id)) {
            $this->db->where('id', $id);
        }

        if (!is_null($accounttype)) {
            $this->db->where('accounttype', $accounttype);
        }
        if (!is_null($sub_account)) {
            $this->db->where('sub_account', $sub_account);
        }
        $this->db->order_by('sub_account', 'ASC');
        return $this->db->get('account_type_sub');
    }

    function create_chart_account($data) {
       return $this->db->insert('account_finacial_statement',$data);

    }
}