<?php

function get_value($table, $id, $column = 'name') {
    $CI = &get_instance();
    $CI->db->where('id', $id);
    $row = $CI->db->get($table)->row();
    if ($row) {
        return $row->{$column};
    }

    return '';
}

function format_lastpart_account($lastpart) {
    $return = '';
    $lastpart = $lastpart;

    if ($lastpart < 10) {
        $return = '000' . $lastpart;
    } else if ($lastpart >= 10 && $lastpart < 100) {
        $return = '00' . $lastpart;
    } else if ($lastpart > 1000 && $lastpart < 10000) {
        $return = '0' . $lastpart;
    } else if ($lastpart > 10000) {
        $return = $lastpart;
    }

    return $return;
}

if (!function_exists('active_year')) {
    /*function active_year() {
        $CI = &get_instance();
        $CI->db->where('status', 1);
        return $CI->db->get('year')->row()->year;
    }*/
    function active_year() {
        $CI = &get_instance();
        $active_year = null;
        if ($CI->session->userdata('user_active_year')){
            $active_year = $CI->session->userdata('user_active_year');
            $year = $CI->db->where('year', $active_year)->get('year')->row();
            if(!$year->closed)
                return $active_year;
        }

        $CI->db->where('status', 1);
        $active_year = $CI->db->get('year')->row()->year;
        return $active_year;
    }
}

if (!function_exists('reseller_info')) {

    function reseller_info($reseller_id) {
        $CI = &get_instance();
        $CI->db->where('id', $reseller_id);
        return $CI->db->get('reseller_account')->row();
    }

}

