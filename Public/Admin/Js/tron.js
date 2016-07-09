/**
 * Created by PurpleDawn on 2016/7/7.
 */
$(".tron").mouseover(function(){
    $(this).find('td').css('backgroundColor', '#F2FCFF');
});
$(".tron").mouseout(function(){
    $(this).find('td').css('backgroundColor', '#FFF');
});