		//set up markers 
		var myMarkers = {"markers": [
				{"latitude": "51.228199", "longitude":"6.791245", "icon": "typo3conf/ext/wmdb_base_ewh/Resources/Public/img/map-marker2.png"}
			]
		};
		
		//set up map options
		$("#map").mapmarker({
			zoom	: 14,
			center	: 'Am Wehrhahn 41 40211 Düsseldorf',
			markers	: myMarkers
		});

