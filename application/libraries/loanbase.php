<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loan
 *
 * @author miltone
 */
class Loanbase {

    //put your code here

    function get_installment($rate, $pricipal, $installment, $interest_method = 1, $interval = 1, $product_id) {

        $amount = 0;
        if($product_id == 4){
            $interest = ($rate/100) * $pricipal;
            $total_loan = $pricipal + $interest;
            $amount = $total_loan / $installment;
        }else{
            $rate_required = 0;
            if ($interval == 1) {
                //monthly
                $rate_required = (($rate / 12) / 100);
            }else if($interval == 2){
                //weekly
                $rate_required = (($rate / 52) / 100);
            }else if($interval == 3){
                //Yearly
                $rate_required = (($rate) / 100);
            }

            if ($interest_method == 1) {
                $up = pow((1 + $rate_required), $installment);
                $down = (pow((1 + $rate_required), $installment) - 1);
                $amount = (($pricipal * ($up / $down)) * $rate_required);
            } else if ($interest_method == 2) {
                $interest_per_month = $rate_required * $pricipal;
                $amount = ($pricipal / $installment) + $interest_per_month;
            }

            if($interval == 3){
                //make installment amount yearly
                //because it varies on each employment
                $amount = 0;
            }
        }
        return round($amount, 2);
    }

    function totalInterest($rate, $initialprinciple, $installment, $repay_amount, $interest_method = 1, $interval = 1, $product_id) {

        $interest = 0;
        if($product_id == 4){
            $interest = ($rate/100) * $initialprinciple;
        }else{

            $rate_required = 0;
            if ($interval == 1) {
                //monthly
                $rate_required = (($rate / 12) / 100);
            }else if($interval == 2){
                //weekly
                $rate_required = (($rate / 52) / 100);
            }else if($interval == 3){
                //Yearly
                $rate_required = (($rate) / 100);
                $remainprinciple = $initialprinciple;
            }

            if ($interest_method == 1) {
                $principal_init = $initialprinciple;

                for ($i = 1; $i <= $installment; $i++) {
                    $tmp_int = ($rate_required * $initialprinciple);
                    $interest += ($rate_required * $initialprinciple);
                    $initialprinciple = ($initialprinciple - ($repay_amount - $tmp_int));
                }
            } else if ($interest_method == 2) {
                $interest_per_month = $rate_required * $initialprinciple;
                $interest = $interest_per_month * $installment;
            }

            if($interval == 3){
                $interest = 0;
                if ($interest_method == 1) {
                    $principal_installment = $remainprinciple/ $installment;

                    for ($i = 1; $i <= $installment; $i++) {
                        $interest += ($rate_required * $remainprinciple);
                        $remainprinciple = ($remainprinciple - ($principal_installment));
                    }
                } else if ($interest_method == 2) {
                    $interest_per_month = $rate_required * $remainprinciple;
                    $interest = $interest_per_month * $installment;
                }
            }
        }
        return round($interest, 2);
    }

