{{--http://demo_chart.tradingview.com/--}}


<div id="tv_chart_container"></div>
@push('scripts')
<script src="{{ asset('metronic_custom/charting_library/charting_library.min.js') }}"></script>
<script src="{{ asset('metronic_custom/charting_library/datafeed/udf/datafeed.js') }}"></script>

		<script type="text/javascript">

            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                        results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }

			TradingView.onready(function()
			{
				var widget = window.tvWidget = new TradingView.widget({
					fullscreen: true,
					symbol: 'DSEX:DSE',
					interval: 'D',
					container_id: "tv_chart_container",
					//	BEWARE: no trailing slash is expected in feed URL
					datafeed: new Datafeeds.UDFCompatibleDatafeed("{{ url('/') }}"),
					library_path: "metronic_custom/charting_library/",
					locale: getParameterByName('lang') || "en",
					//	Regression Trend-related functionality is not implemented yet, so it's hidden for a while
					drawings_access: { type: 'black', tools: [ { name: "Regression Trend" } ] },
					disabled_features: ["use_localstorage_for_settings"],
					enabled_features: ["study_templates"],
					charts_storage_url: 'http://saveload.tradingview.com',
                    charts_storage_api_version: "1.1",
					client_id: 'tradingview.com',
					user_id: 'public_user_id'
				});
			});

		</script>


@endpush