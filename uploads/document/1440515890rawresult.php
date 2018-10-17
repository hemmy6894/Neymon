<?php

$project = 0;
$sitting_time_CA = 1;
$sitting_time_SE = 1;
$LESS_HALF_SE=0;
$course_info_data = $this->db->get_where("course",array("Code"=>$coursecode))->row();
$course_department = $course_info_data->Department;

// get total CA for that course

$get_total_CA = $this->db->query("SELECT SUM(Score) as total_CA FROM CAsetting WHERE CourseCode='$coursecode' AND AYear='$ayear' AND ExamGroup=3")->result();
$total_CA_DATA = 0;
if (count($get_total_CA) == 1) {
    $total_CA_DATA = $get_total_CA[0]->total_CA;
}
// array to hold marks
$course_marks = array();
$test1 ="";
//get CA Settings
$basic_CA_ExamCat = $this->db->get_where("CAsetting", array('CourseCode' => $coursecode, 'AYear' => $ayear, 'ExamGroup' => 3))->result();

//current sitting
$current_CA_sitting = $this->db->order_by("Cat", "DESC")->get_where('studentresult_sitting', array('AYear' => $ayear, 'CourseCode' => $coursecode, 'RegNo' => $regNo, 'Exam_Type' => 3))->result();

if (count($current_CA_sitting) > 0) {
    $sitting_time_CA = $current_CA_sitting[0]->Cat;
}

foreach ($basic_CA_ExamCat as $xy => $vz) {
$test1='';

    // check if there is supp in test 1
    //var $CA_sitting_temp=0;
    if ($sitting_time_CA == 1) {
        //first sitting
        $test1 = $this->academic->get_marks($ayear, $coursecode, $regNo, $vz->ExamCat, $semester);
    } else {
        //coursework supp
        // all course work should bellong to either first supp or second supp
        $get_ExamCatMatch = $this->db->get_where('examCategoryMatch', array('ExamCatBasic' => $vz->ExamCat, 'Cat' => $sitting_time_CA))->row();
        // there is exam matched here, get data
        if (count($get_ExamCatMatch) == 1) {
            $test1_check1 = $this->academic->get_marks($ayear, $coursecode, $regNo, $get_ExamCatMatch->ExamCatMatched, $semester);
            if ($test1_check1 <> '') {
              //  $test1 = $test1_check1;
            }else{
            //    $test1 = '';
            }
        } else {
          //  $test1 = '';
        }
 $test1 = $this->academic->get_marks($ayear, $coursecode, $regNo, $vz->ExamCat, $semester);
    }

    
    if ($test1 <> '') {
        $test1 = number_format(@substr($test1, 0, 5), 2);
    } else {
        $test1 = '';
    }
    $course_marks[$vz->ExamCat] = $test1;
}




//supp I
$ca_supp_one = $this->academic->get_marks($ayear, $coursecode, $regNo, 2, $semester);
if ($ca_supp_one <> '') {
    $ca_supp_one = number_format($ca_supp_one);
} else {
    $ca_supp_one = '';
}




//end of the semester

$examscore_marks = array();
$se_exam="";
//get SE Settings
$basic_SE_ExamCat = $this->db->get_where("CAsetting", array('CourseCode' => $coursecode, 'AYear' => $ayear, 'ExamGroup' => 1))->result();

//current sitting
$current_SE_sitting = $this->db->order_by("Cat", "DESC")->get_where('studentresult_sitting', array('AYear' => $ayear, 'CourseCode' => $coursecode, 'RegNo' => $regNo, 'Exam_Type' => 2))->result();

if (count($current_SE_sitting) > 0) {
    $sitting_time_SE = $current_SE_sitting[0]->Cat;
}

foreach ($basic_SE_ExamCat as $xy => $vz) {

$se_exam="";

    // check if there is supp in test 1
    //var $CA_sitting_temp=0;
    if ($sitting_time_SE == 1) {
        //first sitting
        $se_exam = $this->academic->get_marks($ayear, $coursecode, $regNo, $vz->ExamCat, $semester);
    } else {
        //coursework supp
        // all course work should bellong to either first supp or second supp
        $get_ExamCatMatch = $this->db->get_where('examCategoryMatch', array('ExamCatBasic' => $vz->ExamCat, 'Cat' => $sitting_time_SE))->row();
        // there is exam matched here, get data
        if (count($get_ExamCatMatch) == 1) {
            $se1_check1 = $this->academic->get_marks($ayear, $coursecode, $regNo, $get_ExamCatMatch->ExamCatMatched, $semester);
            if ($se1_check1 <> '') {
               $se_exam = $se1_check1;
            }else{
                $se_exam = '';
            }
        } else {
            $se_exam = '';
        }
    }

    if ($se_exam <> '') {
        $se_exam = number_format(@substr($se_exam, 0, 5), 2);
    } else {
        $se_exam = '';
    }

  if($se_exam < ($vz->Score/2)){
     $LESS_HALF_SE++;
   }
    $examscore_marks[$vz->ExamCat] = $se_exam;
}





if (count($course_marks) > 0) {
    $coursework = array_sum($course_marks);
} else {
    $coursework = "";
}
if ($coursework <> '') {
    $coursework = number_format($coursework);
}


//suppI CA
if ($ca_supp_one <> '') {
    $coursework = $ca_supp_one;
}


//get final exam

if (count($examscore_marks) > 0) {
    $examscore = array_sum($examscore_marks);
}else{
    $examscore ="";
}


if($examscore <> ''){
  $examscore = number_format($examscore); 
}

/*
//get special exam
$speacial_exam = '';
if ($speacial_exam <> '') {
    $speacial_exam = number_format($speacial_exam);
    $examscore = $speacial_exam;
}


//get project exam
$project = '';
if ($project <> '') {
    //    $project = 1;
    $examscore = number_format($project);
    $project = 1;
}

//get sup marks
$supscore = '';

if ($supscore <> '') {
    $supscore = number_format(@substr($supscore, 0, 5));
}


// kama anavuta matokea before supp basi, fanya supscore iwe empty ili  iweze skip kwenye ntalevel files
//if (!defined('RESULT_STATUS')) {
//  $supscore = '';
//}
*/
include 'level.php';
?>
