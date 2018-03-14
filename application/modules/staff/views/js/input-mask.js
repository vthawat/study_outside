$(function () {
   Inputmask.extendAliases({
  'myNum': {
    alias: "numeric",
    placeholder: '',
    allowPlus: false,
    allowMinus: false,
    rightAlign:false,
    digits:2,
    groupSeparator:',',
    autoGroup:true
  }
});
$('.money-per-month').inputmask("myNum");
$('.num-male').inputmask("myNum");
$('.num-female').inputmask("myNum");
$('.num-family-member').inputmask("myNum");

});