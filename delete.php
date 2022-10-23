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
//запоминаем идентификатор, таблицу и имя поля записи, которую нужно удалить
$id = $_GET['id'];
$table = $_GET['table'];
$pole = $_GET['pole'];
if ($part == "start") //если начало процесса удаления
{
//выводим просьбу на подтверждение удаления
echo "<h2>Действительно хотите удалить запись?</h2><br>
<center><form action = 'delete.php' method = get>
<input type = 'submit' value = '&nbsp;&nbsp;&nbsp;&nbsp;ДА&nbsp;&nbsp;&nbsp;&nbsp;'>
<input type = hidden name = 'part' value = 'go'><input type = hidden name = 'id' value = $id>
<input type = hidden name = 'table' value = $table><input type = hidden name = 'pole' value = $pole>
</form></center>";
}
if ($part=="go") //если пользователь подтвердил удаление:
{
  //подключаемся к СУБД MySQL
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "products";
  $mysqli = new mysqli($servername, $username, $password, $dbname) or die ("Ошибка подключения к MySQL");
if ($table == "proizv") //если удаляет поставщика – удаляем также все записи о товарах, связанные с ним
{
//сначала удаляем товары
$sql = 'SELECT idp FROM product WHERE idpr = \''.$id.'\' LIMIT 0, 1000';
$result = mysqli_query($mysqli,$sql);
$num = mysqli_num_rows($result);
if ($num!=0)
{
while ($row = mysqli_fetch_array($result))
{
$sql = 'DELETE FROM product WHERE idp = \''.$row[0].'\' LIMIT 1';
$res = mysqli_query($sql);
};
}
//освобаждаем результаты запросов
mysqli_free_result($result);
//затем удалем запись о поставщике
$sql = 'DELETE FROM proizv WHERE idpr = \''.$id.'\' LIMIT 1';
$result = mysqli_query($sql);
}
else //если удаляет не поставщика
{
//строим запрос на удаление выбранной записи
$sql = 'DELETE FROM '.$table.' WHERE '.$pole.' = \''.$id.'\' LIMIT 1';
//выполняем запрос
$result = mysqli_query($sql);
}
//ввыводим сообщение о том, что запись удалена
echo '<h2 style = "color : red">Запись удалена</h2>';
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
