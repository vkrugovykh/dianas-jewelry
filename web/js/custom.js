//Очистка корзины
function clearCart(event, conf) {
    event.preventDefault();
    function ajaxSend() {
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function (res) {
                $('.content').html(res);
                $('.menu-total-quantity').html(0);
                $('.menu-total-sum').html(0);
            },
            error: function () {
                alert('error');
            }
        })
    }
    if (conf) {
        if (confirm('Точно очистить корзину?')) {
            ajaxSend();
        }
    } else {
        ajaxSend();
    }

}

//Добавление товара в корзину
$('.btn-add').on('click', function(event) {
    event.preventDefault();
    let alias = $(this).data('alias');
    let qnt = 1;
    if ($('span.option').text()) {
        qnt = $('span.option').text();
    }
    $.ajax({
        url: '/cart/add',
        data: {alias: alias, qnt: qnt},
        type: 'GET',
        success: function(response) {
            let res = response.split('/');

            $('.menu-total-quantity').html(res[0]);
            $('.menu-total-sum').html(res[1]);
        },
        error: function() {
            alert('error');
        }
    })

});

function loadAll() {
    //Меню категорий, текущей категории добавляется класс active
    let splitFirst = window.location.href.split('/');
    let idFirst = splitFirst[splitFirst.length - 1];
    let splitSecond = idFirst.split('?');
    let id = splitSecond[0];

    let nav = document.querySelectorAll('#menu li');

    for (let i = 0; i < nav.length; i++) {

        if (nav[i].getAttribute('data-id') == id) {
            nav[i].classList.add('active');
            break;
        }
    }


    //Изменение количества товаров в корзине
    $('body').on('click', '.crf-sm li',  function() {
        let qnt = $(this).text();
        let id = $('#' + $(this).offsetParent().data('id')).parent('.qnt').data('id');
        // let alias = $('#' + $(this).offsetParent().data('id')).parent('.qnt').data('alias');

        $.ajax({
            url: '/cart/change',
            data: {qnt: qnt, id: id},
            type: 'GET',
            success: function(response) {
                $('.content').html(response);
                loadAll();
                $("select").crfs();
                let totalSum = 0;
                let totalCount = 0;
                if ($('.total-count .total-quantity').html()) {
                    totalSum = $('.total-count .total-sum').html().split('₽')[1];
                    totalCount = $('.total-count .total-quantity').html().split(': ')[1];
                }
                $('.menu-total-quantity').html(totalCount);
                $('.menu-total-sum').html(totalSum);
            },
            error: function() {
                alert('error');
            }
        })
    });


    //Удаление товара из корзины
    $('.cart-table').on('click', '.delete',  function() {
        let id = $(this).data('id');
        // console.log($(this).data('id'));

        $.ajax({
            url: '/cart/delete',
            data: {id: id},
            type: 'GET',
            success: function(response) {
                $('.content').html(response);
                loadAll();
                $("select").crfs();
                let totalSum = 0;
                let totalCount = 0;
                if ($('.total-count .total-quantity').html()) {
                    totalSum = $('.total-count .total-sum').html().split('₽')[1];
                    totalCount = $('.total-count .total-quantity').html().split(': ')[1];
                }
                $('.menu-total-quantity').html(totalCount);
                $('.menu-total-sum').html(totalSum);


            },
            error: function() {
                alert('error');
            }
        });
    })
}

$(document).ready(loadAll);
// loadAll();