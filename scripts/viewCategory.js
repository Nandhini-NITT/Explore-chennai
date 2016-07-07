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
		var url=window.location.search.substring(1);;
	var client_id='10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1';
	var client_secret='T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q';
	function start()
	{	
		var img,id,name;
		var surl='https://api.foursquare.com/v2/venues/search?v=20140806&near=chennai&'+url+'&limit=50&client_id=10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1&client_secret=T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q';
		$.ajax(surl,{
			complete:function(p_oXHR,p_sStatus){
					oData=$.parseJSON(p_oXHR.responseText);
					sortOn();
					for(var i=0;i<oData.response.venues.length;i++)
					{
						id=oData.response.venues[i].id;
						name=oData.response.venues[i].name;
						var url='https://api.foursquare.com/v2/venues/'+id+'/photos?v=20140806&client_id=10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1&client_secret=T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q';
						ajaxCall(id,name,url);
						
					}
					}
					});
	}
	function ajaxCall(id,name,url)
	{
		$.ajax(url,{
							complete:function(xHTTP,status){
							var imageData=$.parseJSON(xHTTP.responseText);
							img=imageData.response.photos.items[0].prefix+'width100'+imageData.response.photos.items[0].suffix;
							$('#showResults tbody').append('<tr><td><img src="'+img+'"></td><td>'+id+'</td><td>'+name+'</td></tr>');
						}
						});
	}
	