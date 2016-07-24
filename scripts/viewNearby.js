var no_of_pages,page=0,circle,map,marker;
	function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
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
		var id = this.cells[3].innerHTML;
		window.location='viewVenue.php?id='+id;
		};
		}(rows[i]);
	}
}
function changeRadius()
{
	
	map.removeLayer(circle);
	var radius=document.getElementById("radius").value;
	$('#getradius').remove();
	showResults(radius);
}
function showResults(radius)
{
	var offset;
	var lat=getParameterByName('lat');
	var lng=getParameterByName('lng');
	var latlng=lat+','+lng;
	L.mapbox.accessToken = 'pk.eyJ1IjoibmFuZGhpbmlkZXZpIiwiYSI6ImNpcWJ1bGQ1dTAwd21mbG0xZmg4bmZ2M3YifQ.RbOoXPJutCitMrH-tp6H7Q';
	var client_id='10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1';
	var client_secret='T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q';
	$('#showResults tbody').empty();
	$('#page-results ul').empty();
	$('#page-results').append('<span id="getradius">Radius of search <input type="number" id="radius" placeholder="Radius of search"><button onClick="changeRadius()">Submit</button></span>');
	if(page==0)
		offset=0;
	else if(page<no_of_pages)
		offset=page*10;
	if (typeof radius === 'undefined')
	{
		L.mapbox.accessToken = 'pk.eyJ1IjoibmFuZGhpbmlkZXZpIiwiYSI6ImNpcWJ1bGQ1dTAwd21mbG0xZmg4bmZ2M3YifQ.RbOoXPJutCitMrH-tp6H7Q';
		map = L.mapbox.map('map', 'mapbox.streets')
		.setView([13.0827, 80.2707], 12);
		marker = L.marker([lat, lng]).addTo(map);
		url='https://api.foursquare.com/v2/venues/explore?ll='+latlng+'&viewPhotos=1&v=20140806&limit=10&offset='+offset+'&client_id='+client_id+'&client_secret='+client_secret;
	}
	else
		url='https://api.foursquare.com/v2/venues/explore?ll='+latlng+'&viewPhotos=1&v=20140806&limit=10&offset='+offset+'&radius='+radius+'&client_id='+client_id+'&client_secret='+client_secret;
	$.ajax(url,{
			complete:function(xHTTP,status){
			oData=$.parseJSON(xHTTP.responseText);
			document.getElementById('radius').value=oData.response.suggestedRadius;
			if (typeof radius === 'undefined') { radius = oData.response.suggestedRadius; }
			
			circle = L.circle([lat,lng], radius, {
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0.5
			});
			map.addLayer(circle);
			console.log(oData);
			no_of_pages=Math.floor(oData.response.totalResults/10)+1;
			if(page<=no_of_pages)
			{
				for(var i=0;i<oData.response.groups[0].items.length;i++)
				{
					var tip='tips';
					if(tip in oData.response.groups[0].items[i])
						var img=oData.response.groups[0].items[i].tips[0].photourl;
					if(img==undefined)
						img='Images/Not available.png';
					$('#showResults tbody').append('<tr><td><img src="'+img+'" width=100></td><td>'+oData.response.groups[0].items[i].venue.name+'</td><td>'+oData.response.groups[0].items[i].venue.categories[0].name+'</td><td style="display:none">'+oData.response.groups[0].items[i].venue.id+'</td></tr>');
				}
				addRowHandlers();
				if(page>0 && page<no_of_pages-1)
					$('#page-results').append("<ul id='movePage' class='pager'><li><a href='#' onClick='PageBack();return false;'>Previous</a></li><li><a href='#'onClick='PageAdd();return false;'>Next</a></li><li>Page number "+(page+1)+"/"+no_of_pages+"</li></ul>");
				else if(page==0)
					$('#page-results').append('<ul id="movePage" class="pager"><li><a href="#" onClick="PageAdd();return false;">Next</a></li><li>Page number '+(page+1)+'/'+no_of_pages+'</li></ul>');
				else
					$('#page-results').append("<ul id='movePage' class='pager'><li><a href='#' onClick='PageBack();return false;'>Previous</a></li><li>Page number "+(page+1)+"/"+no_of_pages+"</li>");
			}
		}
			});
}
function PageBack()
{
	page-=1;
	showResults();
}
function PageAdd()
{
	page+=1;
	showResults();
}