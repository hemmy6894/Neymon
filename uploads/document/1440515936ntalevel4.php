<?php

$track_CA = 0;
$track_SE = 0;
$sup_ca_no = 0;
$sup_se_no = 0;
$T_SUPP = 0;
$dca = (isset($det) ? ($det == 3 ? 3 : 0) : 0);

if ($supscore <> '') {


    //end of supp examinations
} else {

    //deal with core courses
    if ($coursestatus == 1 || $coursestatus == 3) {

        //check empty course work

        $test = 0;
        if ($coursework == '' && $project == 0) {
            $grade = "I";
            $remark = "ABSC";
            $remark_more = 'CA not found';
            $abscondent = 1;
            $test = 1;
            $Inc = 1;
            $track_CA = 1;
            $examscore = '';
            $marks = '';
        }

        //check empty exam score   
        if ($examscore == '' && $project == 0) {
            $grade = "I";
            $remark = "ABSC";
            $remark_more = 'SE not found';
            $abscondent = 1;
            $test = 1;
            $Inc = 1;
            $track_SE = 1;
            $examscore = '';
            $marks = '';
        }


        $ca_t = 0;
        if ($coursework > 0) {
            $total_SE_DATA = 100 - $total_CA_DATA;
            $pass_ca = ((50 / 100) * $total_CA_DATA);
            if ($coursework < $pass_ca) {
                $grade = "F";
                $remark = "SUPP";
                $remark_more = 'Fail CA';
                $suppNo = 1;
                $point = 0;
                $totalpoint+=$point;
                $track_CA = 2;
                $ca_t = 1;
            }
        }

        if ($ca_supp_one == '') {
            foreach ($course_marks as $keyp => $valu) {
                if ($valu == '') {
                    $grade = "I";
                    $remark = "Inc";
                    $suppNo = 1;
                    $point = 0;
                    $Inc = 1;
                    $totalpoint+=$point;
                    $track_CA = 1;
                    $ca_t = 1;
                    $test = 1;
                }
            }
        }




        foreach ($examscore_marks as $keyp => $valu) {
            if ($valu == '') {
                $grade = "I";
                $remark = "Inc";
                $suppNo = 1;
                $point = 0;
                $Inc = 1;
                $totalpoint+=$point;
                $track_SE = 1;
                $ca_t = 1;
                $test = 1;
            }
        }




        if ($examscore == '' && $ca_t == 0) {
            $grade = "I";
            $remark = "ABSC";
            $remark_more = 'SE not found';
            $abscondent = 1;
            $marks = '';
            $test = 1;
            $Inc = 1;
        } else if ($LESS_HALF_SE > 0 && $ca_t == 0 ) {
            $sup_se_no = 1;
            $track_SE = 2;
        }




        if ($test == 0) {
            $totalscore = $examscore + $coursework;
            $marks = $totalscore;

            $total_SE_DATA = 100 - $total_CA_DATA;

            $testw = 0;
            $sup_ca_no = 0;
            if ($coursework < $pass_ca) {
                $grade = "F";
                $remark = "SUPP";
                $remark_more = 'Fail CA';
                $sup_ca_no = 1;
                $suppNo = 1;
                $point = 0;
                $testw = 1;
                $totalpoint+=$point;
                $track_CA = 2;
            }


            if ($sup_ca_no != 0 || $sup_se_no != 0) {
                $testw = 1;
                if ($sup_ca_no != 0 && $sitting_time_CA != 3) {
                    $marks = "";
                    $examscore = "";
                    $grade = "I";
                    $remark = "Inc";
                    $remark_more = 'Fail CA';
                    $Inc = 1;
                } else if ($sup_ca_no != 0 && $sitting_time_CA == 3) {
                    $marks = "";
                    $examscore = "";
                    $grade = "I";
                    $remark = "DISCO";
                    $disco_count++;
                    $remark_more = 'FAIL CA SUPP II';
                    $Inc = 1;
                } else {

                    if ($marks >= 80) {
                        $grade = "A";
                        $remark = "SUPP";
                        $T_SUPP = 1;
                        $point = $courseunit * 4;
                        $suppNo = 1;
                        $totalpoint+=$point;
                    } else if ($marks >= 65) {
                        $grade = "B";
                        $remark = "SUPP";
                        $point = $courseunit * 3;
                        $T_SUPP = 1;
                        $suppNo = 1;
                        $totalpoint+=$point;
                    } else if ($marks >= 50) {
                        $grade = "C";
                        $remark = "SUPP";
                        $T_SUPP = 1;
                        $point = $courseunit * 2;
                        $suppNo = 1;
                        $totalpoint+=$point;
                    } else if ($marks >= 40) {
                        $grade = "D";
                        $remark = "SUPP";
                        $point = $courseunit * 1;
                        $totalpoint+=$point;
                        $suppNo = 1;
                    } else if ($marks >= 0) {
                        $grade = "F";
                        $remark = "FAIL";
                        $suppNo = 1;
                        $point = 0;
                        $totalpoint+=$point;
                    } else {
                        $grade = "I";
                        $remark = "Inc";
                        $Inc = 1;
                    }
                }
                if ($sup_se_no != 0 && $sitting_time_SE != 6) {
                    $track_SE = 2;
                    $remark = "SUPP";
                    $remark_more = 'FAIL SE';
                } else if ($sup_se_no != 0 && $sitting_time_SE == 6) {
                    $remark = "DISCO";
                    $track_SE = 2;
                    $remark_more = 'FAIL SE SUPP II';
                    $disco_count++;
                }
            } else {

                if ($marks >= 80) {
                    $grade = "A";
                    $remark = "PASS";
                    $point = $courseunit * 4;
                    $totalpoint += $point;
                } else if ($marks >= 65) {
                    $grade = "B";
                    $remark = "PASS";
                    $point = $courseunit * 3;
                    $totalpoint+=$point;
                } else if ($marks >= 50) {
                    $grade = "C";
                    $remark = "PASS";
                    $point = $courseunit * 2;
                    $totalpoint+=$point;
                } else if ($marks >= 40) {
                    $grade = "D";
                    $suppNo = 1;
                    $remark = "FAIL";
                    $point = $courseunit * 1;
                    $totalpoint+=$point;
                } else if ($marks >= 0) {
                    $grade = "F";
                    $suppNo = 1;
                    $remark = "FAIL";
                    $point = 0;
                    $totalpoint+=$point;
                } else {
                    $grade = "I";
                    $remark = "Inc";
                    $Inc = 1;
                }
            }
        }
    } else if ($coursestatus == 2) {
        // deal na option course sasa
        //check empty course work

        $test = 0;
        if ($coursework == '' && $project == 0) {
            $grade = "I";
            $remark = "ABSC";
            $remark_more = 'CA not found';
            $abscondent = 1;
            $test = 1;
            $Inc = 1;
            $track_CA = 1;
            $examscore = '';
            $marks = '';
        }

        //check empty exam score   
        if ($examscore == '' && $project == 0) {
            $grade = "I";
            $remark = "ABSC";
            $remark_more = 'SE not found';
            $abscondent = 1;
            $test = 1;
            $Inc = 1;
            $track_SE = 1;
            $examscore = '';
            $marks = '';
        }


        $ca_t = 0;
        if ($coursework > 0) {
            $total_SE_DATA = 100 - $total_CA_DATA;
            $pass_ca = ((50 / 100) * $total_CA_DATA);
            if ($coursework < $pass_ca) {
                $grade = "F";
                $remark = "SUPP";
                $remark_more = 'Fail CA';
                $suppNo = 1;
                $point = 0;
                $totalpoint+=$point;
                $track_CA = 2;
                $ca_t = 1;
            }
        }

        if ($ca_supp_one == '') {
            foreach ($course_marks as $keyp => $valu) {
                if ($valu == '') {
                    $grade = "I";
                    $remark = "Inc";
                    $suppNo = 1;
                    $point = 0;
                    $totalpoint+=$point;
                    $track_CA = 1;
                    $ca_t = 1;
                    $test = 1;
                }
            }
        }




        foreach ($examscore_marks as $keyp => $valu) {
            if ($valu == '') {
                $grade = "I";
                $remark = "Inc";
                $suppNo = 1;
                $point = 0;
                $totalpoint+=$point;
                $track_SE = 1;
                $ca_t = 1;
                $test = 1;
            }
        }




        if ($examscore == '' && $ca_t == 0) {
            $grade = "I";
            $remark = "ABSC";
            $remark_more = 'SE not found';
            $abscondent = 1;
            $marks = '';
            $test = 1;
            $Inc = 1;
        }else if ($LESS_HALF > 0) {
            $sup_se_no = 1;
            $track_SE = 2;
        }




        if ($test == 0) {
            $totalscore = $examscore + $coursework;
            $marks = $totalscore;

            $total_SE_DATA = 100 - $total_CA_DATA;
            $pass_ca = ((50 / 100) * $total_CA_DATA);

            $testw = 0;
            $sup_ca_no = 0;
            if ($coursework < $pass_ca) {
                $grade = "F";
                $remark = "SUPP";
                $remark_more = 'Fail CA';
                $sup_ca_no = 1;
                $suppNo = 1;
                $point = 0;
                $testw = 1;
                $totalpoint+=$point;
                $track_CA = 2;
            }


            if ($sup_ca_no != 0 || $sup_se_no != 0) {
                $testw = 1;
                if ($sup_ca_no != 0 && $sitting_time_CA != 3) {
                    $marks = "";
                    $examscore = "";
                    $grade = "I";
                    $remark = "Inc";
                    $remark_more = 'Fail CA';
                    $Inc = 1;
                } else if ($sup_ca_no != 0 && $sitting_time_CA == 3) {
                    $marks = "";
                    $examscore = "";
                    $grade = "I";
                    $remark = "DISCO";
                    $disco_count++;
                    $remark_more = 'FAIL CA SUPP II';
                    $Inc = 1;
                } else {

                    if ($marks >= 80) {
                        $grade = "A";
                        $remark = "SUPP";
                        $T_SUPP = 1;
                        $point = $courseunit * 4;
                        $suppNo = 1;
                        $totalpoint+=$point;
                    } else if ($marks >= 65) {
                        $grade = "B";
                        $remark = "SUPP";
                        $point = $courseunit * 3;
                        $T_SUPP = 1;
                        $suppNo = 1;
                        $totalpoint+=$point;
                    } else if ($marks >= 50) {
                        $grade = "C";
                        $remark = "SUPP";
                        $T_SUPP = 1;
                        $point = $courseunit * 2;
                        $suppNo = 1;
                        $totalpoint+=$point;
                    } else if ($marks >= 40) {
                        $grade = "D";
                        $remark = "SUPP";
                        $point = $courseunit * 1;
                        $totalpoint+=$point;
                        $suppNo = 1;
                    } else if ($marks >= 0) {
                        $grade = "F";
                        $remark = "FAIL";
                        $suppNo = 1;
                        $point = 0;
                        $totalpoint+=$point;
                    } else {
                        $grade = "I";
                        $remark = "Inc";
                        $Inc = 1;
                    }
                }
                if ($sup_se_no != 0 && $sitting_time_SE != 6) {
                    $track_SE = 2;
                    $remark = "SUPP";
                    $remark_more = 'FAIL SE';
                } else if ($sup_se_no != 0 && $sitting_time_SE == 6) {
                    $remark = "DISCO";
                    $remark_more = 'FAIL SE SUPP II';
                    $disco_count++;
                    $track_SE = 2;
                }
            } else {

                if ($marks >= 80) {
                    $grade = "A";
                    $remark = "PASS";
                    $point = $courseunit * 4;
                    $totalpoint+=$point;
                } else if ($marks >= 65) {
                    $grade = "B";
                    $remark = "PASS";
                    $point = $courseunit * 3;
                    $totalpoint+=$point;
                } else if ($marks >= 50) {
                    $grade = "C";
                    $remark = "PASS";
                    $point = $courseunit * 2;
                    $totalpoint+=$point;
                } else if ($marks >= 40) {
                    $grade = "D";
                    $suppNo = 1;
                    $remark = "FAIL";
                    $point = $courseunit * 1;
                    $totalpoint+=$point;
                } else if ($marks >= 0) {
                    $grade = "F";
                    $suppNo = 1;
                    $remark = "FAIL";
                    $point = 0;
                    $totalpoint+=$point;
                } else {
                    $grade = "I";
                    $remark = "Inc";
                    $Inc = 1;
                }
            }
        }
    }
}
?>
