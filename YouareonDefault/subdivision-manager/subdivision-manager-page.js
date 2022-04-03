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

function inputBuildingManagerChat(event){

    inputMessage = document.getElementById("building-manager-send").value
    console.log(inputMessage)
}

function viewApartmentOwnerChatMenu(event, elementId){

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

function viewBuildingManagerChatMenu(event, elementId){

    displayChatNameList = document.getElementsByClassName("display-chat-name");
    console.log(displayChatNameList)

    for (i=0; i<displayChatNameList.length; i++){
        displayChatNameList[i].style.display = "none";
    }

    apartmentOwnerChatTileList = document.getElementsByClassName("building-manager-chat-tile");
    console.log(apartmentOwnerChatTileList)

    for (i=0; i<apartmentOwnerChatTileList.length; i++){
        apartmentOwnerChatTileList[i].className = apartmentOwnerChatTileList[i].className.replace(" active", "");
    }

    document.getElementById(elementId).style.display = "block";

    console.log(event.currentTarget)
    event.currentTarget.className += " active";
}

function viewItDetails(event, elementId){

    itRequestDetailsList = document.getElementsByClassName("it-request-details");
    console.log(itRequestDetailsList)

    for (i=0; i<itRequestDetailsList.length; i++){
        itRequestDetailsList[i].style.display = "none";
    }

    itRequestList = document.getElementsByClassName("it-request");
    console.log(itRequestList)

    for (i=0; i<itRequestList.length; i++){
        itRequestList[i].className = itRequestList[i].className.replace(" active", "");
    }

    document.getElementById(elementId).style.display = "block";

    console.log(event.currentTarget)
    event.currentTarget.className += " active";
}

function viewApartmentDetails(event, elementId){

    apartmentOwnerDetailsList = document.getElementsByClassName("apartment-owner-detail");
    console.log(apartmentOwnerDetailsList)

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