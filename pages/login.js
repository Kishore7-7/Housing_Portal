function inputCredentials(event) {

    email = document.getElementById("email").value
    console.log(email)

    password = document.getElementById("password").value
    console.log(password)

    if (email == "apartment-owner@gmail.com" || email == "ao@gmail.com") {
        location.replace('../YouareonDefault/apartment-owner/apartment-owner-page.html')
    }
    else if (email == "building-manager@gmail.com" || email == "bm@gmail.com") {
        location.replace('../YouareonDefault/building-manager/building-manager-page.html')
    }
    else if (email == "subdivision-manager@gmail.com" || email == "sm@gmail.com") {
        location.replace('../YouareonDefault/subdivision-manager/subdivision-manager-page.html')
    }
    else if (email == "admin@gmail.com") {
        location.replace('../YouareonDefault/admin/admin.html')
    }

}