if (!function_exists('is_resseller')) {

    function is_resseller($id = null) {
        $CI = &get_instance();
        $id | $id = $CI->session->userdata('user_id');
        $user = $CI->db->get_where('users', array('id' => $id))->row();
        if ($user) {
            if ($user->reseller == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }

}
if (!function_exists('is_super_user')) {

    function is_super_user($id = null) {
        $CI = &get_instance();
        $id | $id = $CI->session->userdata('user_id');
        $user = $CI->db->get_where('users', array('id' => $id))->row();
        if ($user) {
            if ($user->super_user == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author  Kevin van Zonneveld <kevin@vanzonneveld.net>
 * @author  Simon Franz
 * @author  Deadfish
 * @copyright 2008 Kevin van Zonneveld (http://kevin.vanzonneveld.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD Licence
 * @version   SVN: Release: $Id: alphaID.inc.php 344 2009-06-10 17:43:59Z kevin $
 * @link      http://kevin.vanzonneveld.net/
 *
 * @param mixed   $in     String or long input to translate
 * @param boolean $to_num  Reverses translation when true
 * @param mixed   $pad_up  Number or boolean padds the result up to a specified length
 * @param string  $passKey Supplying a password makes it harder to calculate the original ID
 *
 * @return mixed string or long
 */
function alphaID($in, $to_num = false, $pad_up = false, $passKey = null) {

    $index = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if ($passKey !== null) {

        for ($n = 0; $n < strlen($index); $n++) {
            $i[] = substr($index, $n, 1);
        }

        $passhash = hash('sha256', $passKey);
        $passhash = (strlen($passhash) < strlen($index)) ? hash('sha512', $passKey) : $passhash;

        for ($n = 0; $n < strlen($index); $n++) {
            $p[] = substr($passhash, $n, 1);
        }

        array_multisort($p, SORT_DESC, $i);
        $index = implode($i);
    }

    $base = strlen($index);

    if ($to_num) {
        // Digital number  <<--  alphabet letter code
        $in = strrev($in);
        $out = 0;
        $len = strlen($in) - 1;
        for ($t = 0; $t <= $len; $t++) {
            $bcpow = bcpow($base, $len - $t);
            $out = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
        }

        if (is_numeric($pad_up)) {
            $pad_up--;
            if ($pad_up > 0) {
                $out -= pow($base, $pad_up);
            }
        }
        $out = sprintf('%F', $out);
        $out = substr($out, 0, strpos($out, '.'));
    } else {
        // Digital number  -->>  alphabet letter code
        if (is_numeric($pad_up)) {
            $pad_up--;
            if ($pad_up > 0) {
                $in += pow($base, $pad_up);
            }
        }

        $out = "";
        for ($t = floor(log($in, $base)); $t >= 0; $t--) {
            $bcp = bcpow($base, $t);
            $a = floor($in / $bcp) % $base;
            $out = $out . substr($index, $a, 1);
            $in = $in - ($a * $bcp);
        }
        $out = strrev($out); // reverse
    }

    return $out;
}

if (!function_exists('encode_id')) {

    function encode_id($id) {
        $string = "ABCDEFGHIJKLMNOPQRSTUVXWZ";
        $rand = str_split($string);
        $left = array_rand($rand, 2);
        $right = array_rand($rand, 2);

        $build_query = implode('', $left) . '_' . $id . '_' . implode('', $right);
        $strt_arry = str_split($build_query);
        $arry = array();
        foreach ($strt_arry as $kx => $vx) {
            $re = unpack('C*', $vx);
            if (strlen($re[1]) === 3) {
                $arry[] = $re[1];
            } else {
                $arry[] = '0' . $re[1];
            }
        }

        return $parameter = implode('', $arry);
    }

}


if (!function_exists('decode_id')) {

    function decode_id($string) {
        $str = join(array_map('chr', str_split($string, 3)));
        $exp = explode('_', $str);
        if (count($exp) == 3) {
            return $exp[1];
        } else {
            return NULL;
        }
    }

}

if (!function_exists('mobile_code')) {

    function mobile_code() {
        $CI = &get_instance();
        return $CI->db->get('mobile_code')->result();
    }

}
if (!function_exists('account_row_info')) {

    function account_row_info($account) {
        $CI = &get_instance();
        $CI->db->where('account', $account);
        return $CI->db->get('account_chart')->row();
    }

}


if (!function_exists('current_user')) {

    function current_user($id = null) {
        $CI = &get_instance();
        $id | $id = $CI->session->userdata('user_id');
        $user = $CI->db->get_where('users', array('id' => $id))->row();
        return $user;
    }

}

if (!function_exists('loan_member_info')) {

    function loan_member_info($pid = null, $member_id = null) {
        $CI = &get_instance();
         $pin = current_user()->PIN; 
        $CI->db->where('PIN', $pin); 
        if (!is_null($pid)) {
            $CI->db->where('PID', $pid);
        }
        if (!is_null($member_id)) {
            $CI->db->where('member_id', $member_id);
        }

        return $CI->db->get('members')->row();
    }

}

if (!function_exists('default_text_value')) {

    function default_text_value($key) {
        $CI = &get_instance();
        $pin = current_user()->PIN;
        $content = $CI->db->get_where('global_setting', array('key' => $key, 'PIN' => $pin))->row();
        if (count($content) == 1) {
            return $content->text;
        }
        return '';
    }

}
if (!function_exists('company_info')) {

    function company_info() {
        $CI = &get_instance();
        $pin = current_user()->PIN;
        $CI->db->where('PIN', $pin);
        $company = $CI->db->get('companyinfo')->row();
        return $company;
    }

}
if (!function_exists('loan_status')) {

    function loan_status($id = null) {
        $CI = &get_instance();
        $array = array(
            '' => 'All status',
            '0' => 'New Loan',
            '1' => 'Evaluated',
            '2' => 'Rejected',
            '4' => 'Accepted',
            '5' => 'Closed',
            '6' => 'Disburse',
            '7' => 'Evaluated && Rejected',
            '8' => 'Accepted && Rejected',
            '9' => 'Accepted && Disbursed',
        );
        if (!is_null($id)) {
            return $array[$id];
        }

        return $array;
    }

}


if (!function_exists("format_date")) {

    function format_date($date, $tomysql = true) {
        $CI = & get_instance();
        if ($tomysql) {
            if (preg_match("/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/", $date)) {
                $expl = explode('-', $date);
                return $expl[2] . '-' . $expl[1] . '-' . $expl[0];
            } else {
                return $date;
            }
        } else {
            if (preg_match("/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/", $date)) {
                $expl = explode('-', $date);
                return $expl[2] . '-' . $expl[1] . '-' . $expl[0];
            } else {
                return $date;
            }
        }
    }

}

function page_selector() {
    $CI = &get_instance();
    $get_vars = $CI->input->get();
    if (is_array($get_vars)) {
        if (array_key_exists('row_per_pg', $get_vars)) {
            unset($get_vars['row_per_pg']);
        }
        $query_string = http_build_query($get_vars, '', '&');
    } else {
        $query_string = 'query=1';
    }

    $selected = $CI->session->userdata('PER_PAGE');
    $pages_array = array(1, 10, 20, 30, 40, 50, 70, 100, 150, 200, 250, 300);
    $return = lang('row_per_page') . ' : <select onchange="page_selector()" id="per_pg" style="width:70px; padding:5px; background:transparent;">';
    foreach ($pages_array as $key => $value) {
        $return .= '<option ' . ($selected == $value ? 'selected="selected"' : '') . ' value="' . $value . '">' . $value . '</option>';
    }

    $return .= '<script type="text/javascript">
function page_selector(){
var val = document.getElementById("per_pg").value;

window.location = "' . current_url() . '/?' . $query_string . '&row_per_pg="+val;
}
</script>

';

    echo $return;
}

if (!function_exists("has_role")) {

    function has_role($module_id, $link) {
        $CI = & get_instance();
        $user_id = $CI->session->userdata('user_id');

        $user_group = $CI->ion_auth_model->get_users_groups($user_id)->row();
        $check = $CI->db->query("SELECT * FROM access_level WHERE group_id = $user_group->id AND Module=$module_id AND link = '$link' AND allow=1")->result();

        if (count($check) > 0) {
            return TRUE;
        }

        return FALSE;
    }

}

if (!function_exists("access_module")) {

    function access_module($module_id) {
        $CI = & get_instance();
        $user_id = $CI->session->userdata('user_id');
        $user_group = $CI->ion_auth_model->get_users_groups($user_id)->row();

        $check = $CI->db->query("SELECT * FROM access_level WHERE group_id = $user_group->id AND Module=$module_id AND allow != 0")->result();
        if (count($check) > 0) {

            return TRUE;
        }

        return FALSE;
    }

}



if (!function_exists('current_new_loan')) {

    function current_new_loan($pin = null) {
        $CI = &get_instance();
        $pin || $pin = $CI->session->userdata('PIN');       
        //$CI->db->where('PIN', $pin);
        return $CI->db->where('status', '0')->get('loan_contract')->num_rows();

    }

}

if (!function_exists('current_loan_toevaluate')) {

    function current_loan_toevaluate($pin = null) {
        $where_au = "(status=0 OR status=3)";
        $CI = &get_instance();
        $pin || $pin = $CI->session->userdata('PIN');
        //$CI->db->where('PIN', $pin);
        return $CI->db->where('status', $where_au)->where('push_to_evaluation',1)->get('loan_contract')->num_rows();

    }

}

if (!function_exists('current_loan_toapprove')) {

    function current_loan_toapprove($pin = null) {
        $CI = &get_instance();
        $pin || $pin = $CI->session->userdata('PIN');
        //$CI->db->where('PIN', $pin);
        return $CI->db->where('status', '1')->get('loan_contract')->num_rows();

    }

}


if (!function_exists('current_loan_todisburse')) {

    function current_loan_todisburse($pin = null) {
        $CI = &get_instance();
        $pin || $pin = $CI->session->userdata('PIN');
        //$CI->db->where('PIN', $pin);
         $where = "(disburse='1' or disburse='0') ";
        return $CI->db->where('status', '4')->where($where)->where('multiple_disburse_status !=', '2')->get('loan_contract')->num_rows();

    }

}


?>
