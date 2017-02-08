<?php
use yii\grid\GridView;
?>

<h3>
    Показать всех сотрудников и название города, у которых более одного номера
    телефона и e-mail заканчивается на .com
</h3>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        [
            'attribute' => 'staffPhones',
            'label' => 'staff_phones',
            'value' => function($data) {
                return $data->getStaffPhones()->count();
            }
        ],
    ]
]); ?>