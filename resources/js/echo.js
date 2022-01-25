Echo
   .channel('App.Models.User')
   .listen('ArticleUpdate', (e) => {
       var echoString ="Статья " + e.article["title"] + " Была изменена, поля которые были изменены: ";
        for (let key in e.history["changed_fields"]) {
            echoString = echoString + key +": " + e.history["changed_fields"][key] + " ";
        }
        
        var d1 = document.getElementById('myid');
        d1.insertAdjacentHTML('afterbegin', "<a href=http://myserver/articles/"+ e.article["code"]+">Сылка на измененую статью</a>");
        
        alert(echoString);
    });