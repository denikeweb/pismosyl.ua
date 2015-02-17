<div class="wrapper">
	<div style="background: white">
		<div>
			<form action="" method="post">
				<button name="admin_sign_out" type="submit">Sign Out</button>
			</form>
		</div>
        <table class="orders">
            <tr >
                <th>Номер</th>
                <th>Статус</th>
                <th>Услуги</th>
                <th>Доставка</th>
                <th>Текст</th>
                <th>Цена</th>
                <th>Оплата</th>
                <th>Комментарий</th>
                <th>Клиент</th>
            </tr>
        </table>
		<pre>
			<?php print_r($data); ?>
		</pre>
	</div>
</div>