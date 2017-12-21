function reshowRow(obj){    
    
    var val = $(obj).val();
    
    $('.table-calc tr').each(function (key, row) {
        if(key < val){
            $(row).removeClass('hidden')
        } else {
            $(row).addClass('hidden');
        }
    });
}