function refreshReceivedNotification() {
    $.ajax({
        url : "http://local.tungace.com:1234/index.php?action=getNumReceivedNotification",
        dataType : "html"
    }).done(function( data ) {
        $('.receivedNotificationNumber').html(Number(data));
    });
}

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
    
    refreshReceivedNotification();
    
    setInterval(function() {
        $.ajax({
            url : "http://local.tungace.com:1234/index.php?action=getNumPendingNotification",
            dataType : "html"
        }).done(function( data ) {
            if (Number(data) > 0) {
                var notificationAudio = new Audio('./facebookSound.wav');
                notificationAudio.play();
                
                refreshReceivedNotification();
                $('.receivedNotificationNumber').html(Number(data));
            }
        });
    }, 2000); //5 seconds
        
    $('.readNotification').click(function(){
        $('.notification-cell a').removeClass('btn-info');
        $('.notification-cell a').addClass('btn-default');
    
        $.ajax({
            url : "http://local.tungace.com:1234/index.php?action=getReceivedNotification",
            dataType : "html"
        }).done(function( data ) {
            if ($('.notification-cell').length) {
                $('.notification-cell').first().before(data);
            } else {
                $('.notification-divider').before(data);
            }
        });
        
        $.ajax({
            url : "http://local.tungace.com:1234/index.php?action=readAllReceivedNotification",
            dataType : "html"
        });
        $('.receivedNotificationNumber').html(0);
    });
});

