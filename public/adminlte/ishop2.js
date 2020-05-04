$('.delete').click(function() {
    var result = confirm('Подтвердите действие');
    if (!result) {
        return false;
    }
})


$('.sidebar-menu a').each(function() {
    var location = window.location.protocol + '//' + window.location.host + window.location.pathname;
    var link = this.href;
    if(link === location) {
        $(this).parent().addClass('active');
        $(this).closest('.treeview').addClass('active');
    }
});