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
			<select name="server_id" id="delivery" class="constructorVisitor">
				<option value="1">Азерот</option>
				<option value="2">Калимдор</option>
				<option value="3">Драенор</option>
			</select>
            <div class="serviceElBlock"><div><label><input type="checkbox" name="smellCB" class="paramsCB constructorVisitor"/>С запахом</label></div>
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
                <div><label><input type="checkbox" name="surgutchCB" class="paramsCB constructorVisitor"/>Сургуч</label></div>
                <div class="surgutchBlock"><input class="surgutchRb constructorVisitor" name="surgutchType" type="radio"/><a class="surgutchGal" href="img/photos/constructLetter.jpg"><img class="surgutchImg"  src="/img/photos/letterText.png"/></a></div>
                <div class="surgutchBlock"><input class="surgutchRb constructorVisitor" name="surgutchType" type="radio"/><a class="surgutchGal" href="img/photos/constructLetter.jpg"><img class="surgutchImg" src="/img/photos/letterText.png"/></a></div>
                <div class="surgutchBlock"><input class="surgutchRb constructorVisitor" name="surgutchType" type="radio"/><a class="surgutchGal" href="img/photos/constructLetter.jpg"><img class="surgutchImg" src="/img/photos/letterText.png"/></a></div>
                <div class="surgutchBlock"><input class="surgutchRb constructorVisitor" name="surgutchType" type="radio"/><a class="surgutchGal" href="img/photos/constructLetter.jpg"><img class="surgutchImg" src="/img/photos/letterText.png"/></a></div>
                <div class="surgutchBlock"><input class="surgutchRb constructorVisitor" name="surgutchType" type="radio"/><a class="surgutchGal" href="img/photos/constructLetter.jpg"><img class="surgutchImg"  src="/img/photos/letterText.png"/></a></div>
                <div class="surgutchInitsBlock"><label><input class="surgutchRb constructorVisitor" name="surgutchType" type="radio"/><span>С ининциалами </span>
                    <input class="initials constructorVisitor" type="text" name="initial1" placeholder="И" maxlength="1"/><input class="initials constructorVisitor" type="text" name="initial2" placeholder="В" maxlength="1"/></label>
                </div>
            </div>
            <div class="serviceElBlock"><label><input type="checkbox" name="burntEdgesCB" class="paramsCB constructorVisitor"/>Обжигать края</label></div>
            <div class="serviceElBlock"><div><label><input type="checkbox" name="mealCB" class="paramsCB constructorVisitor"/>Со вкусным сюрпризом</label></div>
                <select name="mealId" id="mealSelect" class="constructorVisitor">
                    <option value="1">Сникерс</option>
                    <option value="2">Баунти</option>
                    <option value="3">Казмандур</option>
                </select>
            </div>
        </div>
		<?php \Annex\Annex::showArray($servicesList); ?>
	</div>
	<div class="constructor-steps step3 hidden center">
        <div class="form-blocks-3">
            <div><label>Адрес для доставки:<br/><input class="constructorVisitor" type="text" name="address" placeholder="м.Київ, вул.Паркова 39, кв. 7"/></label></div>
            <div><label>Кому:<br/><input class="constructorVisitor" type="text" name="whomName" placeholder="София Прекрасная"/></label></div>
            <div class="commentBlock">
                <label>Примечание:<br/><textarea class="userCommentTA constructorVisitor" name="comments"></textarea></label>
            </div>
        </div><div class="form-blocks-3">
            <div><label>Ваше имя:<br/><input class="constructorVisitor" type="text" name="userName" placeholder="Славик Студент"/></label></div>
            <div><label>Ваш e-mail:<br/><input class="constructorVisitor" type="text" name="userEmail" placeholder="student.goloden@edy.net"/></label></div>
            <div><label>Ваш телефон:<br/><input class="constructorVisitor" type="text" name="userPhone" placeholder="099 123-45-67"/></label></div>
        </div>
	</div>


	<div class="text-right constructor-switcher-bar">
		<button class="button constructor-switcher previous hidden">Назад</button>
		<button class="button constructor-switcher next">Далее</button>
		<button class="button constructor-switcher toPay hidden">Оплатить заказ</button>
	</div>
</div>