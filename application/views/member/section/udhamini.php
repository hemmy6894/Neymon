<div class="row">
	<div class="col-xs-12">
		<h3>SEHEMU <?=$section;?>: UDHAMINI</h3>
		<p>Mdhamin/Mtu wa karibu / Mwajiri</p>
	</div>
	<div class="container">
		<div class="row">
			<?php
				$i = 0;
				foreach($wadhamini_list as $mdhamini){
					?>
						<h3>MDHAMINI NO <?=++$i;?>.</h3>
						<p>Mimi <u>  <?=$mdhamini->jina;?> </u> kama MDHAMINI wa NDUGU <u> <?=$mkopaji_fullname;?> </u> amabaye ni mkopaji.
						Ninaahidi kutoa taarifa zozote zitakazohitajika na kampuni zinazohitajika, na iwapo mkopaji atashindwa kurudisha 
						pesa kama ilivyopangwa mimi nitawajibika kwa asilimia 100,</p>
						<p>
							<div class="row">
								<div class="col-xs-1">Kazi yake : </div>
								<div class="col-xs-2"><u> <?=$mdhamini->biashara;?>  </u></div>
								<div class="col-xs-1">Na. Simu : </div>
								<div class="col-xs-2"><u> <?=$mdhamini->simu;?>  </u></div>
								<div class="col-xs-1">Sahihi : </div>
								<div class="col-xs-2">_______________________</div>
								<div class="col-xs-1">Tarehe : </div>
								<div class="col-xs-2">_______________________</div>
							</div>
						</p>
					<?php
				}
			?>
		</div>
	</div>
</div>