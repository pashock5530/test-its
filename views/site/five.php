<?php
use yii\grid\GridView;
?>

<h3>
    Показать телефоны всех сотрудников, добавленных с апреля по сентябрь
    текущего года включительно.
</h3>
<?= GridView::widget([
    'dataProvider' => $dataProvider
]); ?>