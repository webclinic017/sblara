var request = require('request')

class DseProvider{
	constructor(){
		this.json = {}
		this.base_url = "http://dsebd.org"
	}

	getCompanyInfoUrl(){
		return this.base_url + "/displayCompany.php?name="+ this.instrument
	}

	parseCompanyInfo(){
		this.json.shareholdings = this.getShareHoldings()
		this.json.eps = this.getEps()
		return this.json
	}

	getEps(){
		var eps = {}
		eps.q1 = 0;
		eps.q2 = 1;
		eps.q2_6 = 2;
		eps.q3 = 8;
		eps.q3_9 = 3;
		return eps;
	}

	getShareHoldings() {
		var shareholdings = {};
		var html = this.html
        var data = this.preg_match_all(/(Public|Institute|Sponsor\/Director|Foreign|Govt):<br>(?:[^\\S 0-9.]*)([0-9.]+)/gm, html);
        if(data.length != 5){
            return shareholdings;
        }
		shareholdings.sponsor = data[0].value;
		shareholdings.govt = data[1].value;
		shareholdings.institute = data[2].value;
		shareholdings.foreign = data[3].value;
		shareholdings.public = data[4].value;

		return shareholdings;
	}

}

class Scraper{
	constructor(provider, instrument){
		this.provider = provider;
		this.setPregMatchAll();
		this.provider.instrument = instrument 
		this.json = {}
	}

	setPregMatchAll(){
			this.provider.preg_match_all = 	function(re, s) {
		    const str = s;
		    const regex = re;
		    let m;
		    var result = [];
		    var i = 0;
		    while ((m = regex.exec(str)) !== null) {
		         i++;
		        // This is necessary to avoid infinite loops with zero-width matches
		        if (m.index === regex.lastIndex) {
		        regex.lastIndex++;
		        }
		            if(i <= 10){
		                continue
		            }

		        result.push({name: m[1], value: m[2]}) 
		    }

		    return result;
		}
		return this
	}

	//get content form url
	getCompanyInfo(){
		request.get(this.provider.getCompanyInfoUrl(),  (error, response, body) => {
			this.provider.html = body
			this.parseCompanyInfo().onComplete(this.json)
		})
	}

	run(){
		this.getCompanyInfo();
	}

	setOnCompleteListener(func){
		this.onComplete = func;
		return this
	}

	parseCompanyInfo(){
		this.json = this.provider.parseCompanyInfo();
		return this;
	}
}



	var a = new Scraper(new DseProvider(), "KPCL");
	a.setOnCompleteListener(function (json) {
		console.log(json)
	}).run()
