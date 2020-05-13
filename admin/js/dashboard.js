window.addEventListener('load',  () => {
    
    let origin = window.origin;

    let url = origin + '/bluebook/admin/dashboard/overview';

    fetch(url)
    .then(
        function(response) {
        if (response.status !== 200) {
            console.log('Looks like there was a problem. Status Code: ' +
            response.status);
            return;
        }
        // Examine the text in the response
        response.json().then(function(data) {
            
            document.getElementById('total_users').innerText = data.total_user;   
            document.getElementById('total_brands').innerText = data.total_brands;
            document.getElementById('total_pages').innerText = data.total_pages;
            document.getElementById('total_cat').innerText = data.total_cat;       

        });
        }
    )
    .catch(function(err) {
        console.log('Fetch Error :-S', err);
    });

});


