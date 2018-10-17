<?php

$this->load->library('pdf');
// set document information
$this->pdf->set_subtitle('PROVISIONAL STATEMENT OF RESULTS');

define('RESULT_STATUS', 2);

$this->pdf->margin_borders(20,20);
$this->pdf->start_pdf(false);
$this->pdf->SetSubject('miltone');
$this->pdf->SetKeywords('miltone');


// add a page
$this->pdf->AddPage();
//set auto page breaks
$this->pdf->Ln(2);
 $this->pdf->SetY(15);
//$this->pdf->SetAutoPageBreak(TRUE);
$coll = get_collage_info();
$this->pdf->SetFont('times', '', 9);

$student = $this->academic->studentinfo($regNo);

$current_programme = $this->db->query("SELECT DISTINCT Class,ProgrammeCode,AYear FROM registeredstudent WHERE RegNo='$regNo' ORDER BY Class DESC")->result();
$program_code = $current_programme[0]->ProgrammeCode;
$pg = get_programmebyCode($program_code);
$department = $this->db->get_where('department',array('id'=>$pg[0]->Departmentid))->row();

$classstudy = $current_programme[0]->Class;
$dep_ID_TRACKER = $pg[0]->Departmentid;

$GPA_NTA_TRACKER = 4;
if($dep_ID_TRACKER == 1){
//CLINICAL
if($classstudy < 3){
$GPA_NTA_TRACKER = 4;
}else{
$GPA_NTA_TRACKER = 6;
}

}else if($dep_ID_TRACKER == 2){
//NURSING
$GPA_NTA_TRACKER = 6;
}

$nta_LVL = '';
if($classstudy == 1){
$nta_LVL = 4;
}else if($classstudy == 2){
$nta_LVL = 5;
}else if($classstudy == 3){
$nta_LVL = 6;
}else{
$nta_LVL = 7;
}



$html='<h1  align="center">'.$coll[0]->Name."</h1>";
$html.='<h3 align="center">DEPARTMENT OF '.$department->Name.'</h3>';
$html .= '<table >
    <tr>
<td width="900">
<table  width="1000" >
<tr>
<td width="200">Telephone:</td><td>' . $coll[0]->LandLine . '</td>
</tr>
<tr>
<td width="200">Fax:</td><td>' . $coll[0]->Mobile . '</td>
</tr>
<tr>
<td width="200">Email:</td><td>' . str_replace(",", "\n", $coll[0]->Email) . '</td>
</tr>
<tr>
<td width="200">Website:</td><td>' . $coll[0]->Site . '</td>
</tr>
</table>
</td>
<td>
<img style="height:200px;" src="./images/logo.jpg" />
</td>
<td >
<table>
<tr>
<td>' . $coll[0]->PostalAddress . '</td>
</tr>
<tr>
<td>' . $coll[0]->City . '</td>
</tr>
<tr>
<td>' . $coll[0]->Country . '</td>
</tr>
<tr>
<td>' . date('F d, Y') . '</td>
</tr>
</table>
</td>
</tr>
</table><br/> ';



$programme_ntalevel = $pg[0]->NtaLevel;
$nta_l = $this->db->get_where('ntaLevel',array('id'=>$programme_ntalevel))->row();
$programme_ntalevel  = $GPA_NTA_TRACKER;
$html.='<h1 align="center">STUDENT ACADEMIC REPORT ('.$current_programme[0]->AYear.')</h1>';
$html.='<h3 align="center">  '. $pg[0]->Name. ' - '.$pg[0]->shortname.'</h3>';
$html.='<table><tr><td style="width:70%;"><h3> NAME : ' . strtoupper($student[0]->LastName . ', ' . $student[0]->FirstName . ' ' . $student[0]->MiddleName) . '</h3></td><td><h3> ADM. No : '.$student[0]->RegNo.'</h3></td></tr></table>';



$result = $this->academic->provisional($regNo);
$list_semester = $this->db->query("SELECT DISTINCT AYear,Semester FROM studentresult WHERE RegNo='$regNo' AND publish=1 ORDER BY AYear ASC,Semester ASC")->result();

$annualpoint = 0;
$annualunit = 0;
$annualInco=0;
$failannual=0;

