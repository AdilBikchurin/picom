<?php
// Дополнительные допущения:
// 1. Не проверяется наличие файла и его доступность для чтения
// 2. Предполагается, что кодовая страница текста - Юникод (UTF-8)
// 3. Все слова выводятся в нижнем регистре
$filename = "jack.txt";
$min_len = 1000;
$cyr = "1234567890АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЬьЪъЫыЮюЬьЭэЯя";  //Для русскоязычных текстов
$text = file_get_contents($filename);
if (strlen($text)<$min_len) {
	echo "Текст короче, чем  $min_len символов";
} else
{ 
	$text = mb_strtolower($text); // т.к. регистр букв не учитывается
	$word_array   = str_word_count($text, 1, "$cyr"); //Делит текст на слова 
	$words = array_count_values($word_array); //Создает массив "слово" => "частота повторений слова"
// Создаем вспомогательные массивы вместо ассоциативного
$i = 0;
foreach($words as $key => $value)
{
$st[$i] = $key;
$fr[$i] = $value;
$i++;
}
// Сортировка пузырьком
for ($i = 0; $i < count($st); $i++){
	for ($j = $i + 1; $j < count($st); $j++) {
			if ($fr[$j] > $fr[$i]) {
			$temps = $st[$j];
			$tempf = $fr[$j];
			$st[$j] = $st[$i];
			$fr[$j] = $fr[$i];
			$st[$i] = $temps;
			$fr[$i] = $tempf;
		}
	}         
}
for ($i = 0; $i < count($st); $i++){
echo "$st[$i] - $fr[$i] <br />";
}
}
?>
                 