
function myFunction(event, selectedSection){
    console.log('Inside func -> myFunction')
    console.log(event)
    console.log(selectedSection)
    // document.getElementById("add-subdivision-section").innerHTML = "Amlan Alok";

    sectionContentList = document.getElementsByClassName("section-content");
    console.log(sectionContentList)

    for (i=0; i<sectionContentList.length; i++){
        sectionContentList[i].style.display = "none";
    }

    adminOptionList = document.getElementsByClassName("sidebar-option");
    console.log(adminOptionList)

    for (i=0; i<adminOptionList.length; i++){
        adminOptionList[i].className = adminOptionList[i].className.replace(" active", "");
    }

    document.getElementById(selectedSection).style.display = "block";

    console.log(event.currentTarget)
    event.currentTarget.className += " active";
}

function viewMaintenanceDetails(event, elementId){

    maintenanceRequestDetailsList = document.getElementsByClassName("maintenance-request-details");
    console.log(maintenanceRequestDetailsList)

    for (i=0; i<maintenanceRequestDetailsList.length; i++){
        maintenanceRequestDetailsList[i].style.display = "none";
    }

    maintenanceRequestList = document.getElementsByClassName("maintenance-request");
    console.log(maintenanceRequestList)

    for (i=0; i<maintenanceRequestList.length; i++){
        maintenanceRequestList[i].className = maintenanceRequestList[i].className.replace(" active", "");
    }

    document.getElementById(elementId).style.display = "block";

    console.log(event.currentTarget)
    event.currentTarget.className += " active";
}

function viewComplaintDetails(event, elementId){

    complaintDetailsList = document.getElementsByClassName("complaint-details");
    console.log(complaintDetailsList)

    for (i=0; i<complaintDetailsList.length; i++){
        complaintDetailsList[i].style.display = "none";
    }

    complaintList = document.getElementsByClassName("complaint");
    console.log(complaintList)

    for (i=0; i<complaintList.length; i++){
        complaintList[i].className = complaintList[i].className.replace(" active", "");
    }

    document.getElementById(elementId).style.display = "block";

    console.log(event.currentTarget)
    event.currentTarget.className += " active";
}

function menuFunction(event){

    var menuIcon = document.getElementById("sidebar");
    console.log(menuIcon)

    if(menuIcon.style.display === "block"){
        menuIcon.style.display = "none";
    }   
    else{
        menuIcon.style.display = "block";
    }
}

function openMenu(event, menuType){
    console.log('Inside func -> Open Menu Function')

    console.log(menuType);
    var apartmentChatMenu = document.getElementById(menuType);
    console.log(apartmentChatMenu)

    if(apartmentChatMenu.style.display === "block"){
        apartmentChatMenu.style.display = "none";
    }   
    else{
        apartmentChatMenu.style.display = "block";
    }
}

function inputBuildingManagerChat(event){

    inputMessage = document.getElementById("building-manager-send").value
    console.log(inputMessage)
}

function inputSubdivisionManagerChat(event){

    inputMessage = document.getElementById("subdivision-manager-send").value
    console.log(inputMessage)
}