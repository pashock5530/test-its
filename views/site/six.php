<?php
use yii\grid\GridView;
?>

<h3>
    Показать всех сотрудников, у кого мобильный телефон ни разу не
    редактировался (см. дату создания и дату обновления записи).
</h3>
<?= GridView::widget([
    'dataProvider' => $dataProvider
]); ?>