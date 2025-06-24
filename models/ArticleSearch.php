<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;

class ArticleSearch extends Article
{
    public $globalSearch; // Добавляем новое свойство

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'content', 'created_at', 'globalSearch'], 'safe'], // Добавляем globalSearch
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Условия фильтрации
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        // Глобальный поиск
        if (!empty($this->globalSearch)) {
            $query->andFilterWhere(['or',
                ['like', 'title', $this->globalSearch],
                ['like', 'content', $this->globalSearch]
            ]);
        } else {
            // Стандартные фильтры
            $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'content', $this->content]);
        }

        return $dataProvider;
    }
}