<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;

class StaffSearch extends Staff {

    public function two()
    {
        $select = self::find()
            ->joinWith(['cities' => function(ActiveQuery $query) {
                $query->andWhere(['cities.name' => 'Rhayader']);
            }, 'phones', 'emails'])
            ->groupBy(['id'])
            ->orderBy(['name' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $select,
        ]);

        return $dataProvider;
    }

    public function three()
    {
        $select = self::find()
            ->joinWith(['cities', 'staffPhones', 'emails'])
            ->andWhere(['LIKE', 'emails.name', '%.com', false])
            ->andHaving(['>', 'COUNT({{%staff_phones}}.staff__id)', 1])
            ->groupBy(['id', 'emails.id'])
            ->orderBy(['name' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $select,
        ]);
        
        return $dataProvider;
    }

    public function five()
    {
        $query = (new Query())
            ->select([
                '{{%phones}}.name as phone',
                '{{%staff}}.name',
            ])
            ->from('{{%staff}}')
            ->leftJoin('{{%staff_phones}}' ,'{{%staff}}.id = {{%staff_phones}}.staff__id')
            ->leftJoin('{{%phones}}' ,'{{%phones}}.id = {{%staff_phones}}.phones__id')
            ->andWhere(['IS NOT', '{{%staff_phones}}.staff__id', null])
            ->andWhere('YEAR({{%staff}}.created_at) = YEAR(NOW())')
            ->andWhere(['BETWEEN', 'MONTH({{%staff}}.created_at)', 4, 9])
            ->orderBy(['{{%staff}}.name' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

    public function six()
    {
        $query = (new Query())
            ->select([
                '{{%staff}}.name',
            ])
            ->from('{{%staff}}')
            ->leftJoin('{{%staff_phones}}' ,'{{%staff}}.id = {{%staff_phones}}.staff__id')
            ->leftJoin('{{%phones}}' ,'{{%phones}}.id = {{%staff_phones}}.phones__id')
            ->andWhere(['IS NOT', '{{%staff_phones}}.staff__id', null])
            ->andWhere('{{%phones}}.created_at = {{%phones}}.updated_at')
            ->groupBy(['{{%staff}}.name'])
            ->orderBy(['{{%staff}}.name' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}