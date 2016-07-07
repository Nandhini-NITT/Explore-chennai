
	function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
	
function showResults()
{
	
	var lat=getParameterByName('lat');
	var lng=getParameterByName('lng');
	var latlng=lat+','+lng;
	var client_id='10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1';
	var client_secret='T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q';
	url='https://api.foursquare.com/v2/venues/explore?ll='+latlng+'&viewPhotos=1&v=20140806&limit=50&offset=30&client_id='+client_id+'&client_secret='+client_secret;
	$.ajax(url,{
			complete:function(xHTTP,status){
			var oData=$.parseJSON(xHTTP.responseText);
			console.log(oData);
			alert(oData.response.groups[0].items.length);
			for(var i=0;i<oData.response.groups[0].items.length;i++)
			{
			var tip='tips';
			if(tip in oData.response.groups[0].items[i])
			var img=oData.response.groups[0].items[i].tips[0].photourl;
			if(img==undefined)
				img='Images/Not available.png';
			$('#showResults tbody').append('<tr><td><img src="'+img+'" width=100></td><td>'+oData.response.groups[0].items[i].venue.name+'</td><td>'+oData.response.groups[0].items[i].venue.categories[0].name+'</td></tr>');
			}
			}
			});
}