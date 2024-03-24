$().ready(()=>{
    $('.input-daterange input').each(function() {
        $(this).datepicker({clearBtn: true},'clearDates');
        
    });


});