var client_id='10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1';
	var client_secret='T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q';
		function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
	function start(){
	var id=getParameterByName('id');
	var url='https://api.foursquare.com/v2/venues/'+id+'?v=20140806&client_id='+client_id+'&client_secret='+client_secret;
	$.ajax(url,{
				complete:function(xHTTP,status){
						oData=$.parseJSON(xHTTP.responseText);
						console.log(oData);
						var flag=0;
						$('#name').text(oData.response.venue.name);
						if(oData.response.venue.photos.count==0)
							$('#pics').append('<img src="Images/Not available.png">');
						else
						for(var i=0;i<oData.response.venue.photos.groups[0].items.length;i++)
						{
							flag=1;
							var img=oData.response.venue.photos.groups[0].items[i].prefix+'width500'+oData.response.venue.photos.groups[0].items[i].suffix;
							$('#pics').append('<img src="'+img+'">');
						}
						$('#category').text(oData.response.venue.categories[0].name);
						$('#categoryIcon').html('<img src="'+oData.response.venue.categories[0].icon.prefix+'bg_44'+oData.response.venue.categories[0].icon.suffix+'">');
						L.mapbox.accessToken = 'pk.eyJ1IjoibmFuZGhpbmlkZXZpIiwiYSI6ImNpcWJ1bGQ1dTAwd21mbG0xZmg4bmZ2M3YifQ.RbOoXPJutCitMrH-tp6H7Q';
						var map = L.mapbox.map('map', 'mapbox.streets')
						.setView([13.0827, 80.2707], 12);
						var lat=oData.response.venue.location.lat;
						var lng=oData.response.venue.location.lng;
						var marker = L.marker([lat, lng]).addTo(map);
					}
				});
	}