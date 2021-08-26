<?php
/*СТРАНИЦА ВИДА: ПРОСМОТР ДЕТАЛЕЙ ЗАКАЗА*/

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = "Заказ № {$model->id}";  // выводим в заголовке страницы номер заказа
$this->params['breadcrumbs'][] = ['label' => 'Список заказов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="row"><!--обернем таблицу в класс row-->
    <div class="col-md-12"><!--Задаем ширину таблицы на всю страницу-->
        <!--https://adminlte.io/themes/AdminLTE/pages/tables/simple.html
        Копируем готовую разметку для таблицы с сайта шаблона админки. Настраиваем её-->

        <div class="box">
            <div class="box-header with-border">
                <!--a("название кнопки", ["экшен"], ['class'])-->
                <?= Html::a('Редактирование заказа', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                &nbsp;
                <?= Html::a('Удалить заказ', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот заказ?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="box-body">
                <div class="order-view">
                    <?= DetailView::widget([
                        /*Здесь можно использовать такое же форматирование данных
                        как в order/index:*/
                        'model' => $model,
                        'attributes' => [
                            'id',
                            /*Изменим формат даты*/
//                            'created_at',  // 2021-08-13 00:45:12 старое
                            'created_at:datetime',  // 13 Aug 2021 03:45:12 новое
                            'updated_at',
                            'qty',
                            'total',
                            /*Настроим статус, вместо 1 и 0 подставим норм значениея:*/
//                            'status',
                            [
                                'attribute' => 'status',
                                /*Если статус вернет 1(true) "?" то вернем одно
                                значение. В противном случае ":" возвращаем другое значение*/
                                'value' => $model->status ? '<span class="text-green">Завершён</span>' :
                                    '<span class="text-yellow">Новый</span>',
                                /*для того что бы html адекватно читался устанавливаем настройку
                                format как сырую строку raw*/
                                'format' => 'raw',
                            ],
                            'name',
                            'email',
                            'phone',
                            'address',
                            'note:ntext',  // :ntext форматтор для сохранения переноса строк
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Далее выводим товары которые учавствуют в данном заказе.
Разметку таблицы берем с сайта adminlte 2
Товары выводим циклом используя связь моделей.
$model->orderProduct Данное действие задействует метод getOrderProduct таким образом мы получим все товары-->
<?php $items = $model->orderProduct ?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Товары в заказе</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>id</th>
                        <th>Наименование</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                    </tr>
                    <!--Далее проходимся циклом по полученным товарам и выдаем нужные-->
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= $item->title ?></td>
                            <td><?= $item->qty ?></td>
                            <td><?= $item->price ?></td>
                            <td><?= $item->total ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


