<?php

use App\Cv\Competence;
use App\Cv\CompetenceService;
use App\Cv\SheetReader;

$star = '<i class="fa fa-star"></i>';
$min_score = 2;

$sheetReader = new SheetReader(
	'https://docs.google.com/spreadsheets/d/e/2PACX-1vRm-k2WN3lyG-5RxFtM2j_dzX46Y1xVVnlJRVGgnCZq53xjoTIg1NpIR8mQQhLm146bM8HZT7HGEu4K/pub?gid=0&single=true&output=csv',
	true,
);

$competenceService = new CompetenceService(
	$sheetReader->read()
);

function make_comp($title, $scores, $fa = false){
	global $star;
	ob_start();
		?>
		<h5>
		<?php if($fa){ ?>
			<i class="fa fa-<?=$fa;?> fa-fw"></i>
		<?php }; ?>
			<?=$title;?>
		</h5>
		<table>
			<tbody>
				<?php
				/** @var Competence[] $competences */
				foreach($scores as $score => $competences){
					if($score > 2){ ?>
						<tr>
							<th class="text-right text-nowrap">
								<?=str_repeat($star, $score); ?>
							</th>
							<td>
								<?php foreach($competences as $competence) { ?>
									<span class="text-nowrap">
										<?php if ($competence->icons) { ?>
											<i class="<?=$competence->icons;?>"></i>
										<?php }; ?>
										<a class="tag"
											<?php if($competence->url) { ?>
													href="<?=$competence->url;?>"
													target="techno"
											<?php };?>
										><?=$competence->techno;?></a></span>
								<?php } ?>
							</td>
						</tr>
					<?php
					}
				}; ?>
			</tbody>
		</table>
		<?php
	return ob_get_clean();
}
?>
<div class="row comp px-md-2">
	<div class="col col-sm-6">
		<?=make_comp("Languages", $competenceService->getGroupedByLevel("CODE"), "code");?>
		<?=make_comp("Outils", $competenceService->getGroupedByLevel("CLI"), "server");?>
	</div>
	<div class="col col-sm-6">
		<?=make_comp("Frameworks", $competenceService->getGroupedByLevel("FRAMEWORK"), "code");?>
		<?=make_comp("Services", $competenceService->getGroupedByLevel("SERVICE"), "server");?>
		<?=make_comp("OS", $competenceService->getGroupedByLevel("OS"), "save");?>
	</div>
</div>