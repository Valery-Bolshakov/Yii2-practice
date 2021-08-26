/*Файл скриптов для админки*/
/*Данный скрипт используется для сайдбара админки. Что бы добавлять класс
"active" ссылке на которую мы кликнем. Этот класс будет выделять активным
ту ссылку на которую кликаем и убирать активный класс с предыдущей*/
$(function () {
    $('.sidebar-menu a').each(function () {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;
        if (link == location) {
            $('.sidebar-menu li').removeClass('active');
            $(this).parent().addClass('active');
            $(this).closest('.treeview').addClass('active');
        }
    })
})
/*Далее подключаем файл ф комплекте ресурсов AdminAsset*/