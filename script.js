$(document).ready(function(){
    $(".jqueryoption").click(function(){
    var loai = $(this).attr('loai');    var loaiid = $(this).attr('loaiid');    var request = $(this).attr('request');
        $("#myModal").load("/xuly.php?loai="+loai+"&loaiid="+loaiid+"&request="+request);
    });
	
    
    /**
     * Like/Quan tam Button
     */
	$(".actlike").click(function(){
	    var likeid = $(this).attr('likeid');
	    var request = $(this).attr('request');
        
	    $(this).load("/xulylike.php?likeid="+likeid+"&request="+request);
    });
});

