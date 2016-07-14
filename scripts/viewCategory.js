function addRowHandlers() 
{
	var rows;
	rows= document.getElementById("showResults").rows;
	for (var i = 0; i < rows.length; i++) 
	{
		rows[i].style.cursor = "pointer";
        rows[i].onmousemove = function () { this.style.backgroundColor = "#ffad60"; this.style.color = "#FFFFFF"; };
        rows[i].onmouseout = function () { this.style.backgroundColor = ""; this.style.color = ""; };
	}
	for (i = 0; i < rows.length; i++) 
	{
		rows[i].onclick = function(){ return function(){
		var id = this.cells[1].innerHTML;
		window.location='viewVenue.php?id='+id;
		};
		}(rows[i]);
	}
}
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
function sortOn () {
    var t;
	for(var i=0;i<oData.response.venues.length;i++)
	{
		for(var j=i+1;j<oData.response.venues.length;j++)
		{
			if(oData.response.venues[j].name.localeCompare(oData.response.venues[i].name)==-1)
			{
				t=oData.response.venues[j];
				oData.response.venues[j]=oData.response.venues[i];
				oData.response.venues[i]=t;
			}
		}
	}
}
	var Cid=getParameterByName("categoryId");
	var name=getParameterByName("name");	
	var client_id='10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1';
	var client_secret='T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q';
	var totalResults,startindex=0,count,oData;
	function start()
	{		
		if($('#searchInCategory input').val()!='')
			searchInCategory();
		else
		{
			var surl='https://api.foursquare.com/v2/venues/search?intent=browse&v=20140806&near=chennai&categoryId='+Cid+'&limit=50&client_id=10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1&client_secret=T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q';
			$.ajax(surl,{
			complete:function(p_oXHR,p_sStatus){
					oData=$.parseJSON(p_oXHR.responseText);
					sortOn();
					$('#searchInCategory input').attr("placeholder","Search in "+name);
					$('body').append('<ul id="movePage" class="pager"><li><a href="#" onClick="PageAdd();return false;">Next</a></li></ul>');
					showResult();
					}
					});
		}
	}
	function searchInCategory()
	{
		var surl='https://api.foursquare.com/v2/venues/search?near=chennai&categoryId='+Cid+'&query='+$('#searchInCategory input').val()+'&v=20140806&client_id='+client_id+'&client_secret='+client_secret;
		$.ajax(surl,{
				complete:function(xHTTP,status){
						oData=$.parseJSON(xHTTP.responseText);
						console.log(oData);
						startindex=0;
						$('#showResults tbody').empty();
						$('body ul').remove();
						$('body').append('<ul id="movePage" class="pager"><li><a href="#" onClick="PageAdd();return false;">Next</a></li></ul>');
					showResult();
						}
					});
	}
	function PageAdd()
	{
		startindex+=10;
		$('#showResults tbody').empty();
		showResult();
	}
	function PageBack()
	{
		startindex-=10;
		$('#showResults tbody').empty();
		showResult();
	}
	function showResult()
	{
		totalResults=oData.response.venues.length;
		count=totalResults-startindex-1;
		if($('#showResults tbody').count==10)
			addRowHandlers();
		if(startindex<50)
		{
		for(var i=startindex;i<startindex+10;i++)
		{
			id=oData.response.venues[i].id;
			name=oData.response.venues[i].name;
			var url='https://api.foursquare.com/v2/venues/'+id+'/photos?v=20140806&limit=100&client_id=10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1&client_secret=T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q';
			ajaxCall(id,name,url);
		}
		if(startindex>0)
			{
				$('body ul').remove();
				$('body').append("<ul id='movePage' class='pager'><li><a href='#' onClick='PageBack();return false;'>Previous</a></li><li><a href='#'onClick='PageAdd();return false;'>Next</a></li></ul>");
			}
		}
		else
			{
				$('body ul').remove();
				$('body').append("<ul id='movePage' class='pager'><li><a href='#' onClick='PageBack();return false;'>Previous</a></li></ul>");
			}	
	}
				
	function ajaxCall(id,name,url)
	{
		console.log('count');
		$.ajax(url,{
							complete:function(xHTTP,status){
							var imageData=$.parseJSON(xHTTP.responseText);
							
							if(imageData.response.photos.count>0)
								img=imageData.response.photos.items[0].prefix+'width100'+imageData.response.photos.items[0].suffix;
							else
								img='Images/Not available.png';
							$('#showResults > tbody').append('<tr><td><img src="'+img+'"></td><td>'+id+'</td><td>'+name+'</td></tr>');
							addRowHandlers();
						}
						});
	}