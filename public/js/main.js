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

function showCart(cart) {
    console.log(cart);
}