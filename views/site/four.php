<?php
use yii\grid\GridView;
?>

<h3>
    Показать средний возраст текущих сотрудников (статус - 0) по каждому городу.
</h3>
<?= GridView::widget([
    'dataProvider' => $dataProvider
]); ?>