<?php

class Numbertowords {
	function convert_number($number) {
         
            
        
		if (($number < 0) || ($number > 999999999999999999999)) {
			return "Amount is out of range to be converted to words by this system";
		}
                
                 $Pn = floor($number / 1000000000000000000);
		/* Quintillions () */
		$number -= $Pn * 1000000000000000000;
             
                 $Qn = floor($number / 1000000000000000);
		/* Quadrillions () */
		$number -= $Qn * 1000000000000000;
                
                 $Rn = floor($number / 1000000000000);
		/* Trillions () */
		$number -= $Rn * 1000000000000;
                
                $Tn = floor($number / 1000000000);
		/* Billions (tera) */
		$number -= $Tn * 1000000000;
                
		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */
		$res = "";
                
                if ($Pn) {
			$res .= $this->convert_number($Pn) .  " Quintillion";
		}
                if ($Qn) {
			$res .= (empty($res) ? "" : " ") .$this->convert_number($Qn) .  " Quadrillion";
		}
                if ($Rn) {
			$res .= (empty($res) ? "" : " ") .$this->convert_number($Rn) .  " Trillion";
		}
                if ($Tn) {
			$res .= (empty($res) ? "" : " ") .$this->convert_number($Tn) .  " Billion";
		}
		if ($Gn) {
			$res .= (empty($res) ? "" : " ") .$this->convert_number($Gn) .  " Million";
		}
		if ($kn) {
			$res .= (empty($res) ? "" : " ") .$this->convert_number($kn) . " Thousand";
		}
		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .$this->convert_number($Hn) . " Hundred";
		}
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " and ";
			}
			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];
				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}
		if (empty($res)) {
			$res = "zero";
		}
		return $res;
	}
        
        
        
        
        function convert_number_with_points($number) {
                        
             $pos= stripos($number,'.');
             if((stripos($number,'.')) != FALSE){

            $wholenumber = substr($number, 0, $pos);
            $points = substr($number, $pos+1);
            
           // echo "wholenumber: ".$wholenumber."<br>"."points ".$points."<br>";
           
            $partone = $this->convert_number($wholenumber);
            $parttwo = "";
            
            $x = 0;
                for($i=1; $i <= strlen($points); $i++){
                    
                    $parttwo.= " ".$this->convert_number(substr($points, $x, 1));
                    $x++;

                }
                
                $final = $partone." point".$parttwo;

             } else {
                
                $final = $this->convert_number($number);
             } 
             
             
             return $final;
        }
        
        
       
        
        
        
}
