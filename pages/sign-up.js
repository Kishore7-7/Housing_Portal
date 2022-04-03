
function getRoleDropdownValue(event){

	buildingDropdown = document.getElementById("building-dropdown");
	buildingDropdown.style.display = "none"

	apartmentDropdown = document.getElementById("apartment-dropdown");
	apartmentDropdown.style.display = "none"

}

function getSubdivisionDropdownValue(event){

	buildingDropdown = document.getElementById("building-dropdown");
	buildingDropdown.style.display = "none"

	apartmentDropdown = document.getElementById("apartment-dropdown");
	apartmentDropdown.style.display = "none"

	subdivision = document.getElementById("subdivision").value
	console.log(subdivision)

	role = document.getElementById("role").value
	console.log(role)

	if (role == 'building manager' || role == 'apartment owner'){
		buildingDropdownOptions = document.getElementsByClassName("building-dropdown-option");
		console.log(buildingDropdownOptions)

		for (i=0; i<buildingDropdownOptions.length; i++){
			// buildingDropdownOptions[i].disabled = true
			buildingDropdownOptions[i].hidden = true
		}

		buildingDropdown = document.getElementById("building-dropdown");
		console.log(buildingDropdown)
		console.log(buildingDropdown.style.display)

		buildingDropdown.style.display = "block"

		
		console.log("building-subdivision-"+subdivision)
		correctBuildingDropdown = document.getElementsByClassName("building-subdivision-"+subdivision);
		console.log(correctBuildingDropdown)

		for (i=0; i<correctBuildingDropdown.length; i++){
			// buildingDropdown[i].disabled = false
			correctBuildingDropdown[i].hidden = false
		}
	} 

	

}

function getBuildingDropdownValue(event){
	building = document.getElementById("building").value
	console.log(building)

	role = document.getElementById("role").value
	console.log(role)

	if (role == 'apartment owner'){
		apartmentDropdownOptions = document.getElementsByClassName("apartment-dropdown-option");
		console.log(apartmentDropdownOptions)

		for (i=0; i<apartmentDropdownOptions.length; i++){
			// buildingDropdownOptions[i].disabled = true
			apartmentDropdownOptions[i].hidden = true
		}

		apartmentDropdown = document.getElementById("apartment-dropdown");
		console.log(apartmentDropdown)
		console.log(apartmentDropdown.style.display)

		apartmentDropdown.style.display = "block"

		console.log("apartment-building-"+building)
		correctApartmentDropdown = document.getElementsByClassName("apartment-building-"+building);
		console.log('---------')
		console.log(correctApartmentDropdown)

		for (i=0; i<correctApartmentDropdown.length; i++){
			// buildingDropdown[i].disabled = false
			correctApartmentDropdown[i].hidden = false
		}
	}

	
}











