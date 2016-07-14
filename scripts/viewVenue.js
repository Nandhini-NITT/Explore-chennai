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
							if(i==0)
								{
								$('.carousel-inner').append('<div class="item active"><img src="'+img+'"><div class="absolute-div"><div class="carousel-caption"><h3 style="color:white">From foursquare users</h3></div></div></div>');
								$('.carousel-indicators').append('<li data-target="#myCarousel" data-slide-to="'+i+'" class="active"></li>');
								}
							else
								{
								$('.carousel-inner').append('<div class="item"><img src="'+img+'"><div class="absolute-div"><div class="carousel-caption"><h3 style="color:white">From foursquare users</h3></div></div></div>');
								$('.carousel-indicators').append('<li data-target="#myCarousel" data-slide-to="'+i+'"></li>');
								}
						}
						$('#category').text(oData.response.venue.categories[0].name);
						$('#categoryIcon').html('<img src="'+oData.response.venue.categories[0].icon.prefix+'bg_44'+oData.response.venue.categories[0].icon.suffix+'">');
						L.mapbox.accessToken = 'pk.eyJ1IjoibmFuZGhpbmlkZXZpIiwiYSI6ImNpcWJ1bGQ1dTAwd21mbG0xZmg4bmZ2M3YifQ.RbOoXPJutCitMrH-tp6H7Q';
						var lat=oData.response.venue.location.lat;
						var lng=oData.response.venue.location.lng;
						var map = L.mapbox.map('map', 'mapbox.streets')
						.setView([lat,lng], 14);
						var murl='https://api.mapbox.com/geocoding/v5/mapbox.places/'+lng+','+lat+'.json?access_token=pk.eyJ1IjoibmFuZGhpbmlkZXZpIiwiYSI6ImNpcWJ1bGQ1dTAwd21mbG0xZmg4bmZ2M3YifQ.RbOoXPJutCitMrH-tp6H7Q';
						$.ajax(murl,{
							complete:function(xHTTP,status){
									odata=$.parseJSON(xHTTP.responseText);
									console.log(odata);
									var marker = L.marker([lat, lng]).addTo(map).on('click',function(){
									var popup = L.popup()
									.setLatLng([lat,lng])
									.setContent('<p>'+odata.features[0].place_name+'</p>')
									.openOn(map)
									});
					
									}
									});
					}
				});
	}