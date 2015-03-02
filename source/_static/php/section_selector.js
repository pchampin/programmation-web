function displaySelectedSection(){
	
	var URLHash = window.location.hash;
	
	if(URLHash.length > 0) {
		var selectedSectionId = URLHash.substr(1, URLHash.length);
		
		var sections = document.querySelectorAll("body > section");
		var found = false;
		for (var i = 0; i < sections.length; i++) {
			
			var currentId = sections[i].id;
			
			var type = 'none';
			if (currentId == selectedSectionId) {
				type = 'block';
				found = true;
			}
			
			sections[i].style.display = type;
			
		}
		
		if(!found){
			displayAllSections();
		}
	} else {
		displayAllSections();
	}
}

function displayAllSections(){
	var sections = document.querySelectorAll("body > section");
	for (var i = 0; i < sections.length; i++) {
		sections[i].style.display = 'block';
	}
}