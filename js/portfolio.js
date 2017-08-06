$(document).ready(function(){
    // Make request to Github
    $.ajax({
      url: 'https://api.github.com/users/ardlank',
      data:{
        client_id: '2f11e0c3ce2b8787c148',
        client_secret: '3ba6305c5e3d55a5cfec808a3d024637d21381fc'
      }
    }).done(function(user){
      $.ajax({
        url: 'https://api.github.com/users/ardlank/repos',
        data:{
          client_id: '2f11e0c3ce2b8787c148',
          client_secret: '3ba6305c5e3d55a5cfec808a3d024637d21381fc',
          sort: 'created: asc',
          per_page: 30
        }
      }).done(function(repos){
        $.each(repos, function(index, repo){
          $('#repos').append(`
            <div class="well">
              <div class="row">
                <div class="col-md-7">
                  <strong>${repo.name}</strong>: ${repo.description}
                </div>
                <div class="col-md-3">
                  <span class="label label-default">Forks: ${repo.forks_count}</span>
                  <span class="label label-primary">Watchers: ${repo.watchers_count}</span>
                  <span class="label label-success">Stars: ${repo.stargazers_count}</span>
                </div>
                <div class="col-md-2">
                  <a href="${repo.html_url}" target="_blank" class="btn btn-default">Repo Page</a>
                </div>
              </div>
            </div>
          `);
        });
      });
      $('#profile').html(`
        <div id="repos"></div>
      `);
    });
});
