<div>



	<div class="constructor-navigator step1 active">
		Шаг 1: Выбор письма
	</div><div class="constructor-navigator step2">
		Шаг 2: Свойства письма
	</div><div class="constructor-navigator step3">
		Шаг 3: Параметры отправителя
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
			<div data-id="-1" class="letters-item ctgr myTextWrite">Написать свое</div>
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
		</div><div class="letters text scrollbar-inner"><div class="text-letter-content"></div></div>
	</div>
	<div class="myTextField hidden">
		<textarea name="ownText" id="ownText" cols="30" rows="10" class="templateTextArea"></textarea>
	</div>
	<div class="constructor-steps step2 hidde n">
		<div class="form-blocks-2">
			<div><label for="delivery">Доставка:</label></div>
			<select name="server_id" id="delivery">
				<option value="1">Азерот</option>
				<option value="2">Калимдор</option>
				<option value="3">Драенор</option>
			</select>
            <div class="smellBlock"><div><label><input type="checkbox" name="smellCB" class="form2cb"/>С запахом</label></div>
                <select name="se_id" id="smell" class="constructorVisitor">
                    <option value="1">Яндекс</option>
                    <option value="2">Розы</option>
                    <option value="3">Казмандур</option>
                </select>
            </div>
            <div class="price">
                <p>Конечная цена: <span class="currentPrice">32,16</span> грн.</p>
            </div>
        </div><div class="form-blocks-2">
            <div class="surgutch">
                <p>Сургуч</p>
                <div class="surgutchBlock"><input class="surgutchRb" name="surgutchType" type="radio"/><a class="surgutchGal" href="img/photos/constructLetter.jpg"><img class="surgutchImg"  src="/img/photos/letterText.png"/></a></div>
                <div class="surgutchBlock"><input class="surgutchRb" name="surgutchType" type="radio"/><a class="surgutchGal" href="img/photos/constructLetter.jpg"><img class="surgutchImg" src="/img/photos/letterText.png"/></a></div>
                <div class="surgutchBlock"><input class="surgutchRb" name="surgutchType" type="radio"/><a class="surgutchGal" href="img/photos/constructLetter.jpg"><img class="surgutchImg" src="/img/photos/letterText.png"/></a></div>
                <div class="surgutchBlock"><input class="surgutchRb" name="surgutchType" type="radio"/><a class="surgutchGal" href="img/photos/constructLetter.jpg"><img class="surgutchImg" src="/img/photos/letterText.png"/></a></div>
                <div class="surgutchInitsBlock"><input class="surgutchRb" name="surgutchType" type="radio"/><span>С ининциалами</span></div>
            </div>
		</div>
		<?php \Annex\Annex::showArray($servicesList); ?>
	</div>
	<div class="constructor-steps step3 hidden center">

	</div>


	<div class="text-right constructor-switcher-bar">
		<button class="button constructor-switcher previous hidden">Назад</button>
		<button class="button constructor-switcher next">Далее</button>
		<button class="button constructor-switcher toPay hidden">Оплатить заказ</button>
	</div>
</div>