<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Problem 3</title>

    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="bower_components/jquery.event.move/js/jquery.event.move.js"></script>
    <script src="bower_components/jquery.event.swipe/js/jquery.event.swipe.js"></script>
    <style>


        .panel { position: relative; overflow: hidden; display: block; border-radius: 0 !important;  }
        .panel-default { border-color: #ebedef !important; }
        .panel .panel-body { position: relative; padding: 0 !important; overflow: hidden; height: auto; }
        .panel .panel-body a { overflow: hidden; }
        .panel .panel-body a img { display: block; margin: 0; width: 100%; height: auto;
            transition: all 0.5s;
            -moz-transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
        }
        .panel .panel-body a.zoom span.overlay { position: absolute; top: 0; left: 0; visibility: hidden; height: 100%; width: 100%; background-color: #000; opacity: 0;
            transition: opacity .25s ease-out;
            -moz-transition: opacity .25s ease-out;
            -webkit-transition: opacity .25s ease-out;
            -o-transition: opacity .25s ease-out;
        }
        .panel .panel-body a.zoom:hover span.overlay { display: block; visibility: visible; opacity: 0.55; -moz-opacity: 0.55; -webkit-opacity: 0.55; filter: alpha(opacity=65); -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)"; }
        .panel .panel-body a.zoom:hover span.overlay i { position: absolute; top: 45%; left: 0%; width: 100%; font-size: 2.25em; color: #fff !important; text-align: center;
            opacity: 1;
            -moz-opacity: 1;
            -webkit-opacity: 1;
            filter: alpha(opacity=1);
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
        }
        .panel .panel-header { padding: 8px !important; background-color: #f9f9f9 !important; border-bottom-right-radius: 0 !important; border-bottom-left-radius: 0 !important; }
        .panel .panel-header h4 { display: inline; font: 400 normal 1.125em "Roboto",Arial,Verdana,sans-serif; color: #34495e margin: 0 !important; padding: 0 !important; }
        .panel .panel-header i.glyphicon { display: inline; font-size: 1.125em; cursor: pointer; }
        .panel .panel-header div { width: 15px; display: inline; font: 300 normal 1.125em "Roboto",Arial,Verdana,sans-serif; color: #34495e; text-align: center; background-color: transparent !important; border: none !important; }

        .modal-title { font: 400 normal 1.625em "Roboto",Arial,Verdana,sans-serif; }
        .modal-footer { font: 400 normal 1.125em "Roboto",Arial,Verdana,sans-serif; }


    </style>
</head>
<body>

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="tablist">

    </ul>

    <!-- Tab panes -->
    <div class="tab-content" id="tablistcontent">

    </div>

</div>
<script type="text/javascript">

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

    $(document).ready(function(){
        $.get("games.json", function(data){
            console.log("data", data);
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

                openGame( article.attr('data-name'), article.attr('data-code'), article.attr('data-machine-id'), article.attr('data-denominations'), article.attr('data-hands'));
            });



        }, "json");
    });
</script>
</body>
</html>