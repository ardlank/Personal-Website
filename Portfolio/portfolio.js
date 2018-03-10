fetch('https://api.github.com/users/ardlank/repos')
  .then(
    function(response) {
      if (response.status !== 200) {
        alert('Looks like there was a problem. Status Code: ' +
          response.status);
        return;
      }

      // Examine the text in the response
      response.json().then(function(data) {
        for(var ele in data){
            let cur = data[ele];
            let repo = cur.name;
            let url = "https://github.com/ardlank/" + repo;
            $('#me').append(`
            <li class="list-group-item">
                <a href="${url}" target="_blank" class="btn btn-primary float-right">Repo Page</a>
                <strong>${repo}</strong>: ${cur.description}<br>
                <strong>Language</strong>: ${cur.language}
            </li>
        `);
        }
      });
    }
  )
  .catch(function(err) {
    console.log('Fetch Error :-S', err);
  });