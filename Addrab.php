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
$part = $_GET['part'];
//форма для заполнения
$form = "<form action = 'addrab.php' method = get><table width = 100%>
<tr><td width = 25%><p>Ф. И. О</p></td><td><input type = 'text' size = 50 maxlenght = 255 name = 'fio'></td></tr>
<tr><td><p>Профессия</p></td><td><input type = 'text' size = 50 maxlenght = 255 name = 'prof'></td></tr>
<tr><td><p>Оклад</p></td><td><input type = 'text' size = 25 maxlenght = 6 name = 'oklad'></td></tr>
<tr><td><p>Стаж работы</p></td><td><input type = 'text' size = 25 maxlenght = 6 name = 'stag'></td></tr>
<input type = 'hidden' name = 'part' value = 'go'>
<tr><td></td><td><br><input type ='submit' value = 'Добавить'></td></tr>
</table></form> ";
if ($part=="start")
{echo "<h2>Заполните форму:</h2><br>$form";}
if ($part=="go")
{
//запоминаем введенные данные
$fio = $_GET['fio']; //Ф.И.О покупателя
$prof = $_GET['prof']; // профессия работника
$stag = $_GET['stag']; //стаж работы
$oklad = $_GET['oklad']; //оклад
//проверяем введенность данных, если данные не введены – выводим форму для заполнения
if (($fio=="") or ($prof=="") or ($oklad=="") or ($stag==""))
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
//проверяем наличие записи об этом работнике в базе данных
$sql = 'SELECT * FROM rabotn WHERE fio = \''.$fio.'\' AND prof = \''.$prof.'\' AND stag = \''.$stag.'\' LIMIT 0,100';
$result = mysqli_query($mysqli,$sql);
//если запись есть – обновляем данные об окладе
$num = mysqli_num_rows($result);
if ($num !=0)
{
$row = mysqli_fetch_array($result);
$id = $row[0];
$sql="UPDATE rabotn SET oklad='$oklad' WHERE (id='$id')";
$result = mysqli_query($sql);
echo '<h2>Запись обновлена...Вы можете добавить новую</h2><br>'.$form;
}
else
{
$sql = 'INSERT INTO rabotn(id, fio, prof, stag, oklad) VALUES (\'\', \''.$fio.'\', \''.$prof.'\', \''.$stag.'\', \''.$oklad.'\');';
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
