YAHOO.namespace('My.UI.Dialog');
YAHOO.My.UI.Dialog = new function()
{


var trace = function(s)
{    
    try{  console.debug( s ) }catch(err){}
}


var nId = 0;
var zIndex = 50; 

//shortcuts
var $D = YAHOO.util.Dom;
var $R = YAHOO.util.Region;
var $GA = function (d,s){return d.getAttribute(s)}
var $DC = function(s){return document.createElement(s)}
var $AC = function(){$D.addClass.apply($D,arguments)}
var $RC = function(){$D.removeClass.apply($D,arguments)}
var $E =  YAHOO.util.Event;
var $AE = function(){$E.on.apply($E,arguments)}
var $RE = function(){$E.removeListener.apply($E,arguments)}
var $d = document;
var $$ = function(d,s){return (d || $d).getElementsByTagName(s ||'*')};
var $ = $D.get;
var $GC= function(q,w,e,r,t,y){ return $D.getElementsByClassName(q,w,e,r,t,y) }
var isIE = !!document.uniqueID;
var $root = $d.documentElement;
var dSky = $('layout-sky');
var dCloud = $('layout-cloud');
var dFocalElement ; 
var dFocalTarget ;
var dEventStopper;
var dLightMask;
var dLastHoverBox;
var dDialogTempFrame;
var hasSelectBug = !!(document.uniqueID && !window.XMLHttpRequest) ;
var oLastOpenedDismissDialog ;

var getScrollLeft = function()
{
    if($d.body)
    {
        return Math.max( $root.scrollLeft , $d.body.scrollLeft );
    }else{
        return $root.scrollLeft;
    }
}

var getScrollTop = function()
{
    if($d.body)
    {
        return Math.max( $root.scrollTop , $d.body.scrollTop );
    }else{
        return $root.scrollTop;
    }
}

//prepare for autoDismiss
var bPreventClick ;
var onDocumentClick = new YAHOO.util.CustomEvent('documentclick');
var onDocumentClickHandler = function(e , isFromStop)
{   
    if(bPreventClick)
    {
        return;
    }
    
    try{
	//trace('onDocumentClickHandler');
    var dEl = e.target || e.srcElement ;
   
    if(dEl == $d) 
    {
        //trace('onDocumentClick.fire');
        onDocumentClick.fire(3);
        return;
    }
    
	while( dEl )
	{	
        if( dEl.isYUIDialog || dEl.isYUIDialogPreventAutoDismiss || dEl.isYUIDialogComponent)
		{			
            //trace('cancel onDocumentClick');
            return;
		}
		dEl = dEl.parentNode ;
	}
    
    if(isFromStop)
    {
        onDocumentClick.fire(2);    
    }
    else
    {
        onDocumentClick.fire(3);   
    }
    return;	
    }catch(oh){}

}

var eventStop = $E.stopEvent ;
$E.stopEvent = function(e)
{
	 if(e && e.type == 'click')
	 {
		onDocumentClickHandler(e,true);
	 }
	 eventStop.apply(this,arguments);
}

//when click, dismiss all dialogs while auto dismiss =1;
$E.on($d,'click',onDocumentClickHandler);


var appendHTML = function (dEl,sHTML , bAfterBegin)
{
 if(!dEl){
 throw Error('appendHTML:dEl is null');
 return;
 }
 
 var d1stChild ;
 if( !( d1stChild = dEl.firstChild ) )
 {
	//if there's no firstChild
	dEl.innerHTML = sHTML;
	return;
 }
 
 bAfterBegin = ( !!bAfterBegin )||  false;

 if(dEl.insertAdjacentHTML)
 {
	bAfterBegin = bAfterBegin?'AfterBegin':'BeforeEnd';
	dEl.insertAdjacentHTML(bAfterBegin,	sHTML );
 }
 else
 {	
	try
	{			
		var r = dEl.ownerDocument.createRange();
		r.setStartBefore(dEl);
		var dSnippet = r.createContextualFragment(sHTML);
		if(bAfterBegin)
		{
			dEl.insertBefore(dSnippet ,d1stChild );
		}
		else
		{
			dEl.appendChild(dSnippet);
		}
	}
	catch(err)
	{
		var tempNode = document.createElement('div');
		tempNode.innerHTML = sHTML ;
		var c ;
		if(bAfterBegin)
		{
			while(c = tempNode.firstChild )
			{
				dEl.insertBefore(c , d1stChild);			
			}
		}
		else
		{
			while(c = tempNode.firstChild )
			{
				dEl.appendChild(c);			
			}
		};
		tempNode = null;			
	}		
 }};



//Focus management
var onFocusIn= function(e)
{
	if(!dEventStopper || (dEventStopper && !dEventStopper.display))
	{
		return true;		
	}
    
	dFocalElement = e.srcElement || e.target ;	
	var dEl = dFocalElement ; 
	
	if(dEl == $d || !dEl )
	{
		try{
        if(dFocalTarget)
		{
			dFocalTarget.focus();			
		}}catch(oh){ dFocalTarget = null ; }
	}
	
	while( dEl = dEl.parentNode )
	{
		if(dEl.isYUIDialog)
		{
			return;
		}
	}

	if(dEl == $d || !dEl )
	{
		if(dFocalTarget)
		{
			try{ dFocalTarget.focus();}catch(oh){}	
		}
	}	

	$E.stopEvent(e);
	return false;
}
if(document.uniqueID){YAHOO.util.Event.on( document , 'focusin' , onFocusIn );}else{document.addEventListener('focus', onFocusIn, true);	}


//getArgument
var getArguments = function( oArg ){

    oArg = oArg  || [] ;
    oArg = oArg[0] || {};	
    
    if(typeof(oArg) != 'object')
    {
        oArg = { html: [ '' , oArg ].join('') , buttonText:'ok' };
    }
    
    
    if( typeof( oArg.callback ) != 'function' )
    {
        oArg.callback = function(){};
    }
    if(!oArg.buttonText || !oArg.buttonText.shift)
    {
        oArg.buttonText = [ oArg.buttonText  || '' ] ;
    }

   
    
    if(oArg.dragDrop==null){ oArg.dragDrop = 1  } 
    if(typeof( oArg.minWidth )!= 'number' )
    {
        oArg.minWidth = 220 ;
        
    }else{
        oArg.minWidth = Math.max( oArg.minWidth , 100)				
    }
    
    if(typeof( oArg.maxWidth )!= 'number' )
    {
        oArg.maxWidth = 600 ;
    } 

    if(typeof( oArg.displayDelay )!= 'number' )
    {
        oArg.displayDelay = 500 ;
    }  

    if(typeof( oArg.dismissDelay )!= 'number' )
    {
        oArg.dismissDelay = 500 ;
    }       
	
	//oArg.opacity = 0.5; 
    
    return oArg ;
}


//Mask Control
var _resizeMask_ ;
var _resizeMaskLoop ;
var resizeH ;
var resizeW ;
var resizeY ;
var resizeMask = function(e)
{
    if(_resizeMask_)
    {
        clearTimeout(_resizeMask_);
    }
    
    var doit = function()
    {
        var h= Math.max($root.clientHeight , $root.scrollHeight );
        var w= Math.max($root.clientWidth , $root.scrollWidth );
        var bSizeChange ; 
        if(resizeH!=h){  resizeH = h; bSizeChange = 1;  }
        if(resizeW!=w){  resizeH = w; bSizeChange = 1;}

		/*
        if(resizeY!=$root.scrollTop)
        {
             dEventStopper.style.top = $root.scrollTop;
        }
		*/
     
        if( bSizeChange && dEventStopper && dEventStopper.display && w)
        {    
            /*
			dEventStopper.style.height =   $D.getViewportHeight() + 'px';	
            dEventStopper.style.width =   $D.getViewportWidth() + 'px';	
			*/
			
			dEventStopper.style.height =   h + 'px';
			dEventStopper.style.width =   w + 'px';	
        }
		/*
        
        if( bSizeChange && dLightMask && dLightMask.display && h ){ dLightMask.style.height = h + 'px' ; dLightMask.style.width =   w + 'px';	 }
		*/
	};
    
    if(e && e.type){
    _resizeMask_ = setTimeout(doit,100);	
    }else{
    _resizeMask_ = setTimeout(doit,0);	
    }    
}

$AE( window  ,'resize' ,resizeMask);


var setMask = function( bStopEvent , bDisplayMask )
{		
    bStopEvent = !!bStopEvent;
    bDisplayMask = !!bDisplayMask;
   
    var h= Math.max($root.clientHeight , $root.scrollHeight );
    var w= Math.max($root.clientWidth , $root.scrollWidth );
    
    //create basi masks
    if(!dEventStopper)
    {
       return;
    }
    
    if(!dLightMask)
    {
       return;
    }
    
    if( bStopEvent  )
    {
        /*
        dEventStopper.style.height =   $D.getViewportHeight() + 'px';	
        dEventStopper.style.width =   $D.getViewportWidth() + 'px';	
		*/

	

		dEventStopper.style.height =   h + 'px';
		dEventStopper.style.width =   w + 'px';	

        dEventStopper.style.zIndex = zIndex -2;
        dEventStopper.display = 1;

		if(!_resizeMaskLoop)
        {
         _resizeMaskLoop = setInterval(resizeMask , 500 );
        }

		$AC( $root , 'yui-simple-dialog-has-mask');
    }
    else if( dEventStopper ){    
        
        if(_resizeMaskLoop)
        {
         clearInterval(_resizeMaskLoop);
         _resizeMaskLoop = null;
        }
		
		$RC( $root , 'yui-simple-dialog-has-mask');

		dEventStopper.style.height = 0 ; 	
        dEventStopper.display = 0;
        
       
    };
	
	return;


    if( bDisplayMask )
    {
        if(!_resizeMaskLoop)
        {
         _resizeMaskLoop = setInterval(resizeMask , 500 );
        }
        
        
        dLightMask.style.height =   h + 'px';
        dLightMask.style.width =   w + 'px';	
        dLightMask.style.zIndex = zIndex -1;
        dLightMask.display = 1;
    }
    else if( dLightMask )
    {    
        if(_resizeMaskLoop)
        {
         clearInterval(_resizeMaskLoop);
         _resizeMaskLoop = null;
        }
        
        dLightMask.style.height = 0 ;  
        dLightMask.display = 0 ;
    };     
            
}

    
var noEvent = function(e)
{
    $E.stopEvent(e);
    return false;
}
    
var simpleDialog = function(oArg)
{
    var nScrollTop =  getScrollTop();
    
    
    
    var sId =  'simple-dialog-hedgerwow-' + (nId +=1);
 
    
    this.id = sId;    
    this._arg = oArg ; 
   
    appendHTML( dSky , this.createDialogHTML() );
    this.applyLayout(); 
   
    
    var dBox = this.__box ;
    dBox.isYUIDialog = true
    
    //toolTop Button
    if(!oArg.disableCloseButton)
    {
        var oBtn = this.getButtonHTML('&times');
        appendHTML( this.__toolTop , oBtn.html );
        $AE( oBtn.ids[0] , 'click', this.onButtonClick , this ); 
    }
     
    //toolBottom Buttons
    var oBtn = this.getButtonHTML(oArg.buttonText);
    appendHTML( this.__toolBottom , oBtn.html );
    
    var dFirstButton ;
    for(var i=0;i<oBtn.ids.length;i++)
    {
      var dBtn = $(oBtn.ids[i]);
      dFirstButton = dFirstButton || dBtn ;
      dBtn.buttonIndex = i;
      $AE( dBtn , 'click', this.onButtonClick , this ); 
    }
    
    
    
    
    
    this.setContext(oArg.html , true );
    this.addResizeControl();
    
    if(oArg.width || oArg.height ){
    this.resizeTo(oArg.width , oArg.height);
    }
    
   
    if(oArg.hide){
       
        this.hide()
    }else{    
        this.moveToCenter();
    }
   
    //add drag&drop
    this.setDragDrop();
    
    //set mask
    if(oArg._stopEvent && oArg._displayMask)
	{       
       this.setCapture();          
    
	}else
	{
		if(oArg.autoDismiss)
		{
			bPreventClick= true;
            setTimeout( function() { bPreventClick = false } , 100 ); 
            
            if(oArg.target)
            {
                oArg.target.isYUIDialogPreventAutoDismiss  =1;
            }
            
            if(oLastOpenedDismissDialog)
            {
                try{
                oLastOpenedDismissDialog.close();
                oLastOpenedDismissDialog = null;
                }catch(oh){}               
            }
            
            var oSelf = this; 
            oLastOpenedDismissDialog = this ;    
            
			oArg.autoDismiss = function(sEtype, n )
			{   
            
                onDocumentClick.unsubscribe(oArg.autoDismiss , oSelf );
                oArg.autoDismiss = null;
                oSelf.close();
              
                     
			}	
			onDocumentClick.subscribe( oArg.autoDismiss  , this , true );
			
		}
	}	
	
	

    this.showAtTop(); 
    $AE( dBox , 'mousedown' , this.showAtTop  ,  this , true );    
}

simpleDialog.prototype.hide = function()
{
    var dBox = this.__box;
    
     var dArrow = this.__arrow ;   
     if(  dArrow ){
     dArrow.style.left = '';
     }
    
    this._top = dBox.style.top ;
    dBox.style.top = '-5000px';
    dBox.style.visibility = 'hidden';
    this.hidden = 1 ;
}

simpleDialog.prototype.show = function()
{
    var dBox = this.__box;  
    dBox.style.top =  this._top ;
    dBox.style.visibility = 'visible';
    this.showAtTop();
    this.hidden = 0 ;
}

simpleDialog.prototype.addResizeControl= function()
{
    var oArg = this._arg ; 
    
    this.addResizeControl = function(){};//only add for once;
    
    if(!oArg.resize)
    {        
        return;
    }
    
    
    var sId = this.id + 'resize-ctrl';
    appendHTML( this.__toolBottom , ['<div class="yui-dialog-box-resize-ctrl"><span id="', sId ,'" ></span><b class="ysd-clr"></b></div>'].join('') );

    
    if(!dDialogTempFrame){
		dDialogTempFrame = $DC('div');
		dDialogTempFrame.className = 'yui-dialog-box-resize-frame';
		dDialogTempFrame.innerHTML = '<b></b>';
		dSky.appendChild(dDialogTempFrame);
	}

    var dS = dDialogTempFrame.style;
    var nShadowOffset = 0 ;
    
    var nX1,nY1,nW,nH,nEw,nEh;
    var dBox = this.__box;
    var dScroll = this.__scroll;
    
    var oSelf = this ;
    var nBorderH = this.__borderN.offsetHeight ;
    var mBorderW = this.__borderW.offsetWidth ;
    
    this.resizeTo(oArg.width , oArg.height || dScroll.offsetHeight );
    

    
    var onResizeStart = function(e , oClass )
    {
       
       
        nX1 = $D.getX( oClass.__borderW ) ;
        nY1 = $D.getY( oClass.__borderN );
        
        nW = dBox.offsetWidth + mBorderW - dScroll.offsetWidth;//The difference of content witdh and chrome witdh
        nH = dBox.offsetHeight + nBorderH - dScroll.offsetHeight;//The difference of content height and chrome height
        
        if(isIE)
        {
            this.setCapture();
        }
        else
        {
            try{
            document.addEventListener('mouseover',noEvent,true);
            document.addEventListener('mouseout',noEvent,true);
            }catch(oh){};
        }

        oSelf.showAtTop();
        dS.zIndex = zIndex+=4;
        dS.width =dBox.offsetWidth  + mBorderW + 'px';
        dS.height = dBox.offsetHeight + nBorderH  + 'px';
        dS.left =  nX1 + 'px';
        dS.top = nY1 + 'px';

        
        $AE(document,'mousemove',onResizeMove);
        $AE(document,'mouseup',onResizeEnd , oClass );
        $AE(document,'mouseover',noEvent);
        $AE(document,'mouseout',noEvent);

        $E.stopEvent(e);
        return false;
    }

    var onResizeMove = function(e)
    {
        
        nEw =  Math.max(100,e.clientX + getScrollLeft() - nX1 )  ; 
        nEh = Math.max(100,e.clientY + getScrollTop() - nY1 )    ; 
        dS.width = nEw + 'px';
        dS.height = nEh + 'px';
        
        
        $E.stopEvent(e);
        return false;
    }

    var onResizeEnd = function(e , oClass )
    {
        
        if(isIE)
        {
            this.releaseCapture();
        }
        
     
        nEw =  Math.max(100, nEw - nW  );
        nEh = Math.max(100, nEh - nH );
        oClass.resizeTo( nEw , nEh );          
        
        	
        
        dS.width = 0;
        dS.height = 0;
        dS.top = '-5000px';
        

        try{
            document.removeEventListener('mouseover',noEvent,true);
            document.removeEventListener('mouseout',noEvent,true);
        
        }catch(oh){};

        $RE(document,'mousemove',onResizeMove);
        $RE(document,'mouseup',onResizeEnd);
        $RE(document,'mouseover',noEvent);
        $RE(document,'mouseout',noEvent);

        nX1 = nY1 = null;
        dS.width = 0;
        dS.height = 0;

        $E.stopEvent(e);
        return false;

    }
	$AE(sId,'mousedown',onResizeStart , this ); 
}




simpleDialog.prototype.setDragDrop = function()
{
    var oArg = this._arg ; 

    if(oArg.dragDrop && !this.dragDrop)
    {
       
        var dragDrop = new YAHOO.util.DDProxy(this.__box.id);          
            dragDrop.addInvalidHandleType( 'BUTTON' );
            dragDrop.addInvalidHandleType( 'A' );
			dProxyFrame = $(dragDrop.dragElId);
			dProxyFrame.style.zIndex = $D.getStyle( dSky , 'zIndex' ) + 100 ;
            dProxyFrame.className = 'yui-dialog-box-proxy';
            dProxyFrame.isYUIDialogComponent = 1; 
			dProxyFrame.innerHTML = '<b></b>';
			
            if(oArg._type=='popup')
            {
               var dT = this.__toolTop ; 
               $AC( dT , 'ysd-cmd-dd');
               
               if(oArg.dragBarBgStyle)
               {
                dT.style.background = oArg.dragBarBgStyle ;
               }
               
              
               dragDrop.setHandleElId( dT.id);
            }
        
        if(isIE)
        {

            dragDrop.onMouseDown = function()
            {
                var dBox = this.getEl();
                dBox.setCapture();
            }

            dragDrop.onMouseUp = function()
            {      
                var dBox = this.getEl();
                dBox.releaseCapture();
            }

        }else
        {
            dragDrop.onMouseDown = function()
            {
                try{
                document.addEventListener('mouseover',noEvent,true);
                document.addEventListener('mouseout',noEvent,true);
                }catch(oh){};
            }

            dragDrop.onMouseUp = function()
            {      
                bPreventClick= true;
                setTimeout( function() { bPreventClick = false } , 100 ); 
                
                try{
                document.removeEventListener('mouseover',noEvent,true);
                document.removeEventListener('mouseout',noEvent,true);
                }catch(oh){};

            }
        }
        this.dragDrop = dragDrop;
    }
}

simpleDialog.prototype.onButtonClick = function(e,oSelf)
{
    var oArg = oSelf._arg ; 
    oSelf.close(e , this );    
}


var aFocalElement = [];
simpleDialog.prototype.setCapture = function()
{
     setMask(true , true ); 
     dFocalTarget =  this.__toolBottom.getElementsByTagName('button')[0] || this.__toolBottom.getElementsByTagName('a')[0] ;
     dFocalTarget.focus();
     aFocalElement.push( dFocalTarget.id ); 
	 $AC( $root , 'display-mask');	
}

simpleDialog.prototype.releaseCapture = function()
{
     var a = [];
     for(var i=aFocalElement.length-1;i>=0;i--)
     {
        var sId = aFocalElement[i];
        if( sId && ( dFocalTarget = document.getElementById( sId ) ) )
        {
         if(dEventStopper)
		 { 
		     var dBox = dFocalTarget.parentNode; 
			 while(!dBox.isYUIDialog)
			 {
				dBox = dBox.parentNode;
			 }
			 dBox.style.zIndex = zIndex += 4  ;
			 dEventStopper.style.zIndex =  zIndex -  2 ;
		 }
         break;
        }
        else
        {         	  
		  dFocalTarget = null;
          aFocalElement[i] = '';
        };
     }
     
     if(!dFocalTarget)
     {       
		setMask(false , false ); 
     }
     
     for(var i=0,j=aFocalElement.length;i<j;i++)
     {
        var sId = aFocalElement[i];
        if( sId )
        {
            a.push(sId);
        }
     }
     
     aFocalElement = a ;
     
     if(!aFocalElement.length)
     {
        $RC( $root , 'display-mask');		
		setMask(false , false ); 
     };     
}


simpleDialog.prototype.close = function(e , dButton)
{
    var oArg = this._arg ; 
    dButton = dButton || {};
    e = e || {} 
    if( typeof( oArg.onBeforeClose) == 'function' )
    {
        e.buttonIndex =  dButton.buttonIndex || -1  ;
        if( !oArg.onBeforeClose.call(this, oArg, e  , (dButton.buttonIndex==0)  ) )
        {return false}
    }
        
    this.exit();  
    
    var bConfirm = false;
    e.buttonIndex = -1 ;
    
 
    if( dButton )
    {
       bConfirm = dButton.buttonIndex == 0;
       e.buttonIndex = ( dButton.buttonIndex==null)?-1:dButton.buttonIndex  ;
    }
    oArg.callback.call( this , oArg , e , bConfirm   );
	
}

simpleDialog.prototype.exit = function()
{
    try{ this.dragDrop.unreg() }catch(oh){}; 
   
   
    
    var oArg = this._arg ; 
    var dBox = this.__box ; 

	if(oArg.autoDismiss)
	{
		onDocumentClick.unsubscribe(oArg.autoDismiss , this);
		oArg.autoDismiss =  null;
	}

    $E.purgeElement(dBox , true ); 	
	dBox.innerHTML = '';
	dBox.parentNode.removeChild( dBox  ); 
	dBox = null;
    this.releaseCapture();
    var oSelf = this;
    
    if(this._toolTipTarget)
    {
        while( this._toolTipTarget.length )
        {
            var dEl = this._toolTipTarget.shift();
            this.removeTarget(dEl);  
        }
    }
    //   
    
    //clearup
  	var oArg =  oSelf._arg ; 
	for(var i in oSelf )
	{
		//don not clear oArg since it may be used by others
		if(  oSelf[i] !=oArg  )
		{
			 oSelf[i] = null ;
		}          
	}
    oSelf.closed = true;
}


simpleDialog.prototype.applyLayout = function()
{
    var sId = this.id ;
    var oLayout = {
    
        box:$(sId + 'box'),
        context:$(sId + 'cxt'),
        scroll:$(sId + 'scroll'),
        toolTop:$(sId + 'cmd-0'),
        toolBottom:$(sId + 'cmd-1'),
        arrow:$(sId + 'arrow'),
        title:$(sId + 'title'),
        borderW:$(sId + 'border-w'),
        borderN:$(sId + 'border-n'),
        borderE:$(sId + 'border-e'),
        borderS:$(sId + 'border-s'),        
        opacBg:$(sId + 'opacBg')
    }
    
    for(var i in oLayout)
    {
        this[ '__' + i ] =oLayout[i];
    }
    oLayout = null;
}

simpleDialog.prototype.showAtTop = function(e)
{
    var z = this.__box.style.zIndex || 0;
    if( z < zIndex )
    {
      this.__box.style.zIndex = (zIndex +=4);
      
      if(dEventStopper)
      {
        dEventStopper.style.zIndex = (zIndex -2 );
      }
    }
    
    if(e && e.type)
    {
        //$E.stopEvent(e);
        //return false;
    }
   
   
   
}

simpleDialog.prototype.setTitle = function(s)
{
  this.__title.innerHTML = s;
}

simpleDialog.prototype.setContext = function(s , bRecalcSize )
{
    s = [ s ].join('') ;
   
    var oArg = this._arg ; 
    var dScroll = this.__scroll;
    var dContext =this.__context;
    var dBox =  this.__box;
    
    dContext.innerHTML = s;
    if(isIE)
    {
        //IE need this hack to fix broken height 
        var recalc = function(){
        dBox.style.zoom = 1.1 ;
        dBox.style.zoom = 1 ;
        }
        setTimeout(recalc , 0 );
    };
    
    if(bRecalcSize )
    {
        dBox.style.visibility = 'hidden';
        dBox.style.visibility = 'visible';
       
        dBox.style.width = 'auto';  
        var nW = Math.min(dScroll.offsetWidth , oArg.maxWidth ) ;
      
        nW = Math.max(nW , oArg.minWidth ) ;
       
        dBox.style.width = nW + 'px';
        dBox.style.visibility = 'visible';
    }
}

simpleDialog.prototype.moveTo = function(x,y)
{
    var dBox = this.__box;
    
    if( (this._left != x + 'px') && typeof(x)=='number'  )
    {
        this._left = dBox.style.left = x + 'px';
    }
    
    if(this._top != y + 'px' && typeof(y)=='number'  )
    {
       this._top = dBox.style.top = y + 'px';
    }
}

simpleDialog.prototype.moveToCenter = function(nMode)
{
    var dBox = this.__box;
    var aScroll =  [  getScrollLeft() , getScrollTop() ];
	
    if(nMode==1 || !nMode ){
    this.moveTo(   Math.max( 16 ,( $D.getViewportWidth() - dBox.offsetWidth )/2 + aScroll[0] ) , null );
    }

    if(nMode==2 || !nMode ){
    this.moveTo( null ,   Math.max(16 , ( $D.getViewportHeight() - dBox.offsetHeight )/2 + aScroll[1] ) ) ;
    }
}

simpleDialog.prototype.resizeTo = function(nW,nH)
{
    var oArg = this._arg ;
    var dBox = this.__box;
    var dScroll = this.__scroll;
  
    if(!this._hasScrollBar)
    {
        this._hasScrollBar = 1;
        dScroll.style.width = '100%';
        dScroll.style.overflow = 'auto';
    }
    
    if(nW && !isNaN(nW)){            
    dBox.style.width = Math.max( 100 , nW ) + 'px';
    }
    
   
    if(nH && !isNaN(nH)){
    dScroll.style.height = Math.max( 100 , nH ) + 'px';
  
    }
    
   
   
        
    
}


simpleDialog.prototype.getButtonHTML = function(aButtonText)
{
    var aHtml = [];
    var aId = [];
    
    if(!aButtonText.shift)
    {
        aButtonText = [aButtonText];
    }
    
    for(var i=0,j=aButtonText.length;i<j;i+=1)
    {			 
         if(aButtonText[i])
         {           
            aId[ i ] =  'yui-dialog-btn' + (nId+=1);
            aHtml[i] = '<button  class="yui-dialog-btn" id="'+ aId[ i ] +'"><span>'+aButtonText[i]+'</span></button>';
         }
    }
    
    return{
        ids: aId ,
        html:aHtml.join('')
    }
}



simpleDialog.prototype.setTarget = function( dTarget  , nX , nY , bInnerView)
{ 
    
     var oArg = this._arg || {}; 
     nX = nX || 0;
     nY = nY || 0;
     var sId = $D.generateId( dTarget  );
     dTarget = $(sId);
     if(!dTarget){return false};
   
     
     if(oArg.autoDismiss){
     dTarget.isYUIDialogPreventAutoDismiss  =1;
     }
  
     var dArrow = this.__arrow || {'style':{'left':0},'offsetHeight':0} ;
     var dBox = this.__box;
    
     var nH = dBox.offsetHeight ;
     var nW = dBox.offsetWidth ;
     var nSY = getScrollTop();
     var nSX = getScrollLeft();
     
   
     dArrow.style.left = '';
     
     
     dBox.style.visibility = 'hidden';
     nX += $D.getX( dTarget );
     nY += $D.getY( dTarget ) - dArrow.offsetHeight -  nH ; 
     
    var hideArrow = function()
    {
        dArrow.style.left = '-5000px'
    }     
           
     if( bInnerView )
     {
        
        if( nY < nSY + 12 )
        {
            nY = nSY + 12 ;
            
            hideArrow();
        }
        else if (  nY > ( $D.getViewportHeight() + nSY  -  nH  )  )
        {
            nY = ( $D.getViewportHeight() + nSY  -  nH - 3 );
            hideArrow();
        }
        
        if( nX < nSX + 3 )
        {
            nX = nSX + 3 ;
            hideArrow();
        }
        else if ( nX > ( $D.getViewportWidth() + nSX  -  nW   - 6 )  )
        {
            nX = ( $D.getViewportWidth() + nSX  -  nW  - 6 );
            if( $D.getX( dTarget ) > $D.getX( dBox ))
            {
                hideArrow();
            }
        }
         
     }
    
    if(!isNaN( nX) ){
    dBox.style.left = nX + 'px';
    }
    
    if(!isNaN(nY))
    {
        dBox.style.top = nY + 'px';
    }
    dBox.style.visibility = 'visible';
    
     
}	

simpleDialog.prototype.addTarget = function(dEl , oConfig )
{
   var oArg = this._arg || {};
  
   if(oArg._type!='tooltip'  )
   {
       this.addTarget = function(){};
       return;
   };
   
   if(  dEl && typeof(oConfig) == 'object'  && typeof(oConfig.onDisplay) == 'function' ) 
   {
    if(dEl._hasToolTip){return};
    if(!this._toolTipTarget)
    {
        this._toolTipTarget = [];
    }
    
    if( typeof(oConfig.onBeforeDisplay) != 'function')
    {
        oConfig.onBeforeDisplay = function(){return true}
    }
    
    this._toolTipTarget.push( dEl );
    
    
    oConfig._scope = this ;
    $D.generateId(  dEl ) ;
    $AE( dEl , 'mouseover' ,  this._toolTipMouseOver , oConfig );
    $AE( dEl , 'mouseout' ,  this._toolTipMouseOut , oConfig );
    dEl._hasToolTip = true;
    
   }
}

simpleDialog.prototype.removeTarget = function(dEl)
{
    var oArg = this._arg || {};
    var oSelf = this ; 
   
    if(oArg._type!='tooltip'  )
    {
       this.removeTarget = function(){};
       return;
    };

    if(!dEl || !dEl._hasToolTip){return};

	$RE(dEl , 'mouseover' , this._toolTipMouseOver  );
	$RE(dEl , 'mouseout' , this._toolTipMouseOut  );
    dEl._hasToolTip = null;
   
    
}

simpleDialog.prototype._toolTipMouseOver = function(e , oConfig )
{ 
    
   
    var oSelf = oConfig._scope ;
    var oArg = oSelf._arg ;
    var dTarget = this ; 
    
    if(!oArg)
    {
        //ToolTip is removed from DOM, clear up Evt handler
        $E.stopEvent(e);
        return false;
    }
    
    if( oSelf._toolTipAction )
    {
        clearTimeout(oSelf._toolTipAction );
    }
    
    if(this.isYUIDialog)
    {
        $E.stopEvent(e);
        return false;
    }
    
    
	//copy event in case that event expire later
	var dEventCopy = {};
	for(var i in e)
	{
		dEventCopy[i] = e;
	}
	
	var doit  = function()
    {
       if( oSelf._targetId == dTarget.id )
       {
        var isShow = oConfig.onBeforeDisplay.call( oSelf ,  oConfig  , dEventCopy  );
        
        if(isShow !=false)
        {
            oSelf.show();
            oConfig.onDisplay.call( oSelf ,  oConfig  , dEventCopy  );
           
        }
       }
    }
    
    if(oSelf._targetId && oSelf._targetId!= dTarget.id)
    {
        oSelf.setContext('');
        oSelf.hide();
        /*
        if( typeof( oConfig.onDismiss ) == 'function')
        {
            oConfig.onDismiss.call( oSelf ,  oConfig   );
        }
        */
    }
    
    oSelf._targetId = dTarget.id ;
    oSelf._toolTipAction  = setTimeout(doit , oArg.displayDelay);    
    
    if(typeof( oConfig.onMouseOver ) == 'function' )
    {
        oConfig.onMouseOver.call(  oSelf ,e , oConfig );
    }
    
   
    $E.stopEvent(e);
    return false;
}

simpleDialog.prototype._toolTipMouseOut = function(e , oConfig )
{
    var oSelf = oConfig._scope ;
    var oArg = oSelf._arg ;
    var dTarget = this ; 
    if(!oArg)
    {
		//ToolTip is removed from DOM, clear up Evt handler
        $E.stopEvent(e);
    }
    
    
    if( oSelf._toolTipAction )
    {
        clearTimeout(oSelf._toolTipAction );
    }
   
    var doit  = function()
    {
       if( oSelf._targetId == dTarget.id || dTarget.isYUIDialog )
       {
        oSelf.setContext('');
        oSelf.moveTo(0,-5000);
        oSelf.hide();
        if( typeof( oConfig.onDismiss ) == 'function')
        {
            oConfig.onDismiss.call( oSelf ,  oConfig   );
        }
       }
    }
    
    oSelf._toolTipAction  = setTimeout(doit ,oArg.dismissDelay );
    
    if(typeof( oConfig.onMouseOut ) == 'function' )
    {
        oConfig.onMouseOut.call(  oSelf ,e , oConfig );
    }       
    
    $E.stopEvent(e);
    return false;
}



simpleDialog.prototype.createDialogHTML = function()
{
    var sId = this.id ;
    var oArg = this._arg || {};
    var bHasIframe  = !!oArg._stopEvent; 
    if(!hasSelectBug){ bHasIframe = true } //use Iframe to hide SELECT   
    
    var opac = oArg.opacity ; 
    if( opac  && !isNaN( opac  ) && opac>0 && opac <=1 && !isIE ){
	
	opac = [
	'<style>',
	'#' , sId , 'box .cr ,',
	'#' , sId , 'cmd-1,',
	'#' , sId , 'cmd-0',	
	'{ opacity:',opac ,';}',
    '#' , sId , 'box,',
    '#' , sId , 'box .ysd-cxt,',
	'#' , sId , 'box .scroll',
    '{background:transparent}',
	'#' , sId , 'box .opac-bg',
    '{opacity:',opac,'}',
	'</style>'].join('');	
	}
    else{opac = ''}
    
   
    
    
    
    var s = [
    '<div id="',sId,'box" class="yui-simple-dialog yui-simple-dialog-',oArg._type,' ',(opac)?'yui-simple-dialog-opac':'' ,'">',
     opac ,	
    '<div class="ysd-bd" id="',sId,'bd">',
       
        '<div class="ysd-cmd-0" id="',sId,'cmd-0">',
        '<div class="ysd-title" ><nobr id="',sId,'title" ></nobr></div>',
        '</div>',
        
        /*context*/
        '<div class="ysd-scroll" id="',sId,'scroll">',
            '<div class="ysd-cxt type-', oArg._type ,'" id="',sId,'cxt">&nbsp;</div>',            
        '</div><div class="ysd-clr"></div>',
        
        '<div class="ysd-cmd-1" id="',sId,'cmd-1"><a href="#" rel="focus" tabIndex="-1" hidefocs="hidefocus"></a></div>',               
        '<b class="ysd-e cr" id="',sId,'border-e"></b>', /*Round corners*/
        '<b class="ysd-w cr" id="',sId,'border-w"></b>', /*Round corners*/
        '<div class="opac-bg" id="',sId,'opacBg"></div>',
		'<!--[if lte IE 6.5]>',
        '<iframe class="select-free" frameborder="0"></iframe>',
        '<![endif]-->',
    
    '</div>',
    
    /*More Round corners*/
    '<b class="ysd-nw cr"></b>',
    '<b class="ysd-n cr" id="',sId,'border-n"></b>',
    '<b class="ysd-ne cr"></b>',
    '<b class="ysd-se cr"></b>',
    '<b class="ysd-s cr" id="',sId,'border-s"></b>',
    '<b class="ysd-sw cr"></b>',
    '<!--[if lte IE 6.5]>',
    '<iframe frameborder="0" class="select-free" style="height:9px;top:-9px;filter:mask();"></iframe>',
    '<iframe frameborder="0" class="select-free" style="height:9px;top:auto;bottom:-9px;filter:mask();"></iframe>',
    '<![endif]-->', 
    
    (oArg._type=='balloon' || oArg._type=='tooltip' )?'<b class="arrow-s" id="'+ sId + 'arrow"></b>':'',
    
    '</div>'].join('');
    return s;
}

var dummy = function(){};
    
this.alert = function()
{
    var oArg = getArguments( arguments );
    oArg.resize = 0;  
    oArg.buttonText = [ oArg.buttonText[0] || 'ok' ];
    oArg._stopEvent = 1 ;
    oArg._displayMask = 1 ;
    oArg._type = 'alert';   
    var oDialog = new simpleDialog(oArg);
    return oDialog;       
};

this.notify = function()
{
    var oArg = getArguments( arguments );
    oArg.resize = 0;  
    oArg._stopEvent = 0 ;
    oArg._displayMask = 0 ;
    oArg.buttonText = [ oArg.buttonText[0] || 'ok' ];
    oArg._type = 'notify';   
    var oDialog = new simpleDialog(oArg);
    
    oDialog.setCapture = dummy ;
    oDialog.releaseCapture = dummy ;
    return oDialog;       
};

this.confirm = function()
{
    var oArg = getArguments( arguments ); 
    oArg.resize = 0;    
    oArg.buttonText = [ ( oArg.buttonText[0] )  || 'yes' , ( oArg.buttonText[1] ) || 'no' ];
    oArg._type = 'confirm';  
    oArg._stopEvent = 1 ;
    oArg._displayMask = 1 ;    
    var oDialog = new simpleDialog(oArg);
    return oDialog;       
};

this.balloon = function()
{
    var oArg = getArguments( arguments ); 
    oArg.resize = 0;    
    oArg.dragDrop = 0;
    oArg.buttonText = [];
    oArg._type = 'balloon';  
    oArg._stopEvent = 0 ;
    oArg._displayMask = 0 ;    
    var oDialog = new simpleDialog(oArg);
    oDialog.setTarget( oArg.target );
    
    oDialog.setCapture = dummy ;
    oDialog.releaseCapture = dummy ;
    
    return oDialog;       
};

this.popup = function()
{
    var oArg = getArguments( arguments ); 
    oArg.dragDrop = oArg.dragDrop ==null ?1:oArg.dragDrop;
    oArg.resize = oArg.resize ==null ?1:oArg.resize;
    oArg._type = 'popup';
    
    oArg._stopEvent = 0 ;
    oArg._displayMask = 0 ;    
    var oDialog = new simpleDialog(oArg);
    
    oDialog.setCapture = dummy ;
    oDialog.releaseCapture = dummy ;
    return oDialog;       
};

this.modal = function()
{
    var oArg = getArguments( arguments ); 
    oArg.dragDrop = oArg.dragDrop ==null ?1:oArg.dragDrop;
    oArg.resize = oArg.resize ==null ?1:oArg.resize;
    //oArg.dragDrop = 1;
	//oArg.resize = 1; 
    oArg._type = 'modal';
    oArg._stopEvent = 1 ;
    oArg._displayMask = 1 ;    
    var oDialog = new simpleDialog(oArg);
    return oDialog;       
};

this.process = function()
{
    var oArg = getArguments( arguments ); 
    oArg.dragDrop = 1;
    
    if(oArg.displayMask)
    {
        oArg._stopEvent = 1 ;
        oArg._displayMask = 1 ;
    }
    
   
    
    oArg._type = 'process';
    oArg.buttonText = 0;
    oArg.resize = 0;
    //oArg.disableCloseButton = 1; 
    var oDialog = new simpleDialog(oArg);
    if(!oArg.displayMask)
    {
        oDialog.setCapture = dummy ;
        oDialog.releaseCapture = dummy ;
    }

    return oDialog;       
};


this.tooltip = function()
{
    var oArg = getArguments( arguments ); 
    oArg.dragDrop = 0 ;
    oArg.html = '&nbsp;' ;
    oArg.resize = 0;
    oArg.buttonText = 0;
    oArg._type = 'tooltip'; 
    oArg.displayMask = 0;
	
    //oArg.disableCloseButton = 1; 
    oArg.hide = 1;
    
    var oDialog = new simpleDialog(oArg);   
    $AE( oDialog.__box , 'mouseover' , oDialog._toolTipMouseOver  , { _scope: oDialog }  );
    $AE( oDialog.__box , 'mouseout' , oDialog._toolTipMouseOut  , { _scope: oDialog } );
    return oDialog;       

}
	
function addSkyCloud(){
 
    if(!$d.body || !$d.body.firstChild)
    {
        setTimeout(addSkyCloud,0);
        return;
    }
    
    if(!dSky)
    {
        appendHTML( $d.body, '<div id="layout-sky"></div>',true);
        dSky = $('layout-sky');
    }

    if(!dCloud)
    {
        appendHTML( $d.body, '<div id="layout-cloud"></div>',true);
        dCloud = $('layout-cloud');
    }
    
     //create basi masks
    if(!dEventStopper)
    {
        var dummy = function(e)
        {
            $E.stopEvent(e);
            return false;
        }
        
        
        dEventStopper  = 'mask' + (nId +=1);
        appendHTML( dSky ,  '<div id="'+ dEventStopper  +'" class="passive"  ></div>' ) ;
        dEventStopper = $( dEventStopper   );
        var aE = ('mousedown,dragstart,dragend,selectstart,mouseup,mousemove,mouseout,mouseover,click,contextmenu,keydown,keyup').split(',');
        
        while(aE.length)
        {
            $AE( dEventStopper , aE.shift() , dummy );
        }
    }
    
    if(!dLightMask)
    {
        dLightMask  = 'mask' + (nId +=1);
        appendHTML( dCloud ,  '<div id="'+ dLightMask  +'" class="mask"></div>' ) ;
        dLightMask= $( dLightMask   );
    }
    
}
addSkyCloud();

    
};











