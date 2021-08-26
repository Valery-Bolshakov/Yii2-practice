<!--Вынесли сайдбар в отдельный фал и далее подключаем его в главном шаблоне
Админской панели-->

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <!--достаем имя пользователя админа из таблицы юзер-->
                <p><?= Yii::$app->user->identity->username ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!--Закомментируем форму для поиска за ненадобностью-->
        <!-- search form (Optional) -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <!--делаем ссылку на главную страницу контроллера MainController экшен actionIndex

            Так же меняем иконку на более подходящую по образцу class="fa + код иконки"
            Варианты иконок и необходимый класс можно посмотреть
            по ссылке https://adminlte.io/themes/AdminLTE/pages/UI/icons.html-->
            <li class="active"><a href="<?= \yii\helpers\Url::to(['main/index']) ?>">
                    <i class="fa fa-amazon"></i> <span>Статистика магазина</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-shopping-cart"></i> <span>Заказы</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['order/index']) ?>">
                            Список заказов</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['order/create']) ?>">
                            Добавить заказ</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
</aside>
