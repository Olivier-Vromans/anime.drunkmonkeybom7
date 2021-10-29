$('#myselect').select2({
    width: '100%',
    placeholder: "Select an Genre",
    allowClear: true
});

function search() {
    let query = document.getElementById('search_query').value;

    if (query.length < 3) {
        alert('Error: Requires atleast 3 or more characters');
        return;
    }

    let results = document.querySelectorAll('#results')
    for (let i=0; i<results.length + 2; i++){
        $("#results").remove();
    }

    let requestUrl = `https://api.jikan.moe/v3/search/anime?q=${query}`;

    fetch(requestUrl)
        .then(response => response.json())
        .then(data => {
            const maxResults = 6;
            let i = 1;
            try {
                data.results.forEach(anime => {
                    // hide NSFW
                    if (anime.rated === "Rx") {
                        return;
                    }
                    // filter limit client side
                    if (i > maxResults) {
                        throw BreakException;
                    }
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

function data($animeId) {
    console.log("Your in the function")
    let results = document.querySelectorAll('#results')
    console.log(results)
    for (let i=0; i<results.length + 2; i++){
        $("#results").remove();
    }

    const requestUrl = `https://api.jikan.moe/v3/anime/${$animeId}`;

    fetch(requestUrl)
        .then(response => response.json())
        .then(anime => {
            try {
                document.getElementById('title').value = anime.title_english;
                document.getElementById('description').value = `${anime.synopsis.slice(0, -25)}`;
                // document.getElementById('genre_id').value = anime.genres;
                let selectedGenres = [];
                anime.genres.forEach(element =>
                    selectedGenres.push(element.mal_id)
                );
                document.getElementById('episodes').value = anime.episodes;
                document.getElementById('rating').value = anime.score;
                document.getElementById('season').value = `${anime.premiered.slice(0, -5)}`
                document.getElementById('year').value = `${anime.premiered.substr(-4)}`
                $("#myselect").val(selectedGenres)
                addSuccess()
            }catch (e) {
                //
            }
        });
    //
}


document.getElementById('search').onclick = () => search();
document.getElementById('search_query').onkeydown = (event) => {
    if (event.keyCode === 13) {
        search();
    }
};

window.addEventListener("load", function(){
});

function addSuccess(){
    let alerts = document.getElementById('alerts');
    let succes = document.createElement('h4');
    succes.classList.add('alert');
    succes.classList.add('alert-success');
    succes.innerHTML = "Anime Succesfully imported"
    let danger = document.createElement('h4');
    danger.classList.add('alert');
    danger.classList.add('alert-danger');
    danger.innerHTML = `Genres won't show up <br> images need to be uploaded`
    alerts.appendChild(succes)
    alerts.appendChild(danger)

}


