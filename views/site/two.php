<?php
use yii\grid\GridView;
?>

    <h3>
        Показать имена сотрудников, их возраст, номера телефонов и e-mail.
        А также возраст сотрудников, которые проживают в городе "Rhayader".
    </h3>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        [
            'attribute' => 'date_of_birth',
            'format' => 'text',
            'label' => 'Age',
            'value' => function($data) {
                return $data->age;
            }
        ],
        [
            'attribute' => 'phones',
            'format' => 'html',
            'label' => 'Phones',
            'value' => function($data) {
                $str = '';
                foreach ($data->phones as $phone) {
                    $str .= "<p>{$phone->name}</p>";
                }
                return $str;
            }
        ],
        [
            'attribute' => 'emails',
            'format' => 'html',
            'label' => 'E-mails',
            'value' => function($data) {
                $str = '';
                foreach ($data->emails as $email) {
                    $str .= "<p>{$email->name}</p>";
                }
                return $str;
            }
        ],
    ]
]); ?>