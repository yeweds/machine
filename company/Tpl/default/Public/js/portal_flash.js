
    imgUrl1="images/1.jpg";
    imgtext1="11"
    imgLink1=escape("http://www.sgxy.com/");
    //imgLink1="";
    
    imgUrl2="images/2.jpg";
    imgtext2="22"
    imgLink2=escape("http://www.sgxy.com/");
    //imgLink2="";
    
  
    imgUrl3="images/3.jpg";
    imgtext3="33"
    imgLink3=escape("http://www.sgxy.com/");
    //imgLink3="";
	
	imgUrl4="images/4.jpg";
    imgtext4="44"
    imgLink4=escape("http://www.sgxy.com/");
    //imgLink4="";

    
     var focus_width=777
     var focus_height=290
     var text_height=0
     var swf_height = focus_height+text_height
     
     var pics=imgUrl1+"|"+imgUrl2+"|"+imgUrl3+"|"+imgUrl4
     var links=imgLink1+"|"+imgLink2+"|"+imgLink3+"|"+imgLink4
     var texts=imgtext1+"|"+imgtext2+"|"+imgtext3+"|"+imgtext4
     var flashCode = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/hotdeploy/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">';
     flashCode = flashCode + '<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="images/focus2.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">';
     flashCode = flashCode + '<param name="menu" value="false"><param name=wmode value="opaque">';
     flashCode = flashCode + '<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">';
     flashCode = flashCode + '<embed src="images/focus2.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'+ focus_width +'" height="'+ swf_height +'" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'"></embed>';
     flashCode = flashCode + '</object>';
     document.write(flashCode)