    function create_repayment_schedule($repayamount, $rate, $installment, $startdate, $initialprinciple, $LID, $interest_method = 1, $interval = 1, $total_loan) {
        $rate_required = 0;
        $schedule = array();
        $increase_day = '';
        if ($interval == 1) {
            $rate_required = (($rate / 12) / 100);
            $increase_day = '+1 month';
        }else if($interval == 2){
            //weekly
            $rate_required = (($rate / 52) / 100);
            $increase_day = "+7 days";
        }else if($interval == 3){
            //Yearly
            $rate_required = (($rate) / 100);
            $increase_day = '+1 year';
            $remainprinciple = $initialprinciple;

        }

        if ($interest_method == 1) {
            $date = $startdate;
            $principal_init = $initialprinciple;
            $llop = $repayamount;
            $init_total_loan_balance = $total_loan;
            for ($i = 1; $i <= $installment; $i++) {
                $repayamount = $llop;
                $array = array();
                //$tmp_int = ($rate_required * $initialprinciple);
                $array['repaydate'] = $date;
                $array['month'] = date('Ym',  strtotime($date));
                $array['LID'] = $LID;
                $array['PIN'] = current_user()->PIN;
                $array['installment_number'] = $i;
                $array['repayamount'] = $repayamount;
                $interest = $rate_required * $initialprinciple;
                $array['interest'] = round($interest, 2);
                $array['principle'] = round(($repayamount - $interest), 2);
                $balance = ($initialprinciple - $array['principle']);
                $total_loan_balance = $init_total_loan_balance - $repayamount;
                //$array['balance'] = ($balance > 0 ? round($balance, 2) : 0);
                $array['balance'] = ($total_loan_balance > 0 ? round($total_loan_balance, 2) : 0);
                $schedule[] = $array;
                $initialprinciple = $balance;
                $init_total_loan_balance = $total_loan_balance;
                $date1 = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) .$increase_day));
                $date = $date1;
            }
        } else if ($interest_method == 2) {
            $date = $startdate;
            $principal_init = $initialprinciple;
            $llop = $repayamount;
            $init_total_loan_balance = $total_loan;
            $interest = $rate_required * $initialprinciple;
            for ($i = 1; $i <= $installment; $i++) {
                $repayamount = $llop;
                $array = array();
                //$tmp_int = ($rate_required * $initialprinciple);
                $array['repaydate'] = $date;
                $array['month'] = date('Ym',  strtotime($date));
                $array['LID'] = $LID;
                $array['PIN'] = current_user()->PIN;
                $array['installment_number'] = $i;
                $array['repayamount'] = $repayamount;
                $array['interest'] = round($interest, 2);
                $array['principle'] = round(($repayamount - $interest), 2);
                $balance = ($initialprinciple - $array['principle']);
                $total_loan_balance = $init_total_loan_balance - $repayamount;
                //$array['balance'] = ($balance > 0 ? round($balance, 2) : 0);
                $array['balance'] = ($total_loan_balance > 0 ? round($total_loan_balance, 2) : 0);
                $schedule[] = $array;
                $initialprinciple = $balance;
                $init_total_loan_balance = $total_loan_balance;
                $date1 = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) . $increase_day));
                $date = $date1;
            }
        }





        if($interval == 3){
            //custom year repayment for institutional loan yearly
            $schedule = array(); //clear array
            if ($interest_method == 1) {
                $date = $startdate;
                $principal_init = $remainprinciple;
                $initialprinciple = $remainprinciple;
                $llop = $repayamount;
                $init_total_loan_balance = $total_loan;
                $principal_installment = $remainprinciple/ $installment;
                for ($i = 1; $i <= $installment; $i++) {

                    $array = array();
                    //$tmp_int = ($rate_required * $initialprinciple);
                    $array['repaydate'] = $date;
                    $array['month'] = date('Ym',  strtotime($date));
                    $array['LID'] = $LID;
                    $array['PIN'] = current_user()->PIN;
                    $array['installment_number'] = $i;
                    $interest = $rate_required * $initialprinciple;
                    $array['interest'] = round($interest, 2);
                    $array['principle'] = round(($principal_installment), 2);
                    $balance = ($initialprinciple - $array['principle']);
                    $repayamount = $array['interest'] + $array['principle'];
                    $array['repayamount'] = round($repayamount, 2);
                    $total_loan_balance = $init_total_loan_balance - $repayamount;
                    //$array['balance'] = ($balance > 0 ? round($balance, 2) : 0);
                    $array['balance'] = ($total_loan_balance > 0 ? round($total_loan_balance, 2) : 0);
                    $schedule[] = $array;
                    $initialprinciple = $balance;
                    $init_total_loan_balance = $total_loan_balance;
                    $date1 = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) .$increase_day));
                    $date = $date1;
                }
            } else if ($interest_method == 2) {
                $date = $startdate;
                $principal_init = $remainprinciple;
                $initialprinciple = $remainprinciple;
                $llop = $repayamount;
                $init_total_loan_balance = $total_loan;
                $interest = $rate_required * $initialprinciple;
                $principal_installment = $remainprinciple/ $installment;
                for ($i = 1; $i <= $installment; $i++) {
                    $repayamount = $llop;
                    $array = array();
                    //$tmp_int = ($rate_required * $initialprinciple);
                    $array['repaydate'] = $date;
                    $array['month'] = date('Ym',  strtotime($date));
                    $array['LID'] = $LID;
                    $array['PIN'] = current_user()->PIN;
                    $array['installment_number'] = $i;
                    $array['interest'] = round($interest, 2);
                    $array['principle'] = round($principal_installment, 2);
                    $repayamount = $array['interest'] + $array['principle'];
                    $array['repayamount'] = round($repayamount, 2);
                    $balance = ($initialprinciple - $array['principle']);
                    $total_loan_balance = $init_total_loan_balance - $repayamount;
                    //$array['balance'] = ($balance > 0 ? round($balance, 2) : 0);
                    $array['balance'] = ($total_loan_balance > 0 ? round($total_loan_balance, 2) : 0);
                    $schedule[] = $array;
                    $initialprinciple = $balance;
                    $init_total_loan_balance = $total_loan_balance;
                    $date1 = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) . $increase_day));
                    $date = $date1;
                }
            }


        }




        return $schedule;
    }

    function rowd($repay, $rate, $installment, $interval = 1) {

        $rate_required = 0;
        //$increate_day//
        if ($interval == 1) {
            $rate_required = (($rate / 12) / 100);
        }
        $up = pow((1 + $rate_required), $installment);

        $down = (pow((1 + $rate_required), $installment) - 1);

        $tmp = (($up / $down) * $rate_required);

        return ($repay / $tmp);
    }






}
