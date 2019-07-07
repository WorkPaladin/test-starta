<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="js/jquery-3.4.1.min.js"></script>
</head>
<body>
<header></header>

<main>
	<h1>Бронирование даты</h1>
	<h2>Тестовое задание на должность fullstack-разработчика</h2>

	<div class="container">
	<?
	$months = Array(
		0 => 'Январь',
		1 => 'Февраль',
		2 => 'Март',
		3 => 'Апрель',
		4 => 'Май',
		5 => 'Июнь',
		6 => 'Июль',
		7 => 'Август',
		8 => 'Сентябрь',
		9 => 'Октябрь',
		10 => 'Ноябрь',
		11 => 'Декабрь'
	);
	$atr_day = 0;
	for ($month = 1; $month <= 12; $month++) { ?>
		<div class="calendar">
			<div class="calendar_month"><?= $months[$month-1] ?></div>
			<table class="calendar_table">
			<tbody>
				<tr style="border-bottom: 5px solid #E7F5EC;">
					<td class="calendar_day">пн</td>
					<td class="calendar_day">вт</td>
					<td class="calendar_day">ср</td>
					<td class="calendar_day">чт</td>
					<td class="calendar_day">пт</td>
					<td class="calendar_day" style="background-color: #FA917A; color: #fff;">сб</td>
					<td class="calendar_day" style="background-color: #FA917A; color: #fff;">вс</td>
				</tr>
				<?
					$year = date("Y");
					echo calendar($month,$year);
				?>
			</tbody>
		</table>
		</div>
	<? }
	
	//подключаем конфигурационный файл
	include_once("php/config.php");
	//Получаем занятые дни из базы данных
	$sql = mysqli_query($mysqli, "SELECT `user_day` FROM `user_date`");
	$arr_day = array();
	$i = 0;

	//Сохраняем дни в блок, что ими можно было пользовать из js
	echo '<div class="reserved_days">';
  	while ($result = mysqli_fetch_array($sql)) {
    	$arr_day[$i] = $result['user_day'];
    	echo $arr_day[$i].",";
    	$i++;
  	}
  	echo "</div>";
  	 
	//$year="2019"; 
	//print date("j F",mktime(0,0,0,1,intval($arr_day[1]),intval($year)));

  	mysqli_close($mysqli);

	?>
	</div>
	<form action="" name="form_date"  id="form_date">
		<label>Укажите телефон:</label><br/>
		<input type="tel" name="tel" placeholder="+7 (___) ___-__-__" class="form_phone">
		<button type="submit" name="send" id="send" class="form_submit">Забронировать</button>
		<div class="error"></div>
	</form>
	<div class="background">
		<div id="responds">
			<div id="result"></div>
			<div id="close">X</div>
		</div>
	</div>
</main>
<?

function calendar($month, $year/*, $action = 'none'*/) {

	// выставляем начало недели на понедельник
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$running_day = $running_day - 1;
	if ($running_day == -1) {
		$running_day = 6;
	}

	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$day_counter = 0;
	$days_in_this_week = 1;
	$dates_array = array();

	// первая строка календаря
	$calendar = '<tr>';

	// вывод пустых ячеек
	for ($i = 0; $i < $running_day; $i++) {
		$calendar.= '<td></td>';
		$days_in_this_week++;
	}
	// дошли до чисел, будем их писать в первую строку
	for($list_day = 1; $list_day <= $days_in_month; $list_day++) {

		global $atr_day;
		$atr_day++;

		$calendar.= '<td class="calendar_day day_color" data-day="'.$atr_day.'">'.$list_day.'</td>';

		// дошли до последнего дня недели
		if ($running_day == 6) {
			// закрываем строку
			$calendar.= '</tr>';
			// если день не последний в месяце, начинаем следующую строку
			if (($day_counter + 1) != $days_in_month) {
				$calendar.= '<tr>';
			}
			// сбрасываем счетчики 
			$running_day = -1;
			$days_in_this_week = 0;
		} 

		$days_in_this_week++; 
		$running_day++; 
		$day_counter++;
	}

	// выводим пустые ячейки в конце последней недели
	if ($days_in_this_week < 8) {
		for($i = 1; $i <= (8 - $days_in_this_week); $i++) {
			$calendar.= '<td> </td>';
		}
	}
	$calendar.= '</tr>';
	$calendar.= '</table>';

	return $calendar;
} 
?>

<footer></footer>

<script type="text/javascript" src="js/mask.js"></script>
<script type="text/javascript" src="js/form_date.js"></script>
<script>
    $(".form_phone").mask("+7 (999) 999-99-99");
</script>
</body>
</html>