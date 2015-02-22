<div>
	<div class="constructor-navigator step1 stepped">
		Шаг 1: Выбор письма
	</div><div class="constructor-navigator step2 active">
		Шаг 2: Параметры отправки
	</div><div class="constructor-navigator step3">
		Шаг 3: Оплата
	</div>


	<div class="constructor-steps step1">
		<div class="letters categories">
			<?php
				$active = 'active';
				$i = 0;
				foreach ($c as $item) :
					if (isset ($item ['subcategory'])) {
						$ctgr = 'ctgrList closed';
					} else {
						$ctgr = 'ctgr';
						if (!isset ($item ['templatesData'])) continue;
					}
					if (isset ($item ['subcategory']) && $active == 'active') $active = ' '; ?>
				<div data-id="<?= $i ?>" class="letters-item <?= $ctgr ?> <?= $active ?>"><?= $item ['templates_categories_name'] ?></div>
				<?php if (isset ($item ['subcategory'])) :
					?>
						<div class="subcategories">
						<?php
							if ($active == ' ') $active = 'active';
							foreach ($item ['subcategory'] as $subItem) :
								$i ++;
								if (!isset ($subItem ['templatesData'])) continue;
								?>
							<div data-id="<?= $i ?>" class="letters-item ctgr <?= $active ?>"><?= $subItem ['templates_categories_name'] ?></div>
						<?php endforeach; ?>
						</div>
				<?php endif;
				$active = '';
				endforeach; ?>
		</div><div class="letters previews scrollbar-inner">
			<?php
				$i = -1;
				$hidden = '';
				$active= 'active';
				foreach ($c as $catItem) :
					$templatesList = [];
					if (isset ($catItem ['subcategory'])) {
						foreach ($catItem ['subcategory'] as $item)
							$templatesList [] = $item ['templatesData'];
					} else {
						if (isset ($catItem ['templatesData']))
							$templatesList [] = $catItem ['templatesData'];
					}
						?>
					<?php
						foreach ($templatesList as $templates) :
							$i ++;
							if (count ($templates) <= 0) continue; ?>
						<div class="catGroup <?= $hidden ?> id<?= $i ?>">
						<?php
							$hidden = 'hidden';
							foreach ($templates as $item) : ?>
									<div class="letters-item preview-box boxId<?= $item ['templates_id']?> <?=$active?>">
										<div class="preview-id hidden"><?= $item ['templates_id']?></div>
										<div class="preview-title"><?= $item ['templates_title']?></div>
										<div class="preview-desc"><?= $item ['templates_prev']?></div>
										<div class="preview-text hidden"></div>
									</div>
					<?php
								$active= '';
							endforeach; ?>
						</div>
					<?php
						endforeach;?>
			<?php
				endforeach;
			?>
		</div><div class="letters text"><?= $firstText ?></div>
	</div>
	<?php \Annex\Annex::showArray($c); ?>
	<div class="constructor-steps step2 hidden">2</div>
</div>