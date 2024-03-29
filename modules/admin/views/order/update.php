<?php
/*СТРАНИЦА ВИДА: РЕДАКТИРОВАНИЕ ЗАКАЗА*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

/*Начинаем редактирование страницы обновление заказа*/
$this->title = 'Редактирование заказа № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Список заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Заказ № {$model->id}", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<!--скопируем разметку из order/index-->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body"> <!--добавляем отступы в табличке-->
                <div class="order-update">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--далее откроем форму и внесем в нее некоторые правки-->


