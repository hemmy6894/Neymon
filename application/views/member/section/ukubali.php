<div class="row">
	<div class="col-xs-12">
		<h3>SEHEMU  <?=$section;?> : UKUBALI</h3>
	</div>
	<div class="container">
			<div class="row">
			<p>
			 Mimi <u>  <?=@$mkopaji_fullname;?>  </u> Nimeamua, Nikiwa na akili timamu bila kulazimishwa wala kushawishiwa kuingia makubaliano ya kukopa pesa.
			 Kiasi cha Tsh <u> <?=@$ukubali_kiasi;?> </u> ambayo imewekwa kupitia akaunti ya <u> <?=@$ukubali_account;?> </u>. Kiasi kwa maneno <u> <?=@$ukubali_kiasi_maneno;?> </u>
			 kutoka katika kampuni ya <strong>NKOMEV COMPANY LIMITED</strong> kiasi hiki cha fedha kitakuwa kina riba ya Asilimia <u> <?=@$ukubali_riba;?> </u>
			 kwa mwezi.Mkopo huu  utakuwa  kwa muda wa <u><?=@$ukubali_muda;?>. </u> Kuanzia tarehe <u> <?=@$ukubali_kuanzia;?> </u>  mpaka tarehe <u> <?=@$ukubali_mpaka;?> </u>.   Naahidi 
			 kwamba Nitakuwa naweka marejesho  kila mwenzi kwa tarehe ile ile niliyoichukulia mkopo. Natambua  kuwa kwa kila siku moja  Nitakayochelewesha marejesho  Nitaongezewa riba ya asilimia 1 kwa siku .Na
			 Nikifikisha/Tukifikisha siku saba  bila kufanya malipo ,kampuni itachukua jukumu la kujulisha wadhamini kuhusu ucheleweshaji wa kulipa na iwapo njia
			 zote zitashindikana , kampuni:</br>
			 Itakuwa na mamlaka ya kuchukua na kuuza dhamana zifuatazo: 
			 <ol>
				 <?php
					$i = 0;
					foreach($ukubali_dhamana as $ud){
						?>
							<li><?=$ud->name;?></li>
						<?php
					}
				 ?>
			 </ol>
			 Ili kufidia pesa niliyochukua na riba yote iliyoongezeka ,ninawapa ridhaa ya kuuza dhamana zangu iwapo nitashindwa kurudisha mkopo na riba kama nilivyoingia 
			 makubaliano na kampuni.Iwapo nitashindwa kulipa niruhusu mwajiri wangu anikate pesa yote ninayodaiwa kwenye mshahara wangu. Natambua  kwamba kiasi hiki cha fedha Nilichokikopa
			 ;Nitarudisha ikiwa ni pamoja na riba.Natambua kuwa mikopo hii ni muda mfupi(miezi mitatu tu),n asiruhusiwi kurudisha miezi mitatu ikitokea nimepitisha miezi mitatu
			 nitawajibika kulipa riba za mwezi bila kuacha.<br/><br/>Nadhibitsha kwamba taarifa zote tulizojaza kwenye fomu hii ni sahihi kwa kadri ninavojua na kuamini.
			 
			</p>
			<div class="col-xs-2">
					<h4>Sahihi ya Mkopaji</h4>
				</div>
				<div class="col-xs-3">
					.................................................
				</div>
				<div class="col-xs-2">
					<h4>Tarehe ya maombi</h4>
				</div>
				<div class="col-xs-3">
					.................................................
				</div>
			</div>
	</div>
</div>