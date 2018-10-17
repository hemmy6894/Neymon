<div class="row">
	<div class="col-xs-12">
		<h4>Watu wa karibu/Ndugu ikitokea dharura</h4>
	</div>
	<div class="container">
		<div class="row">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Jina</th>
						<th>Kazi/Biashara anayofanya</th>
						<th>Uhusiano</th>
						<th>Namba ya simu</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach($wadhamini_list as $mdhamini){
							?>
								<tr>
									<td><?=++$i;?></td>
									<td><?=$mdhamini->jina;?></td>
									<td><?=$mdhamini->biashara;?></td>
									<td><?=$mdhamini->uhusiano;?></td>
									<td><?=$mdhamini->simu;?></td>
								</tr>
							<?php
						}
					?>
				</thead>
			</table>
		</div>
	</div>
</div>