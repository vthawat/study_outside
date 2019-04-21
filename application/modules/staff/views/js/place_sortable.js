$(function  () {
   // $("ul.place-sortable").sortable();
    $( "ul.place-sortable" ).sortable({
        onDrop: function($item, container, _super, event ) {
           // var order = $("ul.place-sortable").sortable("serialize", {key:'order[]'});
            //$( "p" ).html( order );
            $item.removeClass(container.group.options.draggedClass).removeAttr("style")
            $("body").removeClass(container.group.options.bodyClass)
            $('.splace-id').each(function (i) {
               $('li.pid-'+$(this).val()).find('.place-order-number').text(i+1);
            //console.log($(this).val());
            });
            loadWayPoint();
        }
    });
   

});