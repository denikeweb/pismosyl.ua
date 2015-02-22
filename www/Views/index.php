<div class="wrapper">
    <nav class="nav">
        <a href="/" class="logo"></a>
        <ul class="menu">
            <li class="menu-item"><span class="to-about">О нас</span></li>
            <li class="menu-item"><span class="to-warranty">Гарантии</span></li>
            <li class="menu-item"><span class="to-constructor">Отправить письмо</span></li>
            <li class="menu-item"><span class="to-contacts">Контакты</span></li>
        </ul>
    </nav>
    <div class="aboutBg">
        <div class="blackoutBg">
            <div class="aboutText">
                Письмосыл – это сервис для отправки непростых писем,
                где уже становится неважным, знакомы вы с ней или нет. Приглашай девушку в театр или на выставку, или просто впечатли её до глубины сердца приятными строками. А всё, что лень сочинять - мы придумаем за вас.         </div>
            <button class="buyButton to-constructor">Сделать подарок</button>
            <button class="infoButton to-process">Ознакомиться с сервисом</button>
        </div>
    </div>
    <div class="photos">
        <h3 class="headerText">Вот такие письма мы пишем...</h3>
        <p class="usualText">У нас разработаны стандарты для писем — это то, что гарантирует качество нашей работы. Посмотрите на то, что мы делаем:</p>
        <div class="photoSet">
            <a class="photoSetPic" href="img/photos/letterText.png"><img class="first" src="img/photos/letterTextSmall.png" alt="Письмо с текстом"/></a><a class="photoSetPic" href="img/photos/letterText2.png"><img src="img/photos/letterTextSmall2.png" alt="Письмо с текстом"/></a><a class="photoSetPic" href="img/photos/envelopeDesign.png"><img src="img/photos/envelopeDesignSmall.png" alt="Оформление конверта"/></a><a class="photoSetPic" href="img/photos/envelopeDesign2.png"><img src="img/photos/envelopeDesignSmall2.png" alt="Оформление конверта"/></a><a class="photoSetPic" href="img/photos/envelopeDesign3.png"><img src="img/photos/envelopeDesignSmall3.png" alt="Оформление конверта"/></a>
        </div>
    </div>
    <div class="youWant" id="one">
        <h3 class="headerText">Наш сервис понадобится, если вы хотите</h3>
        <p class="usualText"><strong class="boldText">Сделать приятное своему парню/девушке</strong> и удивить своего любимого человека. Только представьте, сколько радости будет у них на глазах, когда они получат такой красивый и оригинальный подарок от вас.</p>
        <p class="usualText ywCenter"><strong class="boldText">Начать отношение с</strong> парнем/девушкой. Ведь признаться в симпатии,  отправив красивое и «живое» письмо намного  романтичнее, чем позвонить «544».</p>
        <p class="usualText"><strong class="boldText">Удивить своих родителей</strong>, прислав им в честь знаменательного празника (или просто так) поздравление, или просто сказав пару нежных и заботливых слов своим родным.</p>
    </div>
    <div class="steps">
        <h3 class="headerText stepsHeader">Все делаем в 3 этапа:</h3>
        <div class="stepBlock">
            <a class="pictureSB" href="img/photos/constructLetter.jpg"><img src="img/photos/constructLetterS.jpg" alt="Конструируете письмо на сайте"/></a>
            <p class="usualText textSB">Этап 1: конструируете письмо на сайте</p>
        </div><div class="stepBlock centerB"><a class="pictureSB" href="img/photos/payOrder.jpg"><img src="img/photos/payOrderS.jpg" alt="Оплачиваете заказ"/></a><p class="usualText textSB">Этап 2: Оплачиваете заказ</p></div><div class="stepBlock">
            <a class="pictureSB" href="img/photos/happyAddressee.jpg"><img src="img/photos/happyAddresseeS.jpg" alt="Получатель радуется"/></a>
            <p class="usualText textSB">Этап 3: Получатель радуется</p>
        </div>
        <h3 class="headerText curierHeader">Схема с курьером</h3>
        <div class="row3picBC">
            <div class="blockPC">
                <a class="pictureC" href="img/photos/courierStep1.jpg"><img src="img/photos/courierStep1S.jpg" alt="Схема с курьером шаг 1"/></a>
            </div><div class="blockPC centerB"><a class="pictureC" href="img/photos/courierStep2.jpg"><img src="img/photos/courierStep2S.jpg" alt="Схема с курьером шаг 2"/></a></div><div class="blockPC">
                <a class="pictureC" href="img/photos/courierStep3.jpg"><img src="img/photos/courierStep3S.jpg" alt="Схема с курьером шаг 3"/></a></div>
        </div>
        <div class="row2picBC">
            <div class="blockPC"><a class="pictureC" href="img/photos/courierStep4.jpg"><img src="img/photos/courierStep4S.jpg" alt="Схема с курьером шаг 4"/></a></div><div class="blockPC rightB">
                <a class="pictureC" href="img/photos/courierStep5.jpg"><img src="img/photos/courierStep5S.jpg" alt="Схема с курьером шаг 5"/></a></div>
        </div>
    </div>

    <div class="constructor p30">
        <h3 class="headerText constructorHeader">Конструктор</h3>
        <?= $constructor; ?>
    </div>

    <div class="packages">
        <h3 class="headerText packageHeader">Готовые пакеты</h3>
        <div class="pack"><img class="packImg" src="img/photos/packMin.jpg" alt="Минимальный пакет"/><p class="headerText packHead">Для студентов</p><p class="usualText packText">стульчик<br/>печеньки<br/>чай</p></div><div class="packCenter"><img class="packImg" src="img/photos/packStandart.jpg" alt="Стандартный пакет"/><p class="headerText packHead">Для студентов со стипендией</p><p  class="usualText packText">стульчик<br/>печеньки<br/>чай<br/>кофе</p></div><div class="pack"><img class="packImg" src="img/photos/packMax.jpg" alt="Максимальный пакет"/><p class="headerText packHead">Для мажоров</p><p  class="usualText packText">стульчик<br/>печеньки<br/>чай<br/>кофе<br/>сургуч<br/>инициалы на печати</p></div>
    </div>
    <div class="warranty">
        <h3 class="headerText warrHead">Гарантии доставки</h3>
        <p class="usualText">Мы предоставляем гарантии доставки для вас. На ваш электронный адрес мы пришлем фотки курьера или почтового отправления.</p>
    </div>
    <footer>
        <div class="footBlock">
            <div><span class="to-about usualText footLink" >О сервисе</span></div>
            <div><span class="to-samples usualText footLink" >Примеры писем</span></div>
            <div><span class="to-process usualText footLink" >Как делается</span></div>
            <div><span class="to-constructor usualText footLink" >Конструктор</span></div>
            <div><span class="to-package usualText footLink" >Пакеты</span></div>
            <div><span class="to-warranty usualText footLink" >Гарантии</span></div>
        </div><div class="footBlock">
            <p class="usualText">Письмосыл © 2015. Все права защищены<br/><br/>
                Контакты:<br/>
                E-mail: <a href="mailto:info@pismosyl.com" class="usualText">info@pismosyl.com</a><br/>
                Телефон: +380 (93) 011-67-11<br/>
                Skype:  <a href="skype:pismosyl.com?chat" class="usualText">pismosyl.com</a></p>
        </div>
    </footer>
</div>