/** @author Max Milbers, copyright by the author and VirtueMart team , license MIT */
var keepAlive = function($) {
    jQuery(function(){
        var lastUpd = 0;
        var kAlive = 0;
        var minlps = 1;
        var maxlps = 3;
        var stopped = true;
        console.log('keepAlive each '+sessTime+' minutes');
        var tKeepAlive = function($) {
            if(stopped){
                kAlive = 0;
                console.log('Start keep alive, kAlive '+kAlive);
                var loop = setInterval(function(){
                    if(kAlive >= minlps && new Date().getTime() - lastUpd > 60 * 1000 * sessTime*(maxlps + 0.90)){
                        console.log('Stop keep alive '+kAlive);
                        stopped = true;
                        clearInterval(loop);
                    }else{
                        kAlive++;
                        jQuery.get(vmBaseUrl+'index.php?option=com_virtuemart&view=virtuemart&task=keepalive');
                    }
                }, 60 * 1000 * sessTime*0.95); //mins * 60 * 1000
                stopped = false;
            }
        };
        tKeepAlive();
        //Editors like tinyMCE unbind any event. Using binds like focusin/click, update keep alive using the tool bar
        jQuery("body").live('keyup focus click', function(e){
            lastUpd = new Date().getTime();
            console.log('keepAlive body ', e.type);
            if(stopped){
                jQuery.get(vmBaseUrl+'index.php?option=com_virtuemart&view=virtuemart&task=keepalive');
                tKeepAlive();
            }
        });

    });
};
keepAlive();
