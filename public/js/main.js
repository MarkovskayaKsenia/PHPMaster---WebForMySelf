$('#currency').change(function(){
    window.location = '/currency/change?curr=' + $(this).val();
});

$('.available select').change(function() {
    var modId = $(this).val(),
        color = $(this).find('option').filter(':selected').data('title'),
        price = $(this).find('option').filter(':selected').data('price'),
        basePrice = $('#base-price').data('base');

    if(price) {
        $('#base-price').text(symbolLeft + price + symbolRight);
    } else {
        $('#base-price').text(symbolLeft + basePrice + symbolRight);
    }
});

/*Cart*/
$('body').on('click', '.add-to-cart-link', function(e) {
    e.preventDefault();
    var id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
        modification = $('.available select').val();

    $.ajax({
        url: '/cart/add/',
        data: {id: id, qty: qty, modification: modification},
        type: 'GET',
        success: function(res){
            showCart(res);
        },
        error: function(){
            alert('Ошибка, попробуйте позже!');
        }
    })
});

$('#cart .modal-body').on('click', '.del-item', function() {
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/delete',
        data: {id: id},
        type: 'GET',
        success: function(res) {
            showCart(res);
        },
        error: function() {
            alert("Error!");
        }
    });
});

function showCart(cart) {
    if ($.trim(cart) === '<h3>Корзина пуста</h3>') {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
    } else {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
    }
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
    if($('.cart-sum').text()) {
        $('.simpleCart_total').html($('#cart .cart-sum').text());
    } else {
        $('.simpleCart_total').text('Empty Cart');
    }
}

function getCart() {
    $.ajax({
        url: '/cart/show/',
        type: 'GET',
        success: function(res){
            showCart(res);
        },
        error: function(){
            alert('Ошибка, попробуйте позже!');
        }
    })
}

$('#cart .modal-footer').on('click', '.btn-clear', function () {
    $.ajax({
        url: '/cart/clear/',
        type: 'GET',
        success: function(res){
            showCart(res);
        },
        error: function(){
            alert('Ошибка, попробуйте позже!');
        }
    });
});
