var baseUrl = "http://localhost/php-phonebook/";

async function displayCities(){
    let country_id = document.getElementById("country_id").value;
    let response = await fetch(baseUrl+"getCitiesByCountry.php?country_id="+country_id);
    let cities = await response.json();

    let citiesHTML = '';
    cities.forEach( (city) => {
        citiesHTML += `<option value="${city.id}" >${city.name}</option>`;
    });

    document.getElementById("city_id").innerHTML = citiesHTML;
}