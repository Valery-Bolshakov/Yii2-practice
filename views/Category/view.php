<?php
$id = Yii::$app->request->get('id'); // $id = гет парамтру id из таблицы category, который передается ссылкой
//echo $id;
$category_arr = [
    1 => 'products',
    2 => 'household',
    4 => 'vegetables',
    5 => 'vegetables',
    6 => 'kitchen',
    7 => 'kitchen',
    9 => 'drinks',
    10 => 'drinks',
    11 => 'pet',
    13 => 'frozen',
    14 => 'frozen',
    15 => 'bread',
];
echo $this->render("$category_arr[$id]");

?>
