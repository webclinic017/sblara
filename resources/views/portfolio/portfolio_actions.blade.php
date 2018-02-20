<link href="/css/portfolio.css" rel="stylesheet">
<div class="row portfolioActions ">
    <div class="col-md-2">
        <a href=":;javascript" action="/diversity_model/{{$portfolioId}}">
                        <button class="btn btn-primary ">Diversity Model</button>
                    </a>
    </div>
    <div class="col-md-2">
        <a href=":;javascript" action="/portfolio_fundamental/{{$portfolioId}}">
            <button class="btn btn-primary ">Fundamental</button>
        </a>
    </div>
    {{--<div class="col-md-2">
        <a href=":;javascript" action="/portfolio_market_summary/{{$portfolioId}}">
            <button class="btn btn-primary ">Market Summary</button>
        </a>
    </div>    --}}
    <div class="col-md-2">
        <a href=":;javascript" action="/portfolio_chart/{{$portfolioId}}">
            <button class="btn btn-primary ">Movement</button>
        </a>
    </div>

    <div class="col-md-2">
        <a href=":;javascript" action="/portfolio_gain_loss/{{$portfolioId}}" class="portfolio_gain_loss">
            <button class="btn btn-primary gain-loss">Realized Gain/Loss</button>
        </a>
    </div>
    <div class="col-md-2">
        <a href=":;javascript" action="/portfolio/{{$portfolioId}}/edit">
            <button class="btn btn-primary edit">Edit Portfolio</button>
        </a>
    </div>
     <div class="col-md-2">
                <a href=":;javascript" action="/portfolio_performance/{{$portfolioId}}">
                    <button class="btn btn-primary performance">Performance</button>
                </a>
      </div>
</div>