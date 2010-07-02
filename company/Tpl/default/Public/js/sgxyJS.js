function setHomePageInFF()
{
    if (document.all)
    {
        document.body.style.behavior='url(#default#homepage)';
        document.body.setHomePage('http://www.sgxy.com/');
    } else if (window.sidebar) {
        if(window.netscape)
        {
            try
            {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            }
            catch (e)
            {
                alert("Firefox暂无此功能，请手动设置。" );
            }
        }
    var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);
    prefs.setCharPref('browser.startup.homepage','http://www.sgxy.com/');
    }
}

function addFavor(title, url){ 
if (document.all) 
	window.external.AddFavorite(url, title); 
else if (window.sidebar) 
	window.sidebar.addPanel(title, url, "") 
}

// JavaScript Document
if (document.getElementById){ 
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}
function SwitchMenu(obj,sty)
{
	if(document.getElementById)
	{
	var el = document.getElementById(obj);
	var ml = document.getElementById(sty);
	var ar = document.getElementById("masterdiv").getElementsByTagName("ul"); 
	var mr = document.getElementById("masterdiv").getElementsByTagName("h5"); 
		if(el.style.display != "block")
		{ 
			for (var i=0; i<ar.length; i++)
			{
				if (ar[i].className == "submenu")
				ar[i].style.display = "none";
//				if (mr[i].className == "menu1")
//				mr[i].className = "menu";
			}
			el.style.display = "block";
//			ml.className ="menu1";
		}
		else
		{
			el.style.display = "none";
//			ml.className ="menu";
		}
	}
}