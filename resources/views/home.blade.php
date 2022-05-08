<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('files/css/app.css')}}">
    <title>Pokemon</title>
</head>
<body>
    <div>
        <h1>Poke-Deck</h1>
        <section class="grid">
            @foreach ( $pokemons as $key=>$pokemon)
                <div class="item">
                    <div id="bg_pokemon">
                        <img src="{{$pokemon->sprites ?? ""}}" alt="img-{{$pokemon->name}}">
                    </div>
                    <div id="statis">
                        <div id="number">
                            <span>Nº {{sprintf("%04d", $pokemon->id)}}</span>
                        </div>
                        <div id="name">
                            <span>{{ucfirst($pokemon->name)}}</span>
                        </div>
                        <div id="ability">
                            @isset($pokemon->types[0]->type->name)
                                <div id="one">{{ucfirst($pokemon->types[0]->type->name ?? "")}}</div>
                            @endisset
                            @isset($pokemon->types[1]->type->name)
                                <div id="two">{{ucfirst($pokemon->types[1]->type->name ?? "")}}</div>
                            @endisset
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
</body>
</html>