if (count($list_semester) > 0) {

    foreach ($list_semester as $key => $value) {
        $class = $this->db->get_where('registeredstudent',array('RegNo'=>$regNo,'Semester'=>$value->Semester,'AYear'=>$value->AYear))->row();
        $dar = strtoupper(madarasa($class->Class));
        if($programme_ntalevel == 7 && $class->Class == 2){
            if($value->Semester == 'Semester I'){
                $semem = 'Semester III';
            }else if($value->Semester == 'Semester II'){
                $semem = 'Semester IV';
            }else{
                $semem = $value->Semester;
            }
            $html.="<br/><b>". $dar.' : '.strtoupper($semem). "</b><br/>";
        }else{
        $html.="<br/><b>". $dar.' : '.strtoupper($value->Semester). "</b><br/>";
        }
        $html.='<table border="1">
<tr>
<td align="center" width="100"><b>S/No</b></td><td width="300"> <b>CODE</b></td> <td width="950"> <b>COURSE NAME</b></td> <td width="150" align="center"><b>UNITS</b></td> <td width="150" align="center"><b> GRADE</b></td><td width="350" align="left"><b> &nbsp; REMARK</b></td>
</tr>';
                $i = 1;
                $nta='';
                $totalpoint = '';
                $Inc =0;
                $totatunit = '';
              
        foreach ($result as $k => $v) {
            if ($value->AYear == $v->AYear && $value->Semester == $v->Semester) {
                $ayear = $v->AYear;
                $coursecode = $v->CourseCode;
                $coursestudy[]=$coursecode;
                $coursedetail = $this->academic->course_detail($coursecode);
                
                $coursestatus = $v->Status;
                $courseunit = $coursedetail[0]->Unit;
                $totatunit+=$courseunit;
                $ntalevel = $coursedetail[0]->NTALevel;
                $nta = $coursedetail[0]->NTALevel;
                $coursename = $coursedetail[0]->Name;
                
                $grade = '';
                $remark = '';
                $coursework = '';
                $marks = '';
                $examscore = '';
               
                $point = '';
                $semester = $v->Semester;
                include 'rawresult.php';
                $html.="<tr>";
                $html.='<td align="center" >' . $i++ . "</td>";
                $html.="<td> " .rtrim($coursecode,'.') . "</td>";
                $html.="<td> " . $coursename . "</td>";
                if($grade =="*C"){
                    $grade ="C";
                }
                if($grade > 'C'){
                    $failannual++;
                }
                $html.='<td align="center"> ' . $courseunit . ' </td>';
                $html.='<td align="left"> &nbsp; &nbsp; &nbsp; '.trim($grade)."</td>";
               //$html.='<td align="center"> ' . $point . ' </td>';
                if($course_department == 2){
                   $nta = 6; 
                }
                $ntagrade = $nta;
                $ntalevel = $nta;
               
               include 'grade_remark.php';
                $html.='<td> &nbsp; '.strtoupper($graderemark).'</td>';
                $html.="</tr>";
            }
        }
        
        
        if($Inc == 1){
            $annualInco =1;
        }
        $annualpoint += $totalpoint;
        $annualunit += $totatunit;
        
        
         $html.='</table>';
    }
}else{
    $html.='<div><p><b>No result found !!! </b></p></div>';
}

$html.='<br/><table>';
if($failannual == 0){
$html.=' <tr><td width="100"></td><td style="border-bottom:3px solid #000000;" width="900"> <b> OVERALL GPA : '.$overallgpa = @substr($annualpoint/$annualunit, 0,3).'</b></td><td style="border-bottom:3px solid #000000;" width="1000"><b>CLASSFICATION : ';
        
$ntalevel =$programme_ntalevel;
include 'gpaclass.php';

  $html.= '</b></td></tr>';
}
      
 $html.= '<tr><td width="100"></td><td colspan="2" align="center">************************* END ************************</td></tr>      
</table>';

$html.='<table>
<tr><td width="100"><b>NB :</b></td><td width="1900"><i>This is the provisional statement of results and is not an Academic Transcript.
The Institute reserves the right to correct the information given in this statement which will be confirmed by the issue
of Academic Transcript</i>
</td></tr>    
</table>';

$ntalevel =$programme_ntalevel;

include 'gpascale.php';
$ntalevel =$programme_ntalevel;
include 'gradescale.php';

$html.='<br/><table >
<tr>
<td align="left"><b>PRINCIPAL: ....................................................</b><br/><br/> <b>Date of issue : ................................................</b> </td>
<td align="left"><b>EXAMINATIONS OFFICER : ....................................................</b><br/><br/><b>Date of issue : ............................................................................</b></td>
</tr>
</table>';
///////////////////////////////////////////////////////
// print a line using Cell()
$this->pdf->writeHTML($html);

//$this->pdf->Footer();
//ob_clean();
//Close and output PDF document
$this->pdf->Output($regNo.'.pdf', 'I');
exit;
?>
