function openGame(game_name, game_code, machine_id, denominations, hands){
    alert(
        "Game name: "+ game_name+"\n"+
        "Code: "+game_code+"\n"+
        "Machine id: "+ machine_id+"\n"+
        "Denominations: "+ denominations+"\n"+
        "Hands: "+ hands
    );
}

function _stripNonAlphaNumericCharacters(name){
    return name.toLowerCase().replace(/\W/g, '');
}

function _getGameImageURL(name){
    return "http://cacheimg.casinomidas.com/images/www/games/minipods/"+_stripNonAlphaNumericCharacters(name)+"-minipod.jpg";
}

function _renderGameThumbnailHtml(data){
    var html = ''+
        '<article class="col-xs-12 col-sm-6 col-md-3" data-name="'+data.game_name+'" data-code="'+data.game_code+'" data-machine-id="'+data.machine_id+'" data-denominations="'+data.denominations+'" data-hands="'+data.hands+'">'+
        '<div class="panel panel-default">'+
        '<div class="panel-header">'+
        '<h4><a href="#" title="'+data.game_name+'" class="play_game_link">'+data.game_name+'</a></h4>'+
        '</div>'+
        '<div class="panel-body">'+
        '<a href="#" title="'+data.game_name+'" class="zoom play_game_link" data-name="'+data.game_name+'"  >'+
        '<img src="'+_getGameImageURL(data.game_name)+'" alt="'+data.game_name+'" />'+
        '<span class="overlay">' +
        '<i class="glyphicon glyphicon-play"><div class="play-now">Play Now</div></i>' +
        '</span>'+
        '</a>'+
        '</div>'+
        '</div>'+
        '</article>';
    return html;
}

function init(){
    $.get("games.json", function(data){
        var tabs = '',
            tabs_content = '',
            games, cnt, numGames;

        // parse and prepare categories and games list
        for(var i in data){
            tabs += '<li role="presentation">'+
            '<a href="#'+i+'" aria-controls="'+i+'" role="tab" data-toggle="tab">'+
            ''+i+
            '</a></li>';

            tabs_content += '<div role="tabpanel" class="tab-pane" id="'+i+'">';

            // Reset counts for different groups
            games = data[i];
            cnt = 0;
            numGames = games.length;

            tabs_content += '<div class="container">'+
            '<div class="row">'+
            '<div class="col-md-12">'+

            '';

            for(; cnt < numGames; cnt++ ){
                tabs_content += _renderGameThumbnailHtml( games[cnt] );
            }
            tabs_content +='</div>'+
            '</div>'+
            '</div>'+
            '';

            tabs_content += '</div>';
        }
        // populate the tab lists
        $("#tablist").append(tabs);
        $("#tablistcontent").append(tabs_content);

        // set first tabs as active
        $("#tablist li:first").addClass('active')
        $("#tablistcontent div:first").addClass('active')


        // swipe left and write to switch groups
        $("#tablistcontent").on('swiperight', function() {
            var $tab = $('#tablist .active').prev();
            if ($tab.length > 0)
                $tab.find('a').tab('show');
        });
        $("#tablistcontent").on('swipeleft',function() {
            var $tab = $('#tablist .active').next();
            if ($tab.length > 0)
                $tab.find('a').tab('show');
        });

        // on game thumbnail click call the openGame method
        $(".play_game_link").click(function(){
            var article = $(this).closest('article');

            // call the method required by the specs
            openGame( article.attr('data-name'), article.attr('data-code'), article.attr('data-machine-id'), article.attr('data-denominations'), article.attr('data-hands'));
        });
    }, "json");
}