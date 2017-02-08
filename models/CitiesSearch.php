<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\Query;

class CitiesSearch extends Cities {

    public function one()
    {
        $query = (new Query())
            ->select([
                '{{%cities}}.name',
                'COUNT({{%staff_cities}}.staff__id) as count',
            ])
            ->from('{{%cities}}')
            ->leftJoin('{{%staff_cities}}' ,'{{%cities}}.id = {{%staff_cities}}.cities__id')
            ->leftJoin('{{%staff}}' ,'{{%staff}}.id = {{%staff_cities}}.staff__id')
            ->andWhere(['IS NOT', '{{%staff_cities}}.cities__id', null])
            ->andWhere(['>=', 'TIMESTAMPDIFF(YEAR,{{%staff}}.date_of_birth,CURDATE())', 30])
            ->andWhere(['>=', 'TIMESTAMPDIFF(MONTH,{{%staff}}.created_at,CURDATE())', 1])
            ->groupBy(['{{%staff_cities}}.cities__id'])
            ->orderBy(['{{%cities}}.name' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

    public function four()
    {
        $query = (new Query())
            ->select([
                '{{%cities}}.name',
                'AVG(TIMESTAMPDIFF(YEAR,{{%staff}}.date_of_birth,CURDATE())) AS age',
            ])
            ->from('{{%cities}}')
            ->leftJoin('{{%staff_cities}}' ,'{{%cities}}.id = {{%staff_cities}}.cities__id')
            ->leftJoin('{{%staff}}' ,'{{%staff}}.id = {{%staff_cities}}.staff__id')
            ->andWhere(['IS NOT', '{{%staff_cities}}.cities__id', null])
            ->andWhere(['=', '{{%staff}}.status', 0])
            ->groupBy(['{{%cities}}.id'])
            ->orderBy(['{{%cities}}.name' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

}