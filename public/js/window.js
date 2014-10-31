<!---------------js插件---------->
[html]
//获取窗口的高度 
var windowHeight; 
//获取窗口的宽度 
var windowWidth; 
//获取弹窗的宽度 
var popWidth; 
//获取弹窗高度 
var popHeight; 
function init(){ 
   windowHeight=$(window).height(); 
   windowWidth=$(window).width(); 
   popHeight=$(".window").height(); 
   popWidth=$(".window").width(); 
} 
//关闭窗口的方法 
function closeWindow(){ 
    $(".title img").click(function(){ 
        $(this).parent().parent().hide("slow"); 
        }); 
    } 
    //定义弹出居中窗口的方法 
    function popCenterWindow(){ 
        init(); 
        //计算弹出窗口的左上角Y的偏移量 
    var popY=(windowHeight-popHeight)/2; 
    var popX=(windowWidth-popWidth)/2; 
    //alert(popY); 
    //设定窗口的位置 
    $("#tc_box").css("top",popY).css("left",popX).show();  
    closeWindow(); 
    } 
    function popLeftWindow(){ 
        init(); 
        //计算弹出窗口的左上角Y的偏移量 
    var popY=windowHeight-popHeight; 
    //var popX=-(windowWidth-popWidth); 
    //alert(popY); 
    //设定窗口的位置 
    $("#left").css("top",popY).css("left",0).slideToggle("slow"); 
    closeWindow(); 
    } 
    function popRightWindow(){ 
        init(); 
        //计算弹出窗口的左上角Y的偏移量 
    var popY=windowHeight-popHeight; 
    var popX=windowWidth-popWidth; 
    //alert(popY); 
    //设定窗口的位置 
    $("#right").css("top",popY).css("left",popX).slideToggle("slow"); 
    closeWindow(); 
    } 