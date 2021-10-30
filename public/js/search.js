//make myselect in a dropdown/checkbox
$('#myselect').select2({
    width: '100%',
    placeholder: "Select an Genre",
    allowClear: true
});
//function for the search of the api
function search() {
    //get the value of the search
    let query = document.getElementById('search_query').value;
    //if the search is less than 3 characters than give a error
    if (query.length < 3) {
        alert('Error: Requires atleast 3 or more characters');
        return;
    }
    //get all alert id's and results classes
    let alerts = document.querySelectorAll('.alert')
    let results = document.querySelectorAll('#results')
    //for loop to remove all alerts and results
    for (let i=0; i<alerts.length + 2; i++){
        $(".alert").remove();
    }
    for (let i=0; i<results.length + 2; i++){
        $("#results").remove();
    }

    //make the url
    let requestUrl = `https://api.jikan.moe/v3/search/anime?q=${query}`;
    //fetch the url
    fetch(requestUrl)
        .then(response => response.json())
        .then(data => {
            //give max 6 results bak
            const maxResults = 6;
            let i = 1;
            try {
                //make a foreach loop for all results
                data.results.forEach(anime => {
                    // hide NSFW
                    if (anime.rated === "Rx") {
                        return;
                    }
                    // filter limit client side
                    if (i > maxResults) {
                        throw BreakException;
                    }
                    //get the search_results element and add the html
                    document.getElementById('search_results')
                        .insertAdjacentHTML(
                            'beforeend',
                            `
                        <a href="javascript:data(${anime.mal_id})" class="card" id="results">
                            <div class="card__image">
                                <img loading="lazy" src="${anime.image_url}" alt="${anime.title}" />
                            </div>
                            <div class="card__name">
                                <span>${anime.title}</span>
                            </div>
                        </a>
                    `
                        );
                    i++;
                });
            } catch (e) {
                //
            }
        });
}
//function to get the data by the animeID
function data($animeId) {
    //get all result classes
    let results = document.querySelectorAll('#results')
    //for loop to remove all results
    for (let i=0; i<results.length + 2; i++){
        $("#results").remove();
    }
    //make the url
    const requestUrl = `https://api.jikan.moe/v3/anime/${$animeId}`;
    //fetch the url
    fetch(requestUrl)
        .then(response => response.json())
        .then(anime => {
            try {
                //insert all data into the input tags
                document.getElementById('title').value = anime.title_english;
                document.getElementById('description').value = `${anime.synopsis.slice(0, -25)}`;
                let selectedGenres = [];
                anime.genres.forEach(element =>
                    selectedGenres.push(element.mal_id)
                );
                document.getElementById('episodes').value = anime.episodes;
                document.getElementById('rating').value = anime.score;
                document.getElementById('season').value = `${anime.premiered.slice(0, -5)}`
                document.getElementById('year').value = `${anime.premiered.substr(-4)}`
                //input the genres of the anime in to the myselect dropdown
                $("#myselect").val(selectedGenres)
                addSuccess()
            }catch (e) {
                //
            }
        });
    //
}

//get the onclick of search and search_query and execute the function
document.getElementById('search').onclick = () => search();
document.getElementById('search_query').onkeydown = (event) => {
    if (event.keyCode === 13) {
        search();
    }
};
//make the success function
function addSuccess(){
    //get the element alers
    let alerts = document.getElementById('alerts');
    // make a new h4 element
    let succes = document.createElement('h4');
    //add the alert and alert-success classes
    succes.classList.add('alert');
    succes.classList.add('alert-success');
    //insert the innerHTML
    succes.innerHTML = "Anime Succesfully imported"
    //create a new h4 element
    let danger = document.createElement('h4');
    //add the alert and alert-danger classes
    danger.classList.add('alert');
    danger.classList.add('alert-danger');
    //insert the innerHTML
    danger.innerHTML = `Genres won't show up <br> images need to be uploaded`
    //append the succes and danger element to alerts
    alerts.appendChild(succes)
    alerts.appendChild(danger)
}


