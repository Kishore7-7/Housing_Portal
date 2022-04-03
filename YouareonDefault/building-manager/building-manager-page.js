
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

function inputApartmentOwnerChat(event){

    inputMessage = document.getElementById("apartment-owner-send").value
    console.log(inputMessage)
}

function inputSubdivisionManagerChat(event){

    inputMessage = document.getElementById("subdivision-manager-send").value
    console.log(inputMessage)
}

function viewApartmentOwnerChatMenu(event, elementId){
  console.log('hits');
    console.log(elementId);
    displayChatNameList = document.getElementsByClassName("display-chat-name");
    console.log(displayChatNameList)

    for (i=0; i<displayChatNameList.length; i++){
        displayChatNameList[i].style.display = "none";
    }

    apartmentOwnerChatTileList = document.getElementsByClassName("apartment-owner-chat-tile");
    console.log(apartmentOwnerChatTileList)

    for (i=0; i<apartmentOwnerChatTileList.length; i++){
        apartmentOwnerChatTileList[i].className = apartmentOwnerChatTileList[i].className.replace(" active", "");
    }

    document.getElementById(elementId).style.display = "block";

    console.log(event.currentTarget)
    event.currentTarget.className += " active";
}

function viewApartmentDetails(event, elementId, user){
    console.log(JSON.parse(user));
    user = JSON.parse(user);
    apartmentOwnerDetailsList = document.getElementsByClassName("apartment-owner-detail");
    console.log(apartmentOwnerDetailsList);
    document.getElementById('aptNum').innerText = user.apartment_number;
    document.getElementById('firstName').innerText = user.first_name;
    document.getElementById('lastName').innerText = user.last_name;
    document.getElementById('emailId').innerText = user.email_id;
    document.getElementById('phoneNum').innerText = user.phone_number;
    document.getElementById('joinDate').innerText = user.joining_datetime;

    for (i=0; i<apartmentOwnerDetailsList.length; i++){
        apartmentOwnerDetailsList[i].style.display = "none";
    }

    apartmentList = document.getElementsByClassName("apartment-owner-detail-tile");
    console.log(apartmentList)

    for (i=0; i<apartmentList.length; i++){
        apartmentList[i].className = apartmentList[i].className.replace(" active", "");
    }

    document.getElementById(elementId).style.display = "block";

    console.log(event.currentTarget)
    event.currentTarget.className += " active";
}

function viewApartmentOwnerTable(event, elementId){
    console.log(event);
    console.log(elementId);
    var owner = document.getElementById('apartment-owner-detail');
    owner.display = 'block';
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