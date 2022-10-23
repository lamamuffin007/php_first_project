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
<a href = 'index.html'>Главная страница</a>
</p>
</td>
<td>

          <!-- PHP -->

<?php
$part = $_GET['part'];
//форма для заполнения
$form = "<form action = 'addpokup.php' method = get><table width = 100%>
<tr><td width = 25%><p>Ф. И. О</p></td><td><input type = 'text' size = 50 maxlenght = 255 name = 'fio'></td></tr>
<tr><td><p>Серия и номер паспорта</p></td><td><input type = 'text' size = 25 maxlenght = 9 name = 'pasp'></td></tr>
<tr><td><p>Скидка (%)</p></td><td><input type = 'text' size = 25 maxlenght = 6 name = 'skidka'></td></tr>
<tr><td><p>Отдел</p></td>
<td><select name = 'otdel'><option value = 0></option>
<option value = 1>Мясной отдел</option><option value = 2>Рыбный отдел</option>
<option value = 3>Хлебо-булочные изделия</option><option value = 5>Молочный отдел</option>
<option value = 6>Кондитерский отдел</option><option value = 7>Бакалея</option>
<option value = 8>Напитки</option></select></td>
<input type = 'hidden' name = 'part' value = 'go'>
<tr><td></td><td><br><input type ='submit' value = 'Добавить'></td></tr>
</table></form> ";
if ($part=="start")
{echo "<h2>Заполните форму:</h2><br>$form";}
if ($part=="go")
{
//запоминаем введенные данные
$fio = $_GET['fio']; //Ф.И.О покупателя
$pasp = $_GET['pasp']; // серия и номер паспрота
$ido = $_GET['otdel']; //отдел, в котором получена скидка
$skidka = $_GET['skidka']; //размер скидки
//проверяем введенность данных, если данные не введены – выводим форму для заполнения
if (($fio=="") or ($pasp=="") or ($skidka=="") or ($otdel==""))
{
{echo '<h2 style = "color : red">Заполните полностью форму:</h2><br>'.$form; }
}
else
{

  //подключаемся к СУБД MySQL
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "products";
  $mysqli = new mysqli($servername, $username, $password, $dbname) or die ("Ошибка подключения к MySQL");
//проверяем наличие записи об этом покупателе в базе данных
$sql = 'SELECT * FROM post_pokup WHERE fio = \''.$fio.'\' AND pasp = \''.$pasp.'\' AND ido = \''.$ido.'\' LIMIT 0,100';
$result = mysqli_query($mysqli,$sql);
//если запись есть – обновляем данные о скидке
$num = mysqli_num_rows($result);
if ($num !=0)
{
$row = mysqli_fetch_array($result);
$id = $row[0];
$sql="UPDATE post_pokup SET skidka='$skidka' WHERE (id='$id')";
$result = mysqli_query($sql);
echo '<h2>Запись добавлена...Вы можете добавить новую</h2><br>'.$form;
}
else
{
$sql = 'INSERT INTO post_pokup(id, ido, fio, pasp, skidka) VALUES (\'\', \''.$ido.'\', \''.$fio.'\', \''.$pasp.'\', \''.$skidka.'\');';
$result = mysqli_query($sql);
echo '<h2>Запись добавлена...Вы можете добавить новую</h2><br>'.$form;
}
}
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
