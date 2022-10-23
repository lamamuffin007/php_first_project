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
//форма для ввода данных пользователя
$form = "<form action = 'addproduct.php' method = get><table width = 100%>
<tr><td colspan = 2><p class = 'zag'>Данные о товаре</td></tr>
<tr><td width = 25%><p>Название</p></td><td><input type = 'text' size = 50 maxlenght = 255 name = 'nazvp'></td></tr>
<tr><td><p>Цена (руб.)</p></td><td><input type = 'text' size = 15 maxlenght = 9 name = 'price'></td></tr>
<tr><td><p>Срок годности</p></td><td><input type = 'text' size = 25 maxlenght = 255 name = 'srok'></td></tr>
<tr><td><p>Отдел для продажи этого товара:</p></td>
<td><select name = 'otdel'><option value = 0></option>
<option value = 1>Мясной отдел</option><option value = 2>Рыбный отдел</option>
<option value = 3>Хлебо-булочные изделия</option><option value = 5>Молочный отдел</option>
<option value = 6>Кондитерский отдел</option><option value = 7>Бакалея</option>
<option value = 8>Напитки</option></select></td>
<tr><td colspan = 2><p class = 'zag'>Данные о производителе</td></tr>
<tr><td width = 25%><p>Название фирмы</p></td><td><input type = 'text' size = 50 maxlenght = 255 name = 'nazvpr'></td></tr>
<tr><td><p>Адрес</p></td><td><input type = 'text' size = 50 maxlenght = 255 name = 'sity'></td></tr>
<input type = 'hidden' name = 'part' value = 'go'>
<tr><td></td><td><br><input type ='submit' value = 'Добавить'></td></tr>
</table></form> ";
if ($part=="start")
{echo "<h2>Заполните форму:</h2><br>$form";}
if ($part=="go")
{
//запоминаем введенные данные
$nazvp = $_GET['nazvp']; //название продукта
$nazvpr = $_GET['nazvpr']; //название производителя
$price = $_GET['price']; //цена товара
$srok = $_GET['srok']; //срок годности товара
$sity = $_GET['sity']; //адрес производителя
$otdel = $_GET['otdel']; //отдел продажи
//проверяем введенность данных, если данные не введены – выводим форму для заполнения
if (($nazvp=="") or ($nazvpr=="") or ($price=="") or ($srok=="") or ($sity=="") or ($otdel==""))
{echo '<h2 style = "color : red">Заполните полностью форму:</h2><br>'.$form; }
else
{
  //подключаемся к СУБД MySQL
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "products";
  $mysqli = new mysqli($servername, $username, $password, $dbname) or die ("Ошибка подключения к MySQL");
//проверяем наличие такого товара в базе данных
//строим запрос
$sql = 'SELECT * FROM product WHERE nazv = \''.$nazvp.'\' AND price = \''.$price.'\' AND srok = \''.$srok.'\' LIMIT 0,1000';
//выполняем запрос
$result = mysqli_query($mysqli,$sql);
//вызываем функцию, считающую количество возвращенных записей
$num = mysqli_num_rows($result);
if ($num==0) //если записи нет
{
//добавление записи
//проверяем наличие введенного производителя
$idpr = 1; //идентификатор записи о производителе
//строим запром, выбирающий введенные данные
$sql = 'SELECT * FROM proizv WHERE nazv = \''.$nazvpr.'\' AND sity = \''.$sity.'\' AND ido = \''.$otdel.'\' LIMIT 0,1000';
//выполняем запрос
$result = mysqli_query($sql);
//если запись есть – запоминаем ее ифнтификатор
$n = mysqli_num_rows($result);
if ($n != 0)
{
$row = mysqli_fetch_array($result);
$idpr = $row[0];
}
//если записи нет – добавляем новую и запоминаем ее идентификатор
else
{
//добавление записи о производителе
$sql = 'INSERT INTO `proizv` (`idpr`, `ido`, `nazv`, `sity`) VALUES (\'\', \''.$otdel.'\', \''.$nazvpr.'\', \''.$sity.'\');';
$result = mysqli_query($sql);
//выбираем добавленную запись и запоминаем идентификатор
//строим запром, выбирающий введенные данные
$sql = 'SELECT * FROM proizv WHERE nazv = \''.$nazvpr.'\' AND sity = \''.$sity.'\' AND ido = \''.$otdel.'\' LIMIT 0,1000';
//выполняем запрос
$result = mysqli_query($sql);
// запоминаем идентификатор
$row = mysqli_fetch_array($result);
$idpr = $row[0];
}
//зная идентификатор производителя, добавляем запись о новом товаре
$sql = 'INSERT INTO `product` (`idp`, `idpr`, `nazv`, `srok`, `price`) VALUES (\'\', \''.$idpr.'\', \''.$nazvp.'\', \''.$srok.'\', \''.$price.'\');';
$result = mysqli_query($sql);
echo '<h2>Запись добавлена. Вы можете добавить еще...</h2><br>'.$form;
}
else //если запись есть
{ echo '<h2>Такая запись уже есть в базе данных... Введите новые данные</h2><br>'.$form;}
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
