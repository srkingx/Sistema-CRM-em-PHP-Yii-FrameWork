<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Telefone;

/**
 * TelefoneSearch represents the model behind the search form of `app\models\Telefone`.
 */
class TelefoneSearch extends Telefone
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_contato_cliente', 'fk_tipo_telefone'], 'integer'],
            [['telefone'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Telefone::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fk_contato_cliente' => $this->fk_contato_cliente,
            'fk_tipo_telefone' => $this->fk_tipo_telefone,
        ]);

        $query->andFilterWhere(['like', 'telefone', $this->telefone]);

        return $dataProvider;
    }
}
