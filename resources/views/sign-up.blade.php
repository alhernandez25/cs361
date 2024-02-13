<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="background-color: #F7F7F7">
<!-- As a link -->
<nav class="navbar" style="background-color: #2EBD67">
    <div class="container-fluid ms-3">
        <a class="navbar-brand" style="color: white; font-weight: 600" href="/">foodi</a>
    </div>
</nav>

<div class="m-auto text-center my-5" style="max-width: 800px">
    <h1>Create Account</h1>
    <form method="post" action="/users" class="g-3">
        @csrf
        <input type="text" name="username" class="form-control m-3" placeholder="Enter Username">
        <input type="text" name="email" class="form-control m-3" placeholder="Enter Email">
        <input type="password" name="password" class="form-control m-3" id="inputPassword2" placeholder="Enter Password">
        <div id="passwordHelpBlock" class="form-text float-left">
            <p class="m-0 ms-3 float-start d-block">Your password must contain:</p>
            <p class="m-0 ms-3 float-start d-block">* 8-20 characters</p>
            <p class="ms-3 mb-3 float-start d-block">* at least 1 number or special character</p>
        </div>
        <input type="text" name="address" class="form-control m-3" id="googlePlacesAutocomplete" placeholder="Enter Address">
        <input type="hidden" id="address_line_1" name="address_line_1" value="">
        <input type="hidden" id="locality" name="locality" value="">
        <input type="hidden" id="administrative_area_level_1" name="administrative_area_level_1" value="">
        <input type="hidden" id="country" name="country" value="">
        <input type="hidden" id="postal_code" name="postal_code" value="">
        <input type="hidden" id="latitude" name="latitude" value="">
        <input type="hidden" id="longitude" name="longitude" value="">
        <button type="submit" name="submit" class="btn rounded-pill m-3 px-4" style="background-color: #2EBD67; font-weight: 600; color: white;">Create Account</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script type="text/javascript">
    let autocomplete;
    let geocoder;
    let lastRealAddress;
    let place;
    const autocompleteInputField = "googlePlacesAutocomplete";

    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById(autocompleteInputField),
            {
                types: ['address'],
                componentRestrictions: {'country': ['US']},
                fields: ['address_component', 'geometry', 'name']
            });

        autocomplete.addListener('place_changed', onPlaceChanged);
    }

    function onPlaceChanged() {
        place = autocomplete.getPlace();

        if(place.geometry)
        {
            let address = createAddressObject();
            document.getElementById("address_line_1").value = address.address_line_1;
            document.getElementById("locality").value = address.locality;
            document.getElementById("administrative_area_level_1").value = address.administrative_area_level_1;
            document.getElementById("country").value = address.country;
            document.getElementById("postal_code").value = address.postal_code;
            document.getElementById("latitude").value = address.latitude;
            document.getElementById("longitude").value = address.longitude;

        }
    }

    function createAddressObject() {
        var lastIndex;
        var address = {
            address_line_1: place.name,
            latitude: place.geometry.location.lat(),
            longitude: place.geometry.location.lng()
        };

        var address_components = place.address_components;

        for (lastIndex = 0; lastIndex < address_components.length; lastIndex++) {
            if(address_components[lastIndex].types[0] == "locality") {
                address["locality"] = address_components[lastIndex].long_name;
                break;
            }
        }
        for (lastIndex; lastIndex < address_components.length; lastIndex++) {
            if(address_components[lastIndex].types[0] == "administrative_area_level_1") {
                address["administrative_area_level_1"] = address_components[lastIndex].short_name;
                break;
            }
        }
        for (lastIndex; lastIndex < address_components.length; lastIndex++) {
            if(address_components[lastIndex].types[0] == "country") {
                address["country"] = address_components[lastIndex].short_name;
                break;
            }
        }
        for (lastIndex; lastIndex < address_components.length; lastIndex++) {
            if(address_components[lastIndex].types[0] == "postal_code") {
                address["postal_code"] = address_components[lastIndex].short_name;
                break;
            }
            if (lastIndex + 1 == address_components.length) address["postal_code"] = "";
        }

        return address;
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDm0nFVe5L8er77AE0I2XcKVCczsdQSsVI&libraries=geometry,places&callback=initAutocomplete"></script>

</body>
</html>

