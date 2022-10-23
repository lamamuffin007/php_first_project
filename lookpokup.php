<!DOCTYPE html>
<html>
          <!-- HEAD -->

<head>
<title>Магазин продуктов</title>
<link rel = 'stylesheet' type = 'text/css' href = 'style.css'>
</head>

          <!-- BODY -->

<body>
<h1>Магазин продуктов</h1><br><Br>
<table width = 100% height = 80% valign = top>
<tr>
<td width = 15% valign = top>
<p style = 'text-indent : 0pt; font-size : 12pt'>
<a href = 'lookall.php?part=all'>Все товары</a><br><br>
<a href = 'lookpost.php'>Поставщики продукции</a><br><br>
<a href = 'lookpokup.php'>Постоянные покупатели</a><br><br>
<a href = 'lookrab.php'>Работники магазина</a><br><br><BR>
<a href = 'index.html'>Главная страница</a></p>
</td>
<td>


          <!-- PHP -->

<?php
//подключаемся к СУБД MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";
$mysqli = new mysqli($servername, $username, $password, $dbname) or die ("Ошибка подключения к MySQL");
//строим запрос для выбора покупателей и отделов, в которых разрешены скидки
$sql = 'SELECT post_pokup.fio, post_pokup.pasp, post_pokup.skidka, otdel.otdel, post_pokup.id FROM post_pokup,otdel WHERE otdel.ido = post_pokup.ido LIMIT 0,1000 ';
//выполняем запрос
$result = mysqli_query($mysqli,$sql);
//проверяем количество выбранных записей, если 0 – выводим сообщение о том, что записей нет, если > 0 – выводим их
$num = mysqli_num_rows($result);
if ($num==0)
{echo '<h2>Записей нет</h2>'; }
else
{
echo '<h2>Список постоянных покупателей</h2><br>';
//строим таблицу, в которую будем выводить записи
echo '<table width = 100% border = 1>
<tr heigth = 7%><th width = 5%><p class = "zag">№п.п</p></th>
<th width = 27%><p class = "zag">Ф. И. О</p></th>
<th width = 10%><p class = "zag">Номер и серия паспорта</p></th>
<th width = 10%><p class = "zag">Скидка (%)</p></th>
<th width = 15%><p class = "zag">Отдел продажи</p></th></tr>';
//заполняем таблицу постепенно обрабатывая запрос
$i = 1;
while ($row = mysqli_fetch_array($result))
{
echo '<tr>';
echo "<td><p class = 'small'>$i</p></td>
<td><p class = 'small'>$row[0]</p></td>
<td><p class = 'small'>$row[1]</p></td>
<td><p class = 'small'>$row[2]</p></td>
<td><p class = 'small'>$row[3]</p></td>
<td width = 10%><p class = 'small'><a href = 'delete.php?part=start&id=$row[4]&table=post_pokup&pole=id'>Удалить</a></p></td>";
echo '</tr>';
$i++;
};
echo '</table>';
echo '<br><p><a href = "addpokup.php?part=start">Добавить нового покупателя</a></p>';
}
?>
</td>
<td width = 15% valign = top>
<p style = 'text-indent : 0pt; font-size : 12pt'>
Отделы продаж:<br><BR>
<a href = 'lookotdel.php?id=1'>Мясной отдел</a><br><br>
<a href = 'lookotdel.php?id=2'>Рыбный отдел</a><br><br>
<a href = 'lookotdel.php?id=3'>Хлебо-булочные изделия</a><br><br>
<a href = 'lookotdel.php?id=5'>Молочный отдел</a><br><br>
<a href = 'lookotdel.php?id=6'>Кондитерский отдел</a><br><br>
<a href = 'lookotdel.php?id=7'>Бакалея</a><br><br>
<a href = 'lookotdel.php?id=8'>Напитки</a><br><br>
</p>
</td>
</tr>
<tr height = 10%><td></td><td colspan = 15%><p style = 'text-align : right; color : red;'>Выполнила студентка группы 228/11 Попова Е.С &copy;</td></tr>
</table>
</body>
</html>
