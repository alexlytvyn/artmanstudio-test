<?php

use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Artman Studio Test Application';
?>

<h1>The List of Registered Users</h1>

<?php 
  if (Yii::$app->user->isGuest) {
    echo GridView::widget([
      'dataProvider' => $dataProvider,
      'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          'username'
      ],
    ]);
  } else {
    echo GridView::widget([
      'dataProvider' => $dataProvider,
      'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          'username',
          ['class' => 'yii\grid\ActionColumn', 'template' => '{view}', 'header' => 'Action']
      ],
    ]);
  }
